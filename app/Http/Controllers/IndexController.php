<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Administrasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $programs = Administrasi::select('program_mbkm')
            ->groupBy('program_mbkm')
            ->selectRaw('count(*) as total, program_mbkm')
            ->get();

        $programData = $programs->mapWithKeys(function ($item) {
            return [$item['program_mbkm'] => $item['total']];
        });

        return view('index', compact('programData'));
    }
    public function user()
    {
        $userId = Auth::id();

        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records for the logged-in user
        $administrasiRecords = Administrasi::where('user_id', $userId)->get();
        // Retrieve the administrasi records along with the related user data
        $administrasiDatas = Administrasi::with('user')->get();

        // Count each status occurrence and determine class for each status
        $administrasiData = $administrasiRecords->map(function ($administrasi) use (&$approvedCount, &$waitingCount, &$rejectedCount) {
            if ($administrasi->status === 'approved') $approvedCount++;
            if ($administrasi->status2 === 'approved') $approvedCount++;
            if ($administrasi->status3 === 'approved') $approvedCount++;

            if ($administrasi->status === 'waiting') $waitingCount++;
            if ($administrasi->status2 === 'waiting') $waitingCount++;
            if ($administrasi->status3 === 'waiting') $waitingCount++;

            if ($administrasi->status === 'rejected') $rejectedCount++;
            if ($administrasi->status2 === 'rejected') $rejectedCount++;
            if ($administrasi->status3 === 'rejected') $rejectedCount++;

            $administrasi->status_class = $this->getStatusClass($administrasi->status);
            $administrasi->status2_class = $this->getStatusClass($administrasi->status2);
            $administrasi->status3_class = $this->getStatusClass($administrasi->status3);

            return $administrasi;
        });

        return view('user.index', compact('administrasiData', 'administrasiDatas', 'approvedCount', 'waitingCount', 'rejectedCount'));
    }

    private function getStatusClass($status)
    {
        switch ($status) {
            case 'approved':
                return 'bg-success text-white'; // Green
            case 'waiting':
                return 'bg-warning text-dark'; // Yellow
            case 'rejected':
                return 'bg-danger text-white'; // Red
            default:
                return 'bg-secondary text-white'; // Gray
        }
    }
    public function createsop()
    {
        // Fetch users with the role 'dosen'
        $dosenList = User::where('role', 'dosen')->get();
        $userId = Auth::id();

        // Check if there are any records with status not "Approve" or "Rejected"
        $pendingDataExists = Administrasi::where('user_id', $userId)
            ->where(function ($query) {
                $query->whereNotIn('status', ['approve', 'rejected'])
                    ->orWhereNotIn('status3', ['approve', 'rejected']);
            })
            ->exists();

        return view('user.tambah', compact('dosenList', 'pendingDataExists'));
    }

    public function creatematakuliah()
    {
        $userId = Auth::id();

        // Check if any administrasi records exist for the user
        $administrasiExists = Administrasi::where('user_id', $userId)->exists();

        // Check if there are any records with status not "Approve" or "Rejected"
        $administrasiPending = Administrasi::where('user_id', $userId)
            ->whereNotIn('status', ['approve', 'rejected'])
            ->exists();

        // Check if there are any records with status3 as "Waiting"
        $ekuivalensiPending = Administrasi::where('user_id', $userId)
            ->where('status3', 'waiting')
            ->exists();

        // Determine if the form can be submitted
        $canSubmitForm = $administrasiExists && !($administrasiPending || $ekuivalensiPending);

        return view('user.mata_kuliah', compact('administrasiExists', 'administrasiPending', 'ekuivalensiPending', 'canSubmitForm'));
    }
    public function show($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);

        return view('user.administrasi_detail', compact('administrasi'));
    }
    public function status()
    {
        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('user.status', compact('administrasiData'));
    }
    public function administrasi(Request $request)
    {
        $request->validate([
            'semester' => 'required|string',
            'nilai_ipk' => 'required|string',
            'dosen_wali' => 'required|string',
            'program_mbkm' => 'required|string',
            'transkrip_nilai' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('transkrip_nilai');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'public/uploads';
        $file->storeAs($tujuan_upload, $nama_file);

        $administrasi = new Administrasi([
            'semester' => $request->input('semester'),
            'nilai_ipk' => $request->input('nilai_ipk'),
            'dosen_wali' => $request->input('dosen_wali'),
            'program_mbkm' => $request->input('program_mbkm'),
            'transkrip_nilai' => $nama_file,
            'nama_penyelenggara' => 'null',
            'no_hp' => '0',
            'deskripsi_kegiatan' => 'null',
            'capaian_pembelajaran' => 'null',
            'status' => 'waiting',
            'status2' => 'waiting',
            'status3' => 'null',
            'status4' => 'waiting',
            'user_id' => Auth::id(), // Set the user_id to the currently logged-in user's ID
        ]);

        $administrasi->save();

        return redirect('index/user/tambahsop')->with('success', 'Data Administrasi berhasil disimpan.');
    }

    public function storeMataKuliah(Request $request)
    {
        $request->validate([
            'mata_kuliah_1' => 'nullable|string',
            'mata_kuliah_2' => 'nullable|string',
            'mata_kuliah_3' => 'nullable|string',
            'mata_kuliah_4' => 'nullable|string',
            'mata_kuliah_5' => 'nullable|string',
            'nama_penyelenggara' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'deskripsi_kegiatan' => 'required|string',
            'capaian_pembelajaran' => 'required|string',
        ]);

        // Find the most recent Administrasi record for the logged-in user
        $administrasi = Administrasi::where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($administrasi) {
            $administrasi->mata_kuliah_1 = $request->input('mata_kuliah_1');
            $administrasi->mata_kuliah_2 = $request->input('mata_kuliah_2');
            $administrasi->mata_kuliah_3 = $request->input('mata_kuliah_3');
            $administrasi->mata_kuliah_4 = $request->input('mata_kuliah_4');
            $administrasi->mata_kuliah_5 = $request->input('mata_kuliah_5');
            $administrasi->nama_penyelenggara = $request->nama_penyelenggara;
            $administrasi->no_hp = $request->no_hp;
            $administrasi->deskripsi_kegiatan = $request->deskripsi_kegiatan;
            $administrasi->capaian_pembelajaran = $request->capaian_pembelajaran;
            $administrasi->status3 = 'waiting'; // Update status3 to 'waiting'
            $administrasi->save();

            return redirect()->route('user.status')->with('success', 'Mata Kuliah berhasil disimpan.');
        }

        return redirect()->route('user.status')->with('error', 'Tidak ada data administrasi yang ditemukan.');
    }




    //DOSEN !!!!!!!!!!!!!!!!!!!!!!

    public function dosen()
    {
        $programData = DB::table('administrasis')
            ->select('program_mbkm', DB::raw('count(*) as total'))
            ->groupBy('program_mbkm')
            ->get();
        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records
        $administrasiRecords = Administrasi::all();

        // Count each status occurrence
        foreach ($administrasiRecords as $administrasi) {
            if ($administrasi->status === 'approved') $approvedCount++;
            if ($administrasi->status2 === 'approved') $approvedCount++;
            if ($administrasi->status3 === 'approved') $approvedCount++;

            if ($administrasi->status === 'waiting') $waitingCount++;
            if ($administrasi->status2 === 'waiting') $waitingCount++;
            if ($administrasi->status3 === 'waiting') $waitingCount++;

            if ($administrasi->status === 'rejected') $rejectedCount++;
            if ($administrasi->status2 === 'rejected') $rejectedCount++;
            if ($administrasi->status3 === 'rejected') $rejectedCount++;
        }

        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('dosen.index', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount', 'programData'));
    }
    public function history()
    {
        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records
        $administrasiRecords = Administrasi::all();

        // Count each status occurrence
        foreach ($administrasiRecords as $administrasi) {
            if ($administrasi->status === 'approved') $approvedCount++;
            if ($administrasi->status2 === 'approved') $approvedCount++;
            if ($administrasi->status3 === 'approved') $approvedCount++;

            if ($administrasi->status === 'waiting') $waitingCount++;
            if ($administrasi->status2 === 'waiting') $waitingCount++;
            if ($administrasi->status3 === 'waiting') $waitingCount++;

            if ($administrasi->status === 'rejected') $rejectedCount++;
            if ($administrasi->status2 === 'rejected') $rejectedCount++;
            if ($administrasi->status3 === 'rejected') $rejectedCount++;
        }

        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('dosen.history', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount'));
    }
    public function approveadmin()
    {
        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('dosen.approve_admin', compact('administrasiData'));
    }
    public function approvekegiatan()
    {
        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('dosen.approve_kegiatan', compact('administrasiData'));
    }
    public function approvematkul()
    {
        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('dosen.approve_matkul', compact('administrasiData'));
    }
    public function showDetail1($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);
        return view('dosen.detail1', compact('administrasi'));
    }

    public function updatedetail1(Request $request, $id)
    {
        $administrasi = Administrasi::findOrFail($id);

        // Update the note1 field
        $administrasi->note1 = $request->input('note1');

        // Check which button was pressed
        if ($request->input('action') == 'approve') {
            // Handle approve logic
            $administrasi->status = 'approve';
        } elseif ($request->input('action') == 'reject') {
            // Handle reject logic
            $administrasi->status = 'reject';
        }

        $administrasi->save();

        return redirect()->route('dosen.detail1', $id)->with('status', 'Update successful!');
    }
    public function showDetail2($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);
        return view('dosen.detail2', compact('administrasi'));
    }

    public function updatedetail2(Request $request, $id)
    {
        $administrasi = Administrasi::findOrFail($id);

        // Update the note1 field
        $administrasi->note2 = $request->input('note2');

        // Check which button was pressed
        if ($request->input('action') == 'approve') {
            // Handle approve logic
            $administrasi->status2 = 'approve';
        } elseif ($request->input('action') == 'reject') {
            // Handle reject logic
            $administrasi->status2 = 'reject';
        }

        $administrasi->save();

        return redirect()->route('dosen.detail2', $id)->with('status', 'Update successful!');
    }
    public function showDetail3($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);
        return view('dosen.detail3', compact('administrasi'));
    }

    public function updatedetail3(Request $request, $id)
    {
        $administrasi = Administrasi::findOrFail($id);

        // Update the note1 field
        $administrasi->note3 = $request->input('note3');

        // Check which button was pressed
        if ($request->input('action') == 'approve') {
            // Handle approve logic
            $administrasi->status3 = 'approve';
        } elseif ($request->input('action') == 'reject') {
            // Handle reject logic
            $administrasi->status3 = 'reject';
        }

        $administrasi->save();

        return redirect()->route('dosen.detail3', $id)->with('status', 'Update successful!');
    }
    public function showDetail4($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);

        return view('dosen.detail4', compact('administrasi'));
    }

    public function viewPdf($id)
    {
        $administrasi = Administrasi::findOrFail($id);
        return view('dosen.view_pdf', compact('administrasi'));
    }







    //KAPRODI !!!!!!!!

    public function superadm()
    {
        $programData = DB::table('administrasis')
            ->select('program_mbkm', DB::raw('count(*) as total'))
            ->groupBy('program_mbkm')
            ->get()
            ->toArray();

        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records
        $administrasiRecords = Administrasi::all();

        // Count each status occurrence
        foreach ($administrasiRecords as $administrasi) {
            if ($administrasi->status4 === 'approved') $approvedCount++;


            if ($administrasi->status4 === 'waiting') $waitingCount++;


            if ($administrasi->status4 === 'rejected') $rejectedCount++;
        }

        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('kaprodi.index', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount', 'programData'));
    }
    public function approvekaprodi()
    {
        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('kaprodi.approve_pengajuan', compact('administrasiData'));
    }
    public function historykaprodi()
    {
        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records
        $administrasiRecords = Administrasi::all();

        // Count each status occurrence
        foreach ($administrasiRecords as $administrasi) {
            if ($administrasi->status === 'approved') $approvedCount++;
            if ($administrasi->status2 === 'approved') $approvedCount++;
            if ($administrasi->status3 === 'approved') $approvedCount++;

            if ($administrasi->status === 'waiting') $waitingCount++;
            if ($administrasi->status2 === 'waiting') $waitingCount++;
            if ($administrasi->status3 === 'waiting') $waitingCount++;

            if ($administrasi->status === 'rejected') $rejectedCount++;
            if ($administrasi->status2 === 'rejected') $rejectedCount++;
            if ($administrasi->status3 === 'rejected') $rejectedCount++;
        }

        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('kaprodi.history', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount'));
    }
    public function showDetailkaprodi($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);
        return view('kaprodi.detail3', compact('administrasi'));
    }

    public function updatedetailkaprodi(Request $request, $id)
    {
        $administrasi = Administrasi::findOrFail($id);

        $administrasi = Administrasi::findOrFail($id);

        if ($request->action == 'approve') {
            $administrasi->status4 = 'approved';
        } elseif ($request->action == 'reject') {
            $administrasi->status4 = 'rejected';
        }

        $administrasi->save();


        return redirect()->route('kaprodi.detail3', $id)->with('status', 'Update successful!');
    }
    public function showDetail5($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);

        return view('kaprodi.detail4', compact('administrasi'));
    }
    public function admin()
    {
        $programData = DB::table('administrasis')
            ->select('program_mbkm', DB::raw('count(*) as total'))
            ->groupBy('program_mbkm')
            ->get();
        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records
        $administrasiRecords = Administrasi::all();

        // Count each status occurrence
        foreach ($administrasiRecords as $administrasi) {
            if ($administrasi->status === 'approved') $approvedCount++;
            if ($administrasi->status2 === 'approved') $approvedCount++;
            if ($administrasi->status3 === 'approved') $approvedCount++;

            if ($administrasi->status === 'waiting') $waitingCount++;
            if ($administrasi->status2 === 'waiting') $waitingCount++;
            if ($administrasi->status3 === 'waiting') $waitingCount++;

            if ($administrasi->status === 'rejected') $rejectedCount++;
            if ($administrasi->status2 === 'rejected') $rejectedCount++;
            if ($administrasi->status3 === 'rejected') $rejectedCount++;
        }

        // Retrieve the administrasi records along with the related user data
        $administrasiData = Administrasi::with('user')->get();

        return view('admin.index', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount', 'programData'));
    }




    // ADMIN
    public function daftaruser()
    {
        // Fetch all users
        $users = User::all();

        // Pass the user data to the view
        return view('admin.user', compact('users'));
    }
    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nim' => 'required|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nim' => $request->nim,
            'role' => 'user', // Automatically assign 'user' role
        ]);

        return redirect()->route('daftaruser')->with('success', 'User berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nim' => 'nullable|integer|unique:users,nim,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nim = $request->nim;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('daftaruser')->with('success', 'User berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete related administrasi records
        $user->administrasis()->delete();

        // Delete the user
        $user->delete();

        return redirect()->route('daftaruser')->with('success', 'User dan data administrasi terkait berhasil dihapus.');
    }
}

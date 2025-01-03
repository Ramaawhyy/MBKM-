<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Kandidat;
use App\Models\Token;
use App\Models\sop;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Administrasi;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function user()
    {
        // Retrieve the administrasi records along with the related user data
        $userId = Auth::id();

        // Initialize counters
        $approvedCount = 0;
        $waitingCount = 0;
        $rejectedCount = 0;

        // Retrieve all administrasi records for the logged-in user
        $administrasiRecords = Administrasi::where('user_id', $userId)->get();

        // Count each status occurrence
        foreach ($administrasiRecords as $administrasi) {
            if (
                $administrasi->status === 'approved'
            ) $approvedCount++;
            if ($administrasi->status2 === 'approved') $approvedCount++;
            if ($administrasi->status3 === 'approved') $approvedCount++;

            if ($administrasi->status === 'waiting') $waitingCount++;
            if ($administrasi->status2 === 'waiting') $waitingCount++;
            if ($administrasi->status3 === 'waiting') $waitingCount++;

            if ($administrasi->status === 'rejected') $rejectedCount++;
            if ($administrasi->status2 === 'rejected') $rejectedCount++;
            if ($administrasi->status3 === 'rejected') $rejectedCount++;
        }
        $administrasiData = Administrasi::with('user')->get();

        return view('user.index', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount'));
    }
    public function createsop()
    {
        return view('user.tambah');
    }
    public function createpemilihankegiatan()
    {
        return view('user.pemilihan_kegiatan');
    }
    public function creatematakuliah()
    {
        return view('user.mata_kuliah');
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
    public function usersopstore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'public/uploads';
        $file->storeAs($tujuan_upload, $nama_file);

        $sop = new SOP([
            'nama' => $request->input('nama'),
            'klasifikasi_dokumen' => 'Tidak Ada',
            'nomor_dokumen' => 'Tidak Ada',
            'persetujuan_sekretaris' => 'Belum disetujui',
            'persetujuan_mr' => 'Belum disetujui',
            'status_pengesahan_direktur' => 'Belum disetujui',
            'file' => $nama_file,
        ]);

        $sop->status = $request->input('status'); // Tetapkan nilai status setelah validasi

        $sop->save();

        return redirect('index/user')->with('success', 'Data SOP berhasil disimpan.');
    }
    public function administrasi(Request $request)
    {
        $request->validate([
            'semester' => 'required|string',
            'nilai_ipk' => 'required|string',
            'dosen_wali' => 'required|string',
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
            'transkrip_nilai' => $nama_file,
            'status' => 'waiting',
            'status2' => 'null',
            'status3' => 'null',
            'status4'=> 'waiting',
            'user_id' => Auth::id(), // Set the user_id to the currently logged-in user's ID
        ]);

        $administrasi->save();

        return redirect('index/user')->with('success', 'Data Administrasi berhasil disimpan.');
    }
    public function storeProgramMbkm(Request $request)
    {
        $request->validate([
            'program_mbkm' => 'required|string',
        ]);

        // Find the most recent Administrasi record for the logged-in user
        $administrasi = Administrasi::where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($administrasi) {
            $administrasi->program_mbkm = $request->input('program_mbkm');
            $administrasi->status2 = 'waiting'; // Update status2 to 'waiting'
            $administrasi->save();

            return redirect()->route('user')->with('success', 'Program MBKM berhasil disimpan.');
        }

        return redirect()->route('user')->with('error', 'Tidak ada data administrasi yang ditemukan.');
    }

    public function storeMataKuliah(Request $request)
    {
        $request->validate([
            'mata_kuliah_1' => 'nullable|string',
            'mata_kuliah_2' => 'nullable|string',
            'mata_kuliah_3' => 'nullable|string',
            'mata_kuliah_4' => 'nullable|string',
            'mata_kuliah_5' => 'nullable|string',
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
            $administrasi->status3 = 'waiting'; // Update status3 to 'waiting'
            $administrasi->save();

            return redirect()->route('user')->with('success', 'Mata Kuliah berhasil disimpan.');
        }

        return redirect()->route('user')->with('error', 'Tidak ada data administrasi yang ditemukan.');
    }




    //DOSEN !!!!!!!!!!!!!!!!!!!!!!

    public function dosen()
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

        return view('dosen.index', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount'));
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

        return view('kaprodi.index', compact('administrasiData', 'approvedCount', 'waitingCount', 'rejectedCount'));
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

        // Update the note1 field


        // Check which button was pressed
        if ($request->input('action') == 'approve') {
            // Handle approve logic
            $administrasi->status4 = 'approve';
        } elseif ($request->input('action') == 'reject') {
            // Handle reject logic
            $administrasi->status4 = 'reject';
        }

        $administrasi->save();

        return redirect()->route('kaprodi.detail3', $id)->with('status', 'Update successful!');
    }
    public function showDetail5($id)
    {
        $administrasi = Administrasi::with('user')->findOrFail($id);

        return view('kaprodi.detail4', compact('administrasi'));
    }
}

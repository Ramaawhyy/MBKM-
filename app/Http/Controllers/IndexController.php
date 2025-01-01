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
            if ($administrasi->status === 'approved'
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






    public function sekretaris()
    {
        $sop = sop::all();
        return view('sekretaris.index', compact('sop'));
    }

    public function sopshowsekre($id)
    {
        $sop = sop::findOrFail($id);
        return view('sekretaris.show', compact('sop'));
    }
    public function editsekre($id)
    {
        $sop = SOP::find($id);

        $sop = SOP::find($id);
        $statusOptions = ['Pengajuan Dokumen', 'Pengajuan Revisi'];

        return view('sekretaris.edit', compact('sop', 'statusOptions'));
    }

    public function sekresopupdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'klasifikasi_dokumen' => 'required',
            'nomor_dokumen' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
            'persetujuan_sekretaris' => 'required',
        ]);

        $sop = SOP::find($id);

        if (!$sop) {
            return redirect('index/sekretaris')->with('error', 'Data tidak ditemukan.');
        }

        $sop->nama = $request->input('nama');
        $sop->klasifikasi_dokumen = $request->input('klasifikasi_dokumen');
        $sop->nomor_dokumen = $request->input('nomor_dokumen');
        $sop->persetujuan_sekretaris = $request->input('persetujuan_sekretaris');

        // Jika file baru diunggah, simpan yang baru dan hapus yang lama
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'public/uploads';
            $file->storeAs($tujuan_upload, $nama_file);

            // Hapus file lama jika ada
            if ($sop->file) {
                Storage::delete('public/uploads/' . $sop->file);
            }

            $sop->file = $nama_file;
        }

        // Hapus bagian tambahan untuk persetujuan_mr dan status_pengesahan_direktur

        $sop->save();

        return redirect('index/sekretaris')->with('success', 'Data SOP berhasil diupdate.');
    }



    public function sopdestroysekre($id)
    {
        $sop = SOP::findOrFail($id);
        $sop->delete();

        return redirect('index/sekretaris')->with('success', 'Data event berhasil disimpan.');
    }




    public function admin()
    {
        $sop = sop::all();
        return view('adminall.index', compact('sop'));
    }
    public function adminsopedit($id)
    {
        $sop = SOP::find($id);

        return view('adminall.edit', compact('sop'));
    }

    public function adminsopupdate(Request $request, $id)
    {
        $request->validate([
            'persetujuan_mr' => 'required|in:Setuju,Tidak Setuju',
        ]);

        $sop = SOP::find($id);

        if (!$sop) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $sop->persetujuan_mr = $request->input('persetujuan_mr');
        $sop->save();

        return redirect('index/admin')->with('success', 'Data SOP berhasil diupdate.');
    }

    public function sopshow($id)
    {
        $sop = sop::findOrFail($id);
        return view('adminall.show', compact('sop'));
    }

    public function sopdestroy($id)
    {
        $sop = SOP::findOrFail($id);
        $sop->delete();

        return redirect('index/sekretaris')->with('success', 'Data event berhasil disimpan.');
    }













    public function superadm()
    {
        $sop = sop::all();
        return view('direktur.index', compact('sop'));
    }

    public function edit($id)
    {
        $sop = SOP::find($id);
        $statusOptions = ['Sudah Sah', 'Belum Sah'];

        return view('direktur.edit', compact('sop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'status_pengesahan_direktur' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $sop = SOP::find($id);

        if (!$sop) {
            return redirect('index/direktur')->with('error', 'Data tidak ditemukan.');
        }


        $sop->status = $request->input('status');
        $sop->status_pengesahan_direktur = $request->input('status_pengesahan_direktur');

        // Jika file baru diunggah, simpan yang baru dan hapus yang lama
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'public/uploads';
            $file->storeAs($tujuan_upload, $nama_file);

            // Hapus file lama jika ada
            if ($sop->file) {
                Storage::delete('public/uploads/' . $sop->file);
            }

            $sop->file = $nama_file;
        }

        // Hapus bagian tambahan untuk persetujuan_mr dan status_pengesahan_direktur

        $sop->save();

        return redirect('index/direktur')->with('success', 'Data SOP berhasil diupdate.');
    }
}

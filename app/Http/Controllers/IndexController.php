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

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    
    
    
    
    public function user()
    {
        $sop = sop::all();
        return view('user.index', compact('sop'));
       
    }
    public function createsop()
    {
        return view('user.tambah');
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

@extends('index') <!-- Merujuk ke template utama -->

@section('content') <!-- Menyediakan isi yield konten -->
<div class="container">
    @if(Auth::user()->role == 'sekretaris' || Auth::user()->role == 'admin')
        <div class="custom-buttons-container">
            <!-- Back button -->
            <a href="javascript:void(0);" onclick="goBack()" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back
            </a>
        </div>
        <form action="{{ route('sekretaris.sop.update', $sop->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menggunakan metode PUT untuk update -->

            <div class="form-group">
                <label for="nama">Nama SOP</label>
                <input type="text" name="nama" class="form-control" value="{{ $sop->nama }}" required>
            </div>
            <div class="form-group">
                <label for="klasifikasi_dokumen">Klasifikasi Dokumen</label>
                <input type="text" name="klasifikasi_dokumen" class="form-control" value="{{ $sop->klasifikasi_dokumen }}" required>
            </div>
            <div class="form-group">
                <label for="nomor_dokumen">Nomor Dokumen</label>
                <input type="text" name="nomor_dokumen" class="form-control" value="{{ $sop->nomor_dokumen }}" required>
            </div>
            <div class="form-group">
                <label for="persetujuan_sekretaris">Persetujuan Sekretaris</label>
                <input type="text" name="persetujuan_sekretaris" class="form-control" value="{{ $sop->persetujuan_sekretaris }}" required>
            </div>
            <div class="form-group">
                <label for="file">Dokumen PDF:</label><br><br>
                <input type="file" name="file" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" required>
                    <option value="" disabled>Pilih Status</option>
                    @foreach($statusOptions as $option)
                        <option value="{{ $option }}" {{ $sop->status == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endif
</div>
@endsection

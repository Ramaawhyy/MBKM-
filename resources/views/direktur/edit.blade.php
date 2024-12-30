@extends('index') <!-- Merujuk ke template utama -->

@section('content') <!-- Menyediakan isi yield konten -->
<div class="container">
    @if(Auth::user()->role == 'superadm')
        <div class="custom-buttons-container">
            <!-- Back button -->
            <a href="javascript:void(0);" onclick="goBack()" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back
            </a>
        </div>
        <form action="{{ route('superadm.sop.update', $sop->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menggunakan metode PUT untuk update -->

            <div class="form-group">
                <label for="file">Dokumen PDF:</label><br><br>
                <input type="file" name="file" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="status_pengesahan_direktur">Status Pengesahan Direktur:</label>
                <input type="text" name="status_pengesahan_direktur" class="form-control" value="{{ $sop->status_pengesahan_direktur }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" class="form-control" value="{{ $sop->status }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endif
</div>
@endsection

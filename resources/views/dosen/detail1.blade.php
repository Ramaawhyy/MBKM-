@extends('template/temp')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <h4 class="mb-4">Doc {{ $administrasi->user->nim }}</h4>

    <!-- Form Detail Administrasi -->
    <form action="{{ route('administrasi.update', $administrasi->id) }}" method="POST">
        @csrf
        @method('POST')

        <!-- Semester -->
        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" name="semester" value="{{ $administrasi->semester }}" class="form-control" readonly>
        </div>

        <!-- Nilai IPK -->
        <div class="mb-3">
            <label for="nilaiIpk" class="form-label">Nilai IPK</label>
            <input type="text" name="nilai_ipk" value="{{ $administrasi->nilai_ipk }}" class="form-control" readonly>
        </div>

        <!-- Dosen Wali -->
        <div class="mb-3">
            <label for="dosenWali" class="form-label">Dosen Wali</label>
            <input type="text" name="dosen_wali" value="{{ $administrasi->dosen_wali }}" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="dosenWali" class="form-label">Kegiatan MBKM</label>
            <input type="text" name="dosen_wali" value="{{ $administrasi->program_mbkm }}" class="form-control" readonly>
        </div>

        <!-- Note Administrasi -->
        <div class="mb-3">
            <label for="note1" class="form-label">Note Administrasi</label>
            <textarea name="note1" class="form-control">{{ $administrasi->note1 }}</textarea>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
        </div>
    </form>

    <!-- Links for Transkrip Nilai -->
    <div class="mt-4">
        <a href="{{ route('administrasi.view_pdf', $administrasi->id) }}" class="btn btn-primary me-2">Lihat</a>
        <a href="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}" class="btn btn-success" download>Unduh</a>
    </div>
</div>
@endsection

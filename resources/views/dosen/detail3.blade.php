@extends('template/temp')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <h4 class="mb-4">Doc {{ $administrasi->user->nim }}</h4>

    <!-- Form Detail Administrasi -->
    <form action="{{ route('administrasi.update3', $administrasi->id) }}" method="POST">
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

        <!-- Transkrip Nilai -->
        <div class="mb-3">
            <label for="transkripNilai" class="form-label">Transkrip Nilai</label>
            <div class="d-flex gap-2">
                <a href="{{ route('administrasi.view_pdf', $administrasi->id) }}" class="btn btn-primary">Lihat</a>
                <a href="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}" class="btn btn-success" download>Unduh</a>
            </div>
        </div>

        <!-- Program MBKM -->
        <div class="mb-3">
            <label for="programMbkm" class="form-label">Program MBKM</label>
            <input type="text" name="program_mbkm" value="{{ $administrasi->program_mbkm }}" class="form-control" readonly>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
        </div>
    </form>
</div>
@endsection

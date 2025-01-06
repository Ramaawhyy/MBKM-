@extends('template/tempdetailuser')

@section('content')
<style>
    .form-label {
    font-weight: bold;
}
.alert {
    background-color: #ffecec;
    color: #d9534f;
}

</style>
<div class="container mt-5">
    <!-- Header -->
    <h4 class="mb-4">Doc {{ $administrasi->user->nim }}</h4>

    <!-- Informasi Administrasi -->
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <h5 class="mb-3">Detail Administrasi</h5>
                <div class="row">
                    <div class="col-md-6">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester" value="Semester {{ $administrasi->semester }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nilaiIpk" class="form-label">Nilai IPK</label>
                        <input type="text" class="form-control" id="nilaiIpk" value="{{ $administrasi->nilai_ipk }}" readonly>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="dosenWali" class="form-label">Dosen Wali</label>
                        <input type="text" class="form-control" id="dosenWali" value="{{ $administrasi->dosen_wali }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="namaDosenWali" class="form-label">Nama Wali Dosen</label>
                        <input type="text" class="form-control" id="namaDosenWali" value="{{ $administrasi->nama_dosen_wali }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penolakan -->
    <div class="row">
        <div class="col-md-12">
            <h5 class="mb-3">Penolakan</h5>
            <div class="card border-danger" style="border-radius: 10px;">
                <div class="card-body">
                    <p class="mb-1"><strong>Nama Wali Dosen:</strong> {{ $administrasi->dosen_wali }}</p>
                    <p class="mb-3"><strong>Wali Dosen:</strong> {{ $administrasi->nama_dosen_wali }}</p>
                    <div class="alert alert-danger" style="border-radius: 10px;">
                        <strong>Note:</strong> {{ $administrasi->note1 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

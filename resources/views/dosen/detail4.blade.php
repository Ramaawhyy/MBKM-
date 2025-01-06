@extends('template/temp')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <h4 class="mb-4">Doc {{ $administrasi->user->nim }}</h4>

    <!-- Detail Administrasi -->
    <div class="mb-3">
        <label for="semester" class="form-label">Semester</label>
        <input type="text" name="semester" value="{{ $administrasi->semester }}" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="nilai_ipk" class="form-label">Nilai IPK</label>
        <input type="text" name="nilai_ipk" value="{{ $administrasi->nilai_ipk }}" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="dosen_wali" class="form-label">Dosen Wali</label>
        <input type="text" name="dosen_wali" value="{{ $administrasi->dosen_wali }}" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="program_mbkm" class="form-label">Program MBKM</label>
        <input type="text" name="program_mbkm" value="{{ $administrasi->program_mbkm }}" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
        <div class="d-flex flex-wrap gap-2">
            <input type="text" name="mata_kuliah_1" value="{{ $administrasi->mata_kuliah_1 }}" class="form-control" style="width: 18%;" readonly>
            <input type="text" name="mata_kuliah_2" value="{{ $administrasi->mata_kuliah_2 }}" class="form-control" style="width: 18%;" readonly>
            <input type="text" name="mata_kuliah_3" value="{{ $administrasi->mata_kuliah_3 }}" class="form-control" style="width: 18%;" readonly>
            <input type="text" name="mata_kuliah_4" value="{{ $administrasi->mata_kuliah_4 }}" class="form-control" style="width: 18%;" readonly>
            <input type="text" name="mata_kuliah_5" value="{{ $administrasi->mata_kuliah_5 }}" class="form-control" style="width: 18%;" readonly>
        </div>
    </div>

    <div class="mb-3">
        <label for="dosen_nama" class="form-label">Nama Dosen</label>
        <input type="text" name="dosen_nama" value="{{ $administrasi->dosen_wali }}" class="form-control" readonly>
    </div>

    <!-- Note Administrasi -->
    <div class="mb-3">
        <label for="note3" class="form-label">Note Administrasi</label>
        <textarea name="note3" class="form-control" readonly>{{ $administrasi->note3 }}</textarea>
    </div>

    <!-- Links for Transkrip Nilai -->
    <div class="d-flex gap-3 mt-4">
        <a href="{{ route('administrasi.view_pdf', $administrasi->id) }}" class="btn btn-primary">Lihat</a>
        <a href="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}" class="btn btn-success" download>Unduh</a>
    </div>
</div>
@endsection

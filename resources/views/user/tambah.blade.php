@extends('template/temp1') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'user')
        <div class="custom-buttons-container">
            <!-- Back button -->
        </div>
        <form action="{{ route('administrasi.store') }}" method="post" enctype="multipart/form-data">
            @csrf
           <div class="form-group">
    <label for="semester">Semester</label>
    <select name="semester" class="form-control" required>
        <option value="" disabled selected>Pilih Semester</option>
        @for ($i = 1; $i <= 8; $i++)
            <option value="Semester {{ $i }}">Semester {{ $i }}</option>
        @endfor
    </select>
</div>
            <div class="form-group">
                <label for="nilai_ipk">Nilai IPK</label>
                <input type="text" name="nilai_ipk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dosen_wali">Dosen Wali</label>
                <select name="dosen_wali" class="form-control" required>
                    <option value="" disabled selected>Pilih Dosen Wali</option>
                    <!-- Add options for Dosen Wali here -->
                    <option value="Dosen A">Dosen A</option>
                    <option value="Dosen B">Dosen B</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transkrip_nilai">Transkrip Nilai:</label><br><br>
                <input type="file" name="transkrip_nilai" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endif
</div>
@endsection
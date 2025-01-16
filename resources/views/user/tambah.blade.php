@extends('template/temp1') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'user')
        <div class="custom-buttons-container">
            <!-- Back button -->
        </div>

        @if($pendingDataExists)
            <div class="alert alert-info">
                Data sedang diproses.
            </div>
        @else
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
                    <label for="nilai_ipk">Nilai IPK (Contoh 3,50)</label>
                    <input type="number" name="nilai_ipk" class="form-control" min="1.00" max="4.00" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="dosen_wali">Dosen Wali</label>
                    <select name="dosen_wali" class="form-control" required>
                        <option value="" disabled selected>Pilih Dosen Wali</option>
                        @foreach($dosenList as $dosen)
                            <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="program_mbkm">Program MBKM</label>
                         <input type="text" name="program_mbkm" class="form-control" required>
                   
                </div>
                <div class="form-group">
                    <label for="transkrip_nilai">Transkrip Nilai:</label><br><br>
                    <input type="file" name="transkrip_nilai" id="transkrip_nilai" accept=".pdf" required>
                    <small class="form-text text-muted">Maksimal ukuran file: 5MB</small>
                </div>
                <button type="submit" class="btn btn-primary" onclick="return validateFileSize()">Simpan</button>
            </form>
        @endif

        <script>
            function validateFileSize() {
                const fileInput = document.getElementById('transkrip_nilai');
                const file = fileInput.files[0];
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes

                if (file && file.size > maxSize) {
                    alert('Ukuran file melebihi 5MB. Silakan pilih file yang lebih kecil.');
                    return false;
                }
                return true;
            }
        </script>
    @endif
</div>
@endsection
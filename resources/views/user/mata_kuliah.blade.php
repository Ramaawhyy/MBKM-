@extends('template/tempdetailuser') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'user')
        <div class="custom-buttons-container">
            <!-- Back button -->
        </div>

        @if(!$administrasiExists)
            <div class="alert alert-warning">
                Isi dahulu data administrasi.
            </div>
        @elseif($administrasiPending)
            <div class="alert alert-info">
                Data administrasi sedang diproses.
            </div>
        @elseif($ekuivalensiPending)
            <div class="alert alert-info">
                Data ekuivalensi sedang diproses.
            </div>
        @elseif($canSubmitForm)
            <form action="{{ route('administrasi.storeMataKuliah') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama_penyelenggara">Nama Penyelenggara</label>
                    <input type="text" name="nama_penyelenggara" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="number" name="no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                    <textarea name="deskripsi_kegiatan" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="capaian_pembelajaran">Capaian Pembelajaran</label>
                    <textarea name="capaian_pembelajaran" class="form-control" rows="3" required></textarea>
                </div>
                @for ($i = 1; $i <= 5; $i++)
                    <div class="form-group">
                        <label for="mata_kuliah_{{ $i }}">Mata Kuliah {{ $i }}</label>
                        <input type="text" name="mata_kuliah_{{ $i }}" class="form-control" required>
                    </div>
                @endfor
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        @endif
    @endif
</div>
@endsection
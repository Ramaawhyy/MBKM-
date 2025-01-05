@extends('template/temp1') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'user')
        <div class="custom-buttons-container">
            <!-- Back button -->
        </div>
     <form action="{{ route('administrasi.storeMataKuliah') }}" method="post">
    @csrf
    <!-- Existing form fields -->
    @for ($i = 1; $i <= 5; $i++)
        <div class="form-group">
            <label for="mata_kuliah_{{ $i }}">Mata Kuliah {{ $i }}</label>
            <select name="mata_kuliah_{{ $i }}" class="form-control">
                <option value="" disabled selected>Pilih Program Mata Kuliah {{ $i }}</option>
                @for ($j = 1; $j <= 5; $j++)
                    <option value="Mata Kuliah {{ $j }}">Mata Kuliah {{ $j }}</option>
                @endfor
                <option value="-">-</option>
            </select>
        </div>
    @endfor
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    @endif
</div>
@endsection
@extends('template/tempdetailuser')
<!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'user')
        <div class="custom-buttons-container">
            <!-- Back button -->
        </div>
       <form action="{{ route('administrasi.storeProgramMbkm') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Existing form fields -->
    <div class="form-group">
        <label for="program_mbkm">Program MBKM</label>
        <select name="program_mbkm" class="form-control" required>
            <option value="" disabled selected>Pilih Program MBKM</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="Program MBKM {{ $i }}">Program MBKM {{ $i }}</option>
            @endfor
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    @endif
</div>
@endsection
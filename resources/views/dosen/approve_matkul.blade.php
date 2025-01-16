@extends('template/temp') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'dosen' || Auth::user()->role == 'admin')
        <div class="custom-buttons-container">
            <!-- Back button -->
        </div>
      <h1>Daftar Kegiatan</h1>
<br>
<table class="table table-bordered">
  <thead>
      <tr>
        <th>No</th>
        <th>Jenis Kegiatan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
   @foreach ($administrasiData as $index => $administrasi)
    @if ($administrasi->status3 === 'waiting')
     @if(Auth::user()->role == 'admin' || ($administrasi->dosen_wali === Auth::user()->name && Auth::user()->role == 'dosen'))
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm ?: 'Belum Terisi' }}</td>
                <td>{{ $administrasi->status3 }}</td> <!-- Status -->
                <td>
                   <a href="{{ route('dosen.detail3', $administrasi->id) }}" class="btn btn-info">Detail </a>
                
                    </a>
                </td>
            </tr>
            
@endif
 @endif
        @endforeach

</tbody>
</table>
    @endif
</div>
@endsection
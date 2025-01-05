@extends('template/temp1') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'user')
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
     @if($administrasi->user_id === Auth::id())
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                <td>{{ $administrasi->status }}</td> <!-- Status -->
                <td>
                    <a href="{{ route('administrasi.show', $administrasi->id) }}" class="btn btn-info btn-xs">
                        Detail
                    </a>
                </td>
            </tr>
            <tr> 
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                <td>{{ $administrasi->status2 }}</td> <!-- Status -->
                <td>
                    <a href="{{ route('administrasi.show', $administrasi->id) }}" class="btn btn-info btn-xs">
                        Detail
                    </a>
                </td>
            </tr>
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                <td>{{ $administrasi->status3 }}</td> <!-- Status -->
                <td>
                    <a href="{{ route('administrasi.show', $administrasi->id) }}" class="btn btn-info btn-xs">
                        Detail
                    </a>
                </td>
            </tr>
               @endif
        @endforeach

</tbody>
</table>
    @endif
</div>
@endsection
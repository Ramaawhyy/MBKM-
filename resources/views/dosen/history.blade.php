@extends('template/temp') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    @if(Auth::user()->role == 'dosen')
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
   
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                <td>{{ $administrasi->created_at }}</td>
                <td>{{ $administrasi->status }}</td> <!-- Status -->
                <td>
                    <a href="{{ route('dosen.detail4', $administrasi->id) }}" class="btn btn-info">Detail </a>
                 
                    </a>
                </td>
            </tr>
            <tr> 
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                 <td>{{ $administrasi->created_at }}</td>
                <td>{{ $administrasi->status2 }}</td> <!-- Status -->
                <td>
                   <a href="{{ route('dosen.detail4', $administrasi->id) }}" class="btn btn-info">Detail </a>
            
                    </a>
                </td>
            </tr>
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                 <td>{{ $administrasi->created_at }}</td>
                <td>{{ $administrasi->status3 }}</td> <!-- Status -->
                <td>
                    <a href="{{ route('dosen.detail4', $administrasi->id) }}" class="btn btn-info">Detail </a>
                  
                    </a>
                </td>
            </tr>
              
        @endforeach


</tbody>
</table>
    @endif
</div>
@endsection
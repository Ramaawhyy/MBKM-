@extends('template/temp') <!-- Merujuk ke template utama -->

@section('content')
<style>
    .status-approve {
        background-color: green;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-waiting {
        background-color: yellow;
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-rejected {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .status-unknown {
        background-color: grey;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }
</style>
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
        <th>Date</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
      @foreach ($administrasiData as $index => $administrasi)
     @if(
        ($administrasi->status !== null && in_array($administrasi->status, ['approve', 'rejected'])) 
    )
        <tr>
            <td>{{ $index + 1 }}</td> <!-- Sequential number -->
            <td>{{ $administrasi->program_mbkm ?: 'Belum Terisi' }}</td>
            <td>{{ $administrasi->created_at }}</td>
            <td>
                <span class="
                    @if($administrasi->status == 'approve') status-approve 
                    @elseif($administrasi->status == 'waiting') status-waiting 
                    @elseif($administrasi->status == 'null') status-waiting 
                    @elseif($administrasi->status == 'rejected') status-rejected 
                    @else status-unknown @endif">
                    {{ $administrasi->status }}
                </span>
            </td>
            <td>
                <a href="{{ route('dosen.detail4', $administrasi->id) }}" class="btn btn-info">Detail</a>
            </td>
        </tr>
        @endif
        @endforeach
          @foreach ($administrasiData as $index => $administrasi)
     @if(
     
        ($administrasi->status2 !== null && in_array($administrasi->status2, ['approve', 'rejected'])) 
       
    )
        <tr> 
            <td>{{ $index + 1 }}</td> <!-- Sequential number -->
            <td>{{ $administrasi->program_mbkm ?: 'Belum Terisi' }}</td>
            <td>{{ $administrasi->created_at }}</td>
            <td>
                <span class="
                    @if($administrasi->status2 == 'approve') status-approve 
                    @elseif($administrasi->status2 == 'waiting') status-waiting 
                    @elseif($administrasi->status2 == 'null') status-waiting 
                    @elseif($administrasi->status2 == 'rejected') status-rejected 
                    @else status-unknown @endif">
                    {{ $administrasi->status2 }}
                </span>
            </td>
            <td>
                <a href="{{ route('dosen.detail4', $administrasi->id) }}" class="btn btn-info">Detail</a>
            </td>
        </tr>
        @endif
        @endforeach
              @foreach ($administrasiData as $index => $administrasi)
     @if(
      
        ($administrasi->status3 !== null && in_array($administrasi->status3, ['approve', 'rejected']))
    )
        <tr>
            <td>{{ $index + 1 }}</td> <!-- Sequential number -->
            <td>{{ $administrasi->program_mbkm ?: 'Belum Terisi' }}</td>
            <td>{{ $administrasi->created_at }}</td>
            <td>
                <span class="
                    @if($administrasi->status3 == 'approve') status-approve 
                    @elseif($administrasi->status3 == 'waiting') status-waiting 
                    @elseif($administrasi->status3 == 'null') status-waiting 
                    @elseif($administrasi->status3 == 'rejected') status-rejected 
                    @else status-unknown @endif">
                    {{ $administrasi->status3 }}
                </span>
            </td>
            <td>
                <a href="{{ route('dosen.detail4', $administrasi->id) }}" class="btn btn-info">Detail</a>
            </td>
        </tr>
    @endif
@endforeach


</tbody>
</table>
    @endif
</div>
@endsection
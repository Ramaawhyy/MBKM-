@extends('template/temp2') <!-- Merujuk ke template utama -->

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
    @if(Auth::user()->role == 'superadm')
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
        ($administrasi->status4 !== null && in_array($administrasi->status, ['approve', 'rejected'])) 
    )
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm ?: 'Belum Terisi' }}</td>
                <td>{{ $administrasi->created_at }}</td>
                <td>
                <span class="
                    @if($administrasi->status4 == 'approve') status-approve 
                    @elseif($administrasi->status4 == 'waiting') status-waiting 
                    @elseif($administrasi->status4 == 'null') status-waiting 
                    @elseif($administrasi->status4 == 'rejected') status-rejected 
                    @else status-unknown @endif">
                    {{ $administrasi->status4 }}
                </span>
            </td>
                <td>
                    <a href="{{ route('kaprodi.detail4', $administrasi->id) }}" class="btn btn-info">Detail </a>
                 
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
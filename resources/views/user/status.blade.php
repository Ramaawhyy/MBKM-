@extends('template/temp1') <!-- Merujuk ke template utama -->

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
    <div class="text-center">
        <img src="{{ asset('img/group 32.png') }}" alt="User Status Image">
    </div>
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
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $administrasi->program_mbkm }}</td>
                            <td>
                                <span class="
                                    @if($administrasi->status == 'Approve') status-approve 
                                    @elseif($administrasi->status == 'Waiting') status-waiting 
                                    @elseif($administrasi->status == 'Rejected') status-rejected 
                                    @else status-unknown @endif">
                                    {{ $administrasi->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('administrasi.show', $administrasi->id) }}" class="btn btn-info btn-xs">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <tr> 
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $administrasi->program_mbkm }}</td>
                            <td>
                                <span class="
                                    @if($administrasi->status2 == 'Approve') status-approve 
                                    @elseif($administrasi->status2 == 'Waiting') status-waiting 
                                    @elseif($administrasi->status2 == 'Rejected') status-rejected 
                                    @else status-unknown @endif">
                                    {{ $administrasi->status2 }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('administrasi.show', $administrasi->id) }}" class="btn btn-info btn-xs">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $administrasi->program_mbkm }}</td>
                            <td>
                                <span class="
                                    @if($administrasi->status3 == 'Approve') status-approve 
                                    @elseif($administrasi->status3 == 'Waiting') status-waiting 
                                    @elseif($administrasi->status3 == 'Rejected') status-rejected 
                                    @else status-unknown @endif">
                                    {{ $administrasi->status3 }}
                                </span>
                            </td>
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

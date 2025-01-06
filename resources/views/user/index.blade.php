@extends('template.tempuser') 

@section('content')
                    <div class="card">
                      <div class="card-body">
                      @if(Auth::user()->role == 'user')
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
   
            <tr>
                <td>{{ $index + 1 }}</td> <!-- Sequential number -->
                <td>{{ $administrasi->program_mbkm }}</td> <!-- Jenis Kegiatan -->
                <td>{{ $administrasi->created_at }}</td>
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
                 <td>{{ $administrasi->created_at }}</td>
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
                 <td>{{ $administrasi->created_at }}</td>
                <td>{{ $administrasi->status3 }}</td> <!-- Status -->
                <td>
                    <a href="{{ route('administrasi.show', $administrasi->id) }}" class="btn btn-info btn-xs">
                        Detail
                    </a>
                </td>
            </tr>
              
        @endforeach

</tbody>
</table>
                      </div>
                    </div>
                  </div>
                          </div>
                        </div>

          <!-- row end -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        
@else
  
  @endif
@endsection
@section('cardatas')
<div class="col-md-4 grid-margin">
  <div class="card text-white bg-success" style="background-image: url('{{ asset('img/hijau.png') }}'); border-radius: 20px; height: 80px; background-size: cover; background-position: center;">
      <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
          <h5 class="card-title" style="margin: 0;">Approved</h5>
          <span class="badge badge-pill bg-dark" style="padding: 10px 15px; font-size: 16px;">{{ isset($approvedCount) ? $approvedCount : 0 }}</span>
      </div>
  </div>
</div>

<div class="col-md-4 grid-margin">
<div class="card text-white bg-warning" style="background-image: url('{{ asset('img/kuning.png') }}'); border-radius: 20px; height: 80px; background-size: cover; background-position: center;">
    <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
        <h5 class="card-title" style="margin: 0;">Waiting</h5>
        <span class="badge badge-pill bg-dark" style="padding: 10px 15px; font-size: 16px;">{{ isset($waitingCount) ? $waitingCount : 0 }}</span>
    </div>
</div>
</div>

<div class="col-md-4 grid-margin">
<div class="card text-white bg-danger" style="background-image: url('{{ asset('img/merah.png') }}'); border-radius: 20px; height: 80px; background-size: cover; background-position: center;">
  <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
      <h5 class="card-title" style="margin: 0;">Rejected</h5>
      <span class="badge badge-pill bg-dark" style="padding: 10px 15px; font-size: 16px;">{{ isset($rejectedCount) ? $rejectedCount : 0 }}</span>
  </div>
</div>
</div>
@endsection
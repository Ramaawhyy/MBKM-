@extends('template/temp') <!-- Merujuk ke template utama -->

@section('content')
   
                    <div class="card">
                      <div class="card-body">
                      @if(Auth::user()->role == 'dosen')
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
                      </div>
                    </div>
                  </div>
                          </div>
                        </div>

          <!-- row end -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
     @endif  
     @endsection  
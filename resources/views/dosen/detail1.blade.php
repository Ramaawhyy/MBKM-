@extends('index')

@section('content')
<div class="container">
     <h3> Doc {{ $administrasi->user->nim }}</h3>
    <h2>Detail Administrasi</h2>

    <form action="{{ route('administrasi.update', $administrasi->id) }}" method="POST">
        @csrf
        @method('POST')
      
            <tr>
                <th>Semester</th>
                <td>
                    <input type="text" name="semester" value="{{ $administrasi->semester }}" class="form-control" readonly>
                </td>
            </tr>
            <tr>
                <th>Nilai IPK</th>
                <td>
                    <input type="text" name="nilai_ipk" value="{{ $administrasi->nilai_ipk }}" class="form-control" readonly>
                </td>
            </tr>
            <tr>
                <th>Dosen Wali</th>
                <td>
                    <input type="text" name="dosen_wali" value="{{ $administrasi->dosen_wali }}" class="form-control" readonly>
                </td>
            </tr>
            
        
        <br>
        <h3>Note Administrasi</h3>
        <textarea name="note1" class="form-control">{{ $administrasi->note1 }}</textarea>
        
        <br><br>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
        <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
    </form>

    <!-- Add links to view and download the PDF -->
    <br><br>
    <a href="{{ route('administrasi.view_pdf', $administrasi->id) }}" class="btn btn-secondary">View Transkrip Nilai</a>
    <a href="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}" class="btn btn-secondary" download>Download Transkrip Nilai</a>
</div>
@endsection
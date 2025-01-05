@extends('template/temp1')

@section('content')
<div class="container">
     <h3> Doc {{ $administrasi->user->nim }}</h3>
    <h2>Detail Administrasi</h2>
    <table class="table">
       
        <tr>
            <th>Semester</th>
            <td>{{ $administrasi->semester }}</td>
        </tr>
        <tr>
            <th>Nilai IPK</th>
            <td>{{ $administrasi->nilai_ipk }}</td>
        </tr>
        <tr>
            <th>Dosen Wali</th>
            <td>{{ $administrasi->dosen_wali }}</td>
        </tr>
        <tr>
            <th>Nama Wali Dosen</th>
            <td>{{ $administrasi->nama_dosen_wali }}</td>
        </tr>
       </table>
       <br>
    <h3> Note Administrasi</h3>
          
              
                <td>{{ $administrasi->note1 }}</td>
           
            <br>
             <br>
     <h3> Note Pemilihan Kegiatan</h3>
           
                
                <td>{{ $administrasi->note2 }}</td>
            
            <br>
             <br>
     <h3> Note Mata Kuliah Ekivalensi</h3>
            <tr>
            
                <td>{{ $administrasi->note3 }}</td>
            </tr>
        
    
</div>
@endsection
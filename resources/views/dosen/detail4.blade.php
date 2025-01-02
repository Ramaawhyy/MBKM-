@extends('index')

@section('content')
<div class="container">
    <h3> Doc {{ $administrasi->user->nim }}</h3>
    <h2>Detail Administrasi</h2>

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
              <th>Program MBKM</th>
                <td>
                    <input type="text" name="program_mbkm" value="{{ $administrasi->program_mbkm }}" class="form-control" readonly>
                </td>
            </tr>
            <th>Mata Kuliah</th>
    <tr>
        <td>
                <input type="text" name="dosen_wali" value="{{ $administrasi->mata_kuliah_1 }}" class="form-control" readonly>
        </td>
        <td>
                <input type="text" name="dosen_wali" value="{{ $administrasi->mata_kuliah_2 }}" class="form-control" readonly>
        </td>
        <td>
                <input type="text" name="dosen_wali" value="{{ $administrasi->mata_kuliah_3 }}" class="form-control" readonly>
        </td>
        <td>
                <input type="text" name="dosen_wali" value="{{ $administrasi->mata_kuliah_4 }}" class="form-control" readonly>
        </td>
        <td>
                <input type="text" name="dosen_wali" value="{{ $administrasi->mata_kuliah_5 }}" class="form-control" readonly>
        </td>
         <th>Nama Dosen</th>
                <td>
                                   <input type="text" name="program_mbkm" value="{{ $administrasi->dosen_wali }}" class="form-control" readonly>
                </td>
            </tr>
        
    </tr>
   
        <br>
        <h3>Note Administrasi</h3>
        <textarea name="note3" class="form-control" readonly>{{ $administrasi->note3 }}</textarea>
        

    <!-- Add links to view and download the PDF -->
    <br><br>
    <a href="{{ route('administrasi.view_pdf', $administrasi->id) }}" class="btn btn-secondary">View Transkrip Nilai</a>
    <a href="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}" class="btn btn-secondary" download>Download Transkrip Nilai</a>
</div>
@endsection
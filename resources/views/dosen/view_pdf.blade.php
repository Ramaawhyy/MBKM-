@extends('index')

@section('content')
<div class="container">
    <h2>View Transkrip Nilai</h2>
    <div class="pdf-viewer">
        <iframe src="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}" width="100%" height="600px">
            This browser does not support PDFs. Please download the PDF to view it: 
            <a href="{{ asset('storage/uploads/' . $administrasi->transkrip_nilai) }}">Download PDF</a>
        </iframe>
    </div>
    <br>
    <a href="{{ route('administrasi.detail1', $administrasi->id) }}" class="btn btn-primary">Back to Detail</a>
</div>
@endsection
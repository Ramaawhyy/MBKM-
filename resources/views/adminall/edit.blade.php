@extends('index') <!-- Merujuk ke template utama -->

@section('content') <!-- Menyediakan isi yield konten -->
<div class="container">
    @if(Auth::user()->role == 'admin')

        <div class="custom-buttons-container">
            <a href="javascript:void(0);" onclick="goBack()" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back
            </a>
        </div>
        <form action="{{ route('mr.sop.update', $sop->id) }}" method="post">
            @csrf
            @method('PUT')
    
            <div class="form-group">
                <label for="persetujuan_mr">Persetujuan MR:</label>
                <select name="persetujuan_mr" class="form-control" required>
                    <option value="Setuju" {{ $sop->persetujuan_mr == 'Setuju' ? 'selected' : '' }}>Setuju</option>
                    <option value="Tidak Setuju" {{ $sop->persetujuan_mr == 'Tidak Setuju' ? 'selected' : '' }}>Tidak Setuju</option>
                </select>
            </div>
    
            <button type="submit" class="btn btn-primary">Update Persetujuan MR</button>
        </form>
  
    @endif
</div>
@endsection

@extends('template/temp') <!-- Merujuk ke template utama -->

@section('content')
<div class="container">
    <h1>Tambah User Baru</h1>
    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option value="user">User</option>
                <option value="dosen">Dosen</option>
                <option value="admin">Admin</option>
            </select>
        </div>
          <div class="form-group">
            <label for="name">Nim</label>
            <input type="number" name="nim" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
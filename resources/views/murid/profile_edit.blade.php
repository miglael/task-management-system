@extends('layouts.adminlte')

@section('content')

  <h1 class="mb-4">Edit Profil</h1>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card" style="max-width: 600px;">
    <div class="card-body">

      <form action="{{ route('murid.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
          @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
          <label>Email</label>
          <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <hr>

        <div class="form-group mb-3">
          <label>Password Baru (opsional)</label>
          <input type="password" name="password" class="form-control">
          @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group mb-3">
          <label>Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="form-group mb-3">
          <label>Foto Profil</label>
          <input type="file" name="photo" class="form-control">
          @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>

        <a href="{{ route('murid.profile') }}" class="btn btn-secondary ml-2">Batal</a>
        <a href="{{ route('murid.profile.edit') }}" class="btn btn-warning btn-block">Edit Profil</a>

      </form>

    </div>
  </div>

@endsection
@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Edit Profil Guru</h1>

<div class="card" style="max-width: 600px;">
    <div class="card-body">

        <form action="{{ route('guru.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Password Baru (opsional)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Foto Profil</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('guru.profile') }}" class="btn btn-secondary ml-2">Batal</a>

        </form>

    </div>
</div>

@endsection
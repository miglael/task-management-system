@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Profil Guru</h1>

<div class="row">

    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">

                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{ $user->photo ? asset('storage/' . $user->photo)
                         : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}">
                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center">Guru</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right">{{ $user->email }}</span>
                    </li>

                    <li class="list-group-item">
                        <b>Bergabung</b> <span class="float-right">{{ $user->created_at->format('d M Y') }}</span>
                    </li>
                </ul>

                <a href="{{ route('guru.profile.edit') }}" class="btn btn-primary btn-block">
                    <b>Ubah Profil</b>
                </a>

            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Akun</h3>
            </div>

            <div class="card-body">
                <p><strong>Nama Lengkap:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> Guru</p>
                <p><strong>ID:</strong> {{ $user->id }}</p>
            </div>
        </div>
    </div>

</div>

@endsection
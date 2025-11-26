@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Kumpulkan Tugas: <strong>{{ $assignment->title }}</strong></h1>

<div class="card" style="max-width: 700px;">
    <div class="card-body">

        {{-- Assignment Info --}}
        <p><strong>Deskripsi:</strong></p>
        <p>{{ $assignment->description }}</p>

        <p><strong>Deadline:</strong> {{ $assignment->deadline }}</p>

        <hr>

        {{-- Error Validation --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- FORM SUBMIT FILE --}}
        <form action="{{ route('murid.assignment.submit.store', $assignment->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Upload File Tugas</label>
                <input type="file" name="file" class="form-control" required>
                <small class="text-muted">Format boleh PDF, DOCX, ZIP, atau lainnya.</small>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-upload"></i> Kumpulkan Tugas
            </button>

            <a href="{{ route('murid.assignments') }}" class="btn btn-secondary ml-2">
                Batal
            </a>
        </form>

    </div>
</div>

@endsection
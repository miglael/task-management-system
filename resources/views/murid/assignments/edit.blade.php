@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Edit Tugas: <strong>{{ $assignment->title }}</strong></h1>

<div class="card" style="max-width: 700px;">
    <div class="card-body">

        <p><strong>File Saat Ini:</strong></p>
        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-info btn-sm">
            Download File Lama
        </a>

        <hr>

        <form action="{{ route('murid.assignment.update', $assignment->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Upload File Baru</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <button class="btn btn-primary">Update Tugas</button>
            <a href="{{ route('murid.assignments') }}" class="btn btn-secondary ml-2">Batal</a>

        </form>

    </div>
</div>

@endsection
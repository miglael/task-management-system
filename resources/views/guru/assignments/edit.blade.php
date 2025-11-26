@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Edit Tugas</h1>

<div class="card" style="max-width: 700px;">
    <div class="card-body">

        {{-- Error validation --}}
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

        {{-- FORM EDIT --}}
        <form action="{{ route('guru.assignment.update', $assignment->id) }}" method="POST">
            @csrf

            {{-- Judul --}}
            <div class="form-group mb-3">
                <label>Judul Tugas</label>
                <input type="text" name="title" class="form-control"
                    value="{{ old('title', $assignment->title) }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required>
                {{ old('description', $assignment->description) }}
                </textarea>
            </div>

            {{-- Deadline Tanggal --}}
            <div class="form-group mb-3">
                <label>Tanggal Deadline</label>
                <input type="date" name="deadline_date" class="form-control"
                    value="{{ old('deadline_date', date('Y-m-d', strtotime($assignment->deadline))) }}"
                    required>
            </div>

            {{-- Deadline Jam --}}
            <div class="form-group mb-3">
                <label>Jam Deadline</label>
                <input type="time" name="deadline_time" class="form-control"
                    value="{{ old('deadline_time', date('H:i', strtotime($assignment->deadline))) }}"
                    required>
            </div>

            {{-- Tombol --}}
            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Update Tugas
            </button>

            <a href="{{ route('guru.assignments') }}" class="btn btn-secondary ml-2">
                Batal
            </a>

        </form>

    </div>
</div>

@endsection
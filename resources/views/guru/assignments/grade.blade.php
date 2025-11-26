@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Beri Nilai Submission</h1>

<div class="card" style="max-width: 700px;">
    <div class="card-body">

        {{-- Info Tugas & Murid --}}
        <div class="mb-4">
            <h4><strong>Tugas:</strong> {{ $assignment->title }}</h4>

            <p style="margin: 0;"><strong>Nama Murid:</strong> {{ $submission->murid->name }}</p>
            <p style="margin: 0;"><strong>Waktu Submit:</strong> {{ $submission->submitted_at }}</p>

            <p class="mt-2">
                <strong>File:</strong>
                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                    <i class="fas fa-file"></i> Download File
                </a>
            </p>
        </div>

        <hr>

        {{-- Form beri nilai --}}
        <form action="{{ route('guru.submission.grade.save', $sub->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Nilai (0 - 100)</label>
                <input type="number" name="grade" class="form-control"
                    placeholder="Masukkan nilai" min="0" max="100"
                    value="{{ $submission->grade }}" required>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Nilai
            </button>

            <a href="{{ route('guru.assignment.submissions', $assignment->id) }}"
                class="btn btn-secondary ml-2">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection
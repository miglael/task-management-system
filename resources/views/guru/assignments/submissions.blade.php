@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Submission Tugas: <strong>{{ $assignment->title }}</strong></h1>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Submission Murid</h3>
    </div>

    <div class="card-body p-0">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Murid</th>
                    <th>File</th>
                    <th>Waktu Submit</th>
                    <th>Status</th> <!-- Kolom baru -->
                    <th>Nilai</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($submissions as $sub)
                <tr>
                    {{-- Nama Murid --}}
                    <td>{{ $sub->murid->name ?? 'Tidak ditemukan' }}</td>

                    {{-- File Tugas --}}
                    <td>
                        <a href="{{ asset('storage/' . $sub->file_path) }}" target="_blank" class="btn btn-sm btn-info">
                            <i class="fas fa-file"></i> Download
                        </a>
                    </td>

                    {{-- Waktu Submit --}}
                    <td>{{ $sub->submitted_at }}</td>

                    {{-- Status: Tepat waktu / Terlambat --}}
                    <td>
                        @if($sub->submitted_at > $assignment->deadline)
                        <span class="badge badge-danger">Terlambat</span>
                        @else
                        <span class="badge badge-success">Tepat Waktu</span>
                        @endif
                    </td>

                    {{-- Nilai --}}
                    <td>
                        @if ($sub->grade === null)
                        <span class="badge badge-warning">Belum dinilai</span>
                        @else
                        <span class="badge badge-success">{{ $sub->grade }}</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td>
                        @if ($sub->grade === null)
                        <form action="{{ route('guru.submission.grade.save', $sub->id) }}" method="POST">
                            @csrf

                            <input type="number" name="grade" class="form-control form-control-sm mr-2"
                                placeholder="0 - 100" min="0" max="100" required>

                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm" disabled>
                            Sudah Dinilai
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach

                @if($submissions->count() === 0)
                <tr>
                    <td colspan="6" class="text-center p-3">
                        Belum ada submission dari murid.
                    </td>
                </tr>
                @endif

            </tbody>
        </table>

    </div>
</div>

@endsection
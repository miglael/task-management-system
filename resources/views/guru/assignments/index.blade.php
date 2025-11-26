@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Daftar Tugas Guru</h1>

{{-- Tombol buat tugas baru --}}
<div class="mb-3">
    <a href="{{ route('guru.assignment.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Buat Tugas Baru
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tugas yang Anda Buat</h3>
    </div>

    <div class="card-body p-0">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Deadline</th>
                    <th>Submission</th>
                    <th style="width: 200px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($assignments as $task)
                <tr>
                    <td>{{ $task->title }}</td>

                    <td>{{ \Illuminate\Support\Str::limit($task->description, 40) }}</td>

                    <td>{{ $task->deadline }}</td>

                    <td>
                        <span class="badge badge-info">
                            {{ $task->submissions->count() }} Murid
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('guru.assignment.edit', $task->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <a href="{{ route('guru.assignment.submissions', $task->id) }}"
                            class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Submission
                        </a>

                        <form action="{{ route('guru.assignment.delete', $task->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>

                        </form>

                    </td>
                </tr>
                @endforeach


                {{-- Jika tidak ada tugas --}}
                @if($assignments->count() === 0)
                <tr>
                    <td colspan="5" class="text-center py-3">
                        Belum ada tugas dibuat.
                    </td>
                </tr>
                @endif

            </tbody>
        </table>

    </div>
</div>

@endsection
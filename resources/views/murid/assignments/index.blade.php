@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Daftar Tugas</h1>

<div class="card">
  <div class="card-body p-0">

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Deskripsi</th>
          <th>Deadline</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>

        @foreach($assignments as $a)

        @php
        $submitted = \App\Models\Submission::where('assignment_id', $a->id)
        ->where('murid_id', auth()->id())
        ->exists();
        @endphp

        <tr>
          <td>{{ $a->title }}</td>
          <td>{{ Str::limit($a->description, 40) }}</td>
          <td>{{ $a->deadline }}</td>

          <!-- STATUS -->
          <td>
            @if($submitted)
            <span class="badge badge-success">Sudah Mengumpulkan</span>
            @else
            <span class="badge badge-danger">Belum Mengumpulkan</span>
            @endif
          </td>

          <!-- AKSI -->
          <td>
            @if($submitted)

            {{-- Tombol Edit Ulang --}}
            <a href="{{ route('murid.assignment.edit', $a->id) }}"
              class="btn btn-warning btn-sm">
              Edit
            </a>

            {{-- Tombol Hapus Submission --}}
            <form action="{{ route('murid.assignment.delete', $a->id) }}"
              method="POST" class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus tugas yang dikumpulkan?');">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm">Hapus</button>
            </form>

            @else

            {{-- Tombol Kumpulkan --}}
            <a href="{{ route('murid.assignment.submit', $a->id) }}"
              class="btn btn-primary btn-sm">
              Kumpulkan
            </a>

            @endif
          </td>

        </tr>

        @endforeach

      </tbody>
    </table>

  </div>
</div>

@endsection
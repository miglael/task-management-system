@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Tugas yang Sudah Kamu Kumpulkan</h1>

<div class="card">
  <div class="card-body p-0">

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Judul Tugas</th>
          <th>File</th>
          <th>Tanggal Submit</th>
          <th>Nilai</th>
        </tr>
      </thead>

      <tbody>

        @forelse($submissions as $s)
        <tr>
          <td>{{ $s->assignment->title }}</td>

          <td>
            <a href="{{ asset('storage/' . $s->file_path) }}"
              class="btn btn-info btn-sm" target="_blank">
              Lihat File
            </a>
          </td>

          <td>{{ $s->submitted_at }}</td>

          <td>
            @if($s->grade !== null)
            <span class="badge bg-success">{{ $s->grade }}</span>
            @else
            <span class="badge bg-secondary">Belum dinilai</span>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center py-3">Belum ada submission</td>
        </tr>
        @endforelse

      </tbody>
    </table>

  </div>
</div>

@endsection
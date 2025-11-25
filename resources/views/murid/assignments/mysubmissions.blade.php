@extends('layouts.adminlte')

@section('content')

  <h1>Tugas yang Sudah Kamu Kumpulkan</h1>

  <table class="table table-bordered">
    <tr>
      <th>Judul Tugas</th>
      <th>File</th>
      <th>Tanggal Submit</th>
      <th>Nilai</th>
    </tr>

    @forelse($submissions as $s)
      <tr>
        <td>{{ $s->assignment->title }}</td>

        <td>
          <a href="{{ asset('storage/' . $s->file_path) }}" class="btn btn-info btn-sm" target="_blank">
            Lihat File
          </a>
        </td>

        <td>{{ $s->created_at }}</td>

        <td>
          @if($s->grade)
            <span class="badge bg-success">{{ $s->grade }}</span>
          @else
            <span class="badge bg-secondary">Belum dinilai</span>
          @endif
        </td>
      </tr>

    @empty
      <tr>
        <td colspan="4" class="text-center">Belum ada submission</td>
      </tr>
    @endforelse

  </table>

@endsection
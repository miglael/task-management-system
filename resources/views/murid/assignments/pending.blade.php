@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Tugas yang Belum Kamu Kumpulkan</h1>

<div class="card">
  <div class="card-body p-0">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Judul</th>
          <th>Deadline</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse($pendingAssignments as $a)
        <tr>
          <td>{{ $a->title }}</td>
          <td>{{ $a->deadline }}</td>
          <td>
            <a href="{{ route('murid.assignment.submit', $a->id) }}" class="btn btn-primary btn-sm">Kumpulkan</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center p-3">
            Semua tugas sudah dikumpulkan 🎉
          </td>
        </tr>
        @endforelse
      </tbody>

    </table>

  </div>
</div>

@endsection
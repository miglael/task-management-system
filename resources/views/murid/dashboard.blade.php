@extends('layouts.adminlte')

@section('content')

  <h1 class="mb-4">Dashboard Murid</h1>

  <div class="row">

    <!-- Total Tugas -->
    <div class="col-md-4 mb-3">
      <div class="card text-white" style="background-color:#0099b1;">
        <div class="card-body text-center">
          <h2>{{ $totalAssignments }}</h2>
          <p>Total Tugas</p>
        </div>
        <a href="{{ route('murid.assignments') }}" class="card-footer text-center text-white"
          style="background: rgba(0,0,0,0.1); text-decoration:none;">
          Lihat Semua Tugas <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <!-- Sudah Dikumpulkan -->
    <div class="col-md-4 mb-3">
      <div class="card text-white bg-success">
        <div class="card-body text-center">
          <h2>{{ $submitted }}</h2>
          <p>Sudah Dikumpulkan</p>
        </div>
        <a href="{{ route('murid.mysubmissions') }}" class="card-footer text-center text-white"
          style="background: rgba(0,0,0,0.1); text-decoration:none;">
          Lihat Tugas Saya <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

    <!-- Belum Dikumpulkan -->
    <div class="col-md-4 mb-3">
      <div class="card text-white bg-warning">
        <div class="card-body text-center">
          <h2>{{ $pending }}</h2>
          <p>Belum Dikumpulkan</p>
        </div>
        <a href="{{ route('murid.assignments.pending') }}" class="card-footer text-center text-white"
          style="background: rgba(0,0,0,0.1); text-decoration:none;">
          Lihat Tugas Belum Selesai <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>

  </div>

  {{-- Tugas Terbaru --}}
  <div class="card mt-4">
    <div class="card-header">
      <h3 class="card-title">Tugas Terbaru</h3>
    </div>

    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Judul</th>
            <th>Deadline</th>
            <th>Status</th>
            <th style="width: 150px;">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($latestAssignments as $a)

            @php
              $submission = $a->submissions
                ->where('murid_id', auth()->id())
                ->first();
            @endphp

            <tr>
              <td>{{ $a->title }}</td>
              <td>{{ $a->deadline }}</td>

              {{-- STATUS --}}
              <td>
                @if($submission)
                  <span class="badge badge-success">Sudah Dikumpulkan</span>
                @else
                  <span class="badge badge-warning">Belum Dikumpulkan</span>
                @endif
              </td>

              {{-- Aksi --}}
              <td>
                @if($submission)
                  <a href="{{ route('murid.assignment.edit', $a->id) }}" class="btn btn-sm btn-info">Edit</a>
                @else
                  <a href="{{ route('murid.assignment.submit', $a->id) }}" class="btn btn-sm btn-primary">Kumpulkan</a>
                @endif
              </td>
            </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
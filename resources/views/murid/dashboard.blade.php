@extends('layouts.adminlte')

@section('content')

  <h1 class="mb-4">Dashboard Murid</h1>

  <div class="row">

    {{-- Total Tugas --}}
    <div class="col-md-4">
      <div class="small-box bg-info" style="cursor:pointer;" onclick="window.location='{{ route('murid.assignments') }}'">
        <div class="inner">
          <h3>{{ $totalAssignments }}</h3>
          <p>Total Tugas</p>
        </div>
        <div class="icon">
          <i class="fas fa-book"></i>
        </div>
        <a href="{{ route('murid.assignments') }}" class="small-box-footer">
          Lihat Semua Tugas <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    {{-- Sudah Dikumpulkan --}}
    <div class="col-md-4">
      <div class="small-box bg-success" style="cursor:pointer;"
        onclick="window.location='{{ route('murid.mysubmissions') }}'">
        <div class="inner">
          <h3>{{ $submitted }}</h3>
          <p>Sudah Dikumpulkan</p>
        </div>
        <div class="icon">
          <i class="fas fa-check"></i>
        </div>
        <a href="{{ route('murid.mysubmissions') }}" class="small-box-footer">
          Lihat Tugas Saya <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    {{-- Belum Dikumpulkan --}}
    <div class="col-lg-4 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $pending }}</h3>
          <p>Belum Dikumpulkan</p>
        </div>
        <div class="icon">
          <i class="fas fa-exclamation"></i>
        </div>
        <a href="{{ route('murid.assignments.pending') }}" class="small-box-footer">
          Lihat Tugas Belum Selesai <i class="fas fa-arrow-circle-right"></i>
        </a>
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
              <th style="width:120px;">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @foreach($latestAssignments as $a)
              <tr>
                <td>{{ $a->title }}</td>
                <td>{{ $a->deadline }}</td>

                <td>
                  @php
                    $submittedTask = $a->submissions
                      ->where('murid_id', auth()->id())
                      ->first();
                  @endphp

                  @if($submittedTask)
                    <span class="badge badge-success">Sudah Dikumpulkan</span>
                  @else
                    <span class="badge badge-warning">Belum</span>
                  @endif
                </td>

                <td>
                  @if($submittedTask)
                    <a href="{{ route('murid.assignment.edit', $a->id) }}" class="btn btn-info btn-sm">Edit</a>
                  @else
                    <a href="{{ route('murid.assignment.submit', $a->id) }}" class="btn btn-primary btn-sm">Kumpulkan</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>

@endsection
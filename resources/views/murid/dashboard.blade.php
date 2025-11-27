@extends('layouts.adminlte')

@section('content')

  <h1 class="mb-4">Dashboard Murid</h1>

  <div class="row">

    <div class="col-lg-4 col-12">
      <div class="small-box" style="background-color:#0099b1; color:white;">
        <div class="inner">
          <h3>{{ $totalAssignments }}</h3>
          <p>Total Tugas</p>
        </div>
        <div class="icon">
          <i class="fas fa-book"></i>
        </div>
        <a href="{{ route('murid.assignments') }}" class="small-box-footer" style="color:white;">
          Lihat Semua Tugas <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-4 col-12">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $submitted }}</h3>
          <p>Sudah Dikumpulkan</p>
        </div>
        <div class="icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <a href="{{ route('murid.mysubmissions') }}" class="small-box-footer">
          Lihat Tugas Saya <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-4 col-12">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $pending }}</h3>
          <p>Belum Dikumpulkan</p>
        </div>
        <div class="icon">
          <i class="fas fa-exclamation-circle"></i>
        </div>
        <a href="{{ route('murid.assignments.pending') }}" class="small-box-footer">
          Lihat Tugas Belum Selesai <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

  </div>


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

              <td>
                @if($submission)
                  <span class="badge badge-success">Sudah Dikumpulkan</span>
                @else
                  <span class="badge badge-warning">Belum Dikumpulkan</span>
                @endif
              </td>

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
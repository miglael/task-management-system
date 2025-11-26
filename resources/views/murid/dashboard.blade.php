@extends('layouts.adminlte')

@section('content')
<h1>Dashboard Murid</h1>

<div class="row">

  <div class="col-lg-4 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $totalAssignments }}</h3>
        <p>Total Tugas</p>
      </div>
      <div class="icon"><i class="fas fa-book"></i></div>
    </div>
  </div>

  <div class="col-lg-4 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $submitted }}</h3>
        <p>Sudah Dikumpulkan</p>
      </div>
      <div class="icon"><i class="fas fa-check"></i></div>
    </div>
  </div>

  <div class="col-lg-4 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $pending }}</h3>
        <p>Belum Dikumpulkan</p>
      </div>
      <div class="icon"><i class="fas fa-exclamation"></i></div>
    </div>
  </div>

</div>
@endsection
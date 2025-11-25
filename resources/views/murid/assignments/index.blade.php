@extends('layouts.adminlte')

@section('content')

  <h1>Daftar Tugas</h1>

  <table class="table table-bordered">
    <tr>
      <th>Judul</th>
      <th>Deskripsi</th>
      <th>Deadline</th>
      <th>Aksi</th>
    </tr>

    @foreach($assignments as $a)
      <tr>
        <td>{{ $a->title }}</td>
        <td>{{ $a->description }}</td>
        <td>{{ $a->deadline }}</td>
        <td>
          <a href="{{ route('murid.assignment.submit', $a->id) }}" class="btn btn-primary btn-sm">
            Kumpulkan
          </a>
        </td>
      </tr>
    @endforeach

  </table>

@endsection
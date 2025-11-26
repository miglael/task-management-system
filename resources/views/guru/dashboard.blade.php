@extends('layouts.adminlte')

@section('content')

<h1 class="mb-4">Dashboard Guru</h1>

<div class="row">

    <div class="col-lg-4 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalAssignments }}</h3>
                <p>Total Tugas Dibuat</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="{{ route('guru.assignments') }}" class="small-box-footer">
                Lihat Semua Tugas <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalSubmissions }}</h3>
                <p>Total Submission Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-upload"></i>
            </div>
            <a href="{{ route('guru.assignments') }}" class="small-box-footer">
                Cek Tugas Masuk <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $ungraded }}</h3>
                <p>Perlu Dinilai</p>
            </div>
            <div class="icon">
                <i class="fas fa-star"></i>
            </div>
            <a href="{{ route('guru.assignments') }}" class="small-box-footer">
                Nilai Submission <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>


{{-- Daftar Tugas Terbaru --}}
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
                    <th>Total Submission</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach(App\Models\Assignment::where('guru_id', auth()->id())->orderBy('created_at', 'desc')->take(5)->get() as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>{{ $task->submissions->count() }}</td>
                    <td>
                        <a href="{{ route('guru.assignment.submissions', $task->id) }}" class="btn btn-sm btn-info">
                            Lihat Submission
                        </a>
                    </td>
                </tr>
                @endforeach

                @if(App\Models\Assignment::where('guru_id', auth()->id())->count() == 0)
                <tr>
                    <td colspan="4" class="text-center py-3">Belum ada tugas dibuat.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| LOGIN MANUAL (ADMIN LTE LOGIN PAGE)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore']);


/*
|--------------------------------------------------------------------------
| DEFAULT REDIRECT KE LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| GURU ROUTES (ROLE: guru)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:guru'])->group(function () {

    // Dashboard Guru
    Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');

    Route::get('/guru/profile', [GuruController::class, 'profile'])->name('guru.profile');
    Route::get('/guru/profile/edit', [GuruController::class, 'editProfile'])->name('guru.profile.edit');
    Route::post('/guru/profile/update', [GuruController::class, 'updateProfile'])->name('guru.profile.update');


    // Daftar tugas
    Route::get('/guru/assignments', [GuruController::class, 'assignments'])->name('guru.assignments');

    // Create tugas
    Route::get('/guru/assignment/create', [GuruController::class, 'create'])->name('guru.assignment.create');
    Route::post('/guru/assignment/store', [GuruController::class, 'store'])->name('guru.assignment.store');

    // Edit tugas
    Route::get('/guru/assignment/{id}/edit', [GuruController::class, 'edit'])->name('guru.assignment.edit');
    Route::post('/guru/assignment/{id}/update', [GuruController::class, 'update'])->name('guru.assignment.update');

    // Delete tugas
    Route::delete('/guru/assignment/{id}/delete', [GuruController::class, 'destroy'])->name('guru.assignment.delete');

    // Lihat submissions
    Route::get('/guru/assignment/{id}/submissions', [GuruController::class, 'submissions'])->name('guru.assignment.submissions');

    // Beri nilai
    Route::get('/guru/submission/{id}/grade', [GuruController::class, 'gradePage'])
        ->name('guru.submission.grade.page');

    Route::post('/guru/submission/{id}/grade/save', [GuruController::class, 'gradeSubmission'])
        ->name('guru.submission.grade.save');
});



/*
|--------------------------------------------------------------------------
| MURID ROUTES (ROLE: murid)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:murid'])->group(function () {

    // Dashboard murid
    Route::get('/murid/dashboard', [MuridController::class, 'dashboard'])->name('murid.dashboard');

    // Daftar tugas
    Route::get('/murid', [MuridController::class, 'index'])->name('murid.assignments');

    // Profil
    Route::get('/murid/profile', [MuridController::class, 'profile'])->name('murid.profile');

    Route::get('/murid/profile/edit', [MuridController::class, 'editProfile'])->name('murid.profile.edit');
    Route::post('/murid/profile/update', [MuridController::class, 'updateProfile'])->name('murid.profile.update');

    // Submit tugas
    Route::get('/murid/assignment/{id}/submit', [MuridController::class, 'submit'])->name('murid.assignment.submit');
    Route::post('/murid/assignment/{id}/submit/store', [MuridController::class, 'storeSubmission'])->name('murid.assignment.submit.store');

    // Edit Submission
    Route::get('/murid/assignment/{id}/edit', [MuridController::class, 'editSubmission'])
        ->name('murid.assignment.edit');

    // Update Submission
    Route::post('/murid/assignment/{id}/update', [MuridController::class, 'updateSubmission'])
        ->name('murid.assignment.update');

    // Hapus Submission
    Route::delete('/murid/assignment/{id}/delete', [MuridController::class, 'deleteSubmission'])
        ->name('murid.assignment.delete');


    // Submission milik murid
    Route::get('/murid/submissions', [MuridController::class, 'mySubmissions'])->name('murid.mysubmissions');
});

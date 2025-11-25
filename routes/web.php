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
| AUTH (Laravel Breeze / UI / Built-in)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});



/*
|--------------------------------------------------------------------------
| GURU ROUTE (ROLE: guru)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:guru'])->group(function () {

    // Dashboard Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.assignments');

    // Create Assignment
    Route::get('/guru/assignment/create', [GuruController::class, 'create'])->name('guru.assignment.create');
    Route::post('/guru/assignment/store', [GuruController::class, 'store'])->name('guru.assignment.store');

    // Edit Assignment
    Route::get('/guru/assignment/{id}/edit', [GuruController::class, 'edit'])->name('guru.assignment.edit');
    Route::post('/guru/assignment/{id}/update', [GuruController::class, 'update'])->name('guru.assignment.update');

    // Delete Assignment
    Route::delete('/guru/assignment/{id}/delete', [GuruController::class, 'destroy'])->name('guru.assignment.delete');

    // Lihat Submissions
    Route::get('/guru/assignment/{id}/submissions', [GuruController::class, 'submissions'])->name('guru.assignment.submissions');

    // Grade Submission
    Route::post('/guru/submission/{id}/grade', [GuruController::class, 'gradeSubmission'])->name('guru.submission.grade');
});


/*
|--------------------------------------------------------------------------
| MURID ROUTE (ROLE: murid)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:murid'])->group(function () {

    // Dashboard murid: daftar assignment
    Route::get('/murid', [MuridController::class, 'index'])->name('murid.assignments');

    // Submit assignment
    Route::get('/murid/assignment/{id}/submit', [MuridController::class, 'submit'])->name('murid.assignment.submit');
    Route::post('/murid/assignment/{id}/submit/store', [MuridController::class, 'storeSubmission'])->name('murid.assignment.submit.store');

    // Lihat submission pribadi
    Route::get('/murid/submissions', [MuridController::class, 'mySubmissions'])->name('murid.mysubmissions');
});

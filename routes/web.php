<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('applicants.index');
});

Route::get('/applicants', [ProfileController::class, 'index'])->name('applicants.index');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/applicants/create', [ProfileController::class, 'create'])->name('applicants.create');
Route::get('/applicants/{id}', [ProfileController::class, 'edit'])->name('applicants.edit');
Route::post('/applicants/', [ProfileController::class, 'store'])->name('applicants.store');
Route::put('/applicants/{id}', [ProfileController::class, 'update'])->name('profile.update');
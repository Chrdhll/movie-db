<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Route::get('/',[MovieController::class, 'index']);

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}/{slug}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movie/create', [MovieController::class, 'create'])->middleware('auth');
Route::post('/movie/store', [MovieController::class, 'store'])->middleware('auth');

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
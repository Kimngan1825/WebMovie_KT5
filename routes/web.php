<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;
use App\Http\Controllers\MovieController4;

Route::get('/', [App\Http\Controllers\MovieController4::class, 'index']);

Route::get('/openrouter', [OpenRouterController::class, 'chat']);


Route::get('/movies/create', [MovieController4::class, 'create'])->name('movies.create');
Route::post('/movies/store', [MovieController4::class, 'store'])->name('movies.store');
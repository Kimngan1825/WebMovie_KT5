<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;
use App\Http\Controllers\MovieController1;
use App\Http\Controllers\MovieController;

// Trang chủ hiển thị phim phổ biến
Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

// Trang thể loại phim
Route::get('/theloai/{id}', [App\Http\Controllers\MovieController1::class, 'theloai'])->name('movie.genre');

// Trang chi tiết phim
Route::get('/chitiet/{id}', [App\Http\Controllers\MovieController1::class, 'chitiet'])->name('movie.detail');

//Tìm kiếm phim
Route::post('/timkiem', [MovieController1::class, 'timkiem'])->name('movie.search');

Route::get('/openrouter', [App\Http\Controllers\OpenRouterController::class, 'chat']);

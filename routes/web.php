<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenRouterController;
use App\Http\Controllers\MovieController1;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieController2;

// Trang chủ hiển thị phim phổ biến
Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);

// Trang thể loại phim
Route::get('/theloai/{id}', [App\Http\Controllers\MovieController1::class, 'theloai'])->name('movie.genre');

// Trang chi tiết phim
Route::get('/chitiet/{id}', [App\Http\Controllers\MovieController1::class, 'chitiet'])->name('movie.detail');

// Các route quản lý phim
Route::get('/movie/qlysach', [MovieController2::class, 'movielist'])->name('movielist');
Route::get('/movie/edit/{id}', [MovieController2::class, 'movieedit'])->name('movieedit');
Route::post('/movie/save/{action}', [MovieController2::class, 'moviesave'])->name('moviesave');
Route::post('/movie/delete', [MovieController2::class, 'moviedelete'])->name('moviedelete');

Route::get('/openrouter', [App\Http\Controllers\OpenRouterController::class, 'chat']);

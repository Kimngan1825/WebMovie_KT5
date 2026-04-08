<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController1 extends Controller
{
   //Lọc theo thể loại
   public function theloai($id) {
    $movies = DB::table('movie')
        ->join('movie_genre', 'movie.id', '=', 'movie_genre.id_movie')
        ->where('movie_genre.id_genre', $id) 
        ->orderBy('movie.release_date', 'desc')
        ->limit(12) 
        ->select('movie.*')
        ->get();

    return view('movie.index', compact('movies'));
}

    // Chi tiết phim 
    public function chitiet($id) {
        $movie = DB::table('movie')->where('id', $id)->first(); 
        return view('movie.chitiet', compact('movie'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController2 extends Controller
{
    public function movielist()
    {
        $movies = DB::table('movie')
            ->orderBy('release_date', 'desc')
            ->get();

        return view('movie.qlysach', compact('movies'));
    }

    public function moviesave($action, Request $request)
    {
        $request->validate([
            'movie_name_vn' => ['required', 'string', 'max:200'],
            'movie_name_en' => ['nullable', 'string', 'max:200'],
            'release_date' => ['required', 'date'],
            'vote_average' => ['required', 'numeric'],
            'popularity' => ['required', 'numeric'],
            'genre_id' => ['required', 'integer'],
            'image' => ['nullable', 'image'],
        ]);

        $data = $request->except(['_token']);
        if ($action === 'edit') {
            $data = $request->except(['_token', 'id']);
        }

        if ($request->hasFile('image')) {
            $fileName = $request->input('movie_name_vn') . '_' . rand(1000000, 9999999) . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/movie_image', $fileName);
            $data['image'] = $fileName;
        }

        $message = '';
        if ($action === 'add') {
            DB::table('movie')->insert($data);
            $message = 'Thêm phim thành công';
        } elseif ($action === 'edit') {
            $id = $request->id;
            DB::table('movie')->where('id', $id)->update($data);
            $message = 'Cập nhật phim thành công';
        }

        return redirect()->route('movielist')->with('status', $message);
    }

    public function movieedit($id)
    {
        $action = 'edit';
        $genres = DB::table('genre')->get();
        $movie = DB::table('movie')->where('id', $id)->first();

        return view('movie.form', compact('genres', 'action', 'movie'));
    }

    public function moviedelete(Request $request)
    {
        $id = $request->id;
        DB::table('movie')->where('id', $id)->delete();

        return redirect()->route('movielist')->with('status', 'Xóa phim thành công');
    }
}
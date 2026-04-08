<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movie; 

class MovieController4 extends Controller
{
    public function index()
    {
        return view("movie.index");
    }

    public function create()
    {
        return view('movie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_name' => 'required',
            'movie_name_vn' => 'required',
            'release_date' => 'required|date_format:Y-m-d',
            'overview_vn' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'required' => ':attribute không được để trống',
            'date_format' => ':attribute phải đúng định dạng Y-m-d'
        ],[
            'movie_name' => 'Tên tiếng Anh',
            'movie_name_vn' => 'Tên tiếng Việt',
            'release_date' => 'Ngày phát hành',
            'overview_vn' => 'Mô tả',
            'image' => 'Ảnh đại diện'
        ]);

        // Upload ảnh và lấy đường dẫn lưu vào thư mục storage/app/public/images
        $imagePath = $request->file('image')->store('images', 'public');

        // Lưu thông tin thẳng vào Database bằng Query Builder (Không cần Model)
        DB::table('movie')->insert([
            'movie_name'    => $request->movie_name,
            'original_name'    => $request->movie_name,
            'movie_name_vn' => $request->movie_name_vn,
            'release_date'  => $request->release_date,
            'overview_vn'   => $request->overview_vn,
            'image'         => $imagePath,
        ]);

        return back()->with('success', 'Thêm phim thành công!');
    }
}
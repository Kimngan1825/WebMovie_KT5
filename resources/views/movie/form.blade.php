<x-movie-layout>
<div class="panel panel-default" style="width:50%; margin:0 auto;">
     <div class="panel-body">
        @if ($errors->any())
            <div style='color:red; margin:0 auto'>
            <div>
            {{ __('Whoops! Something went wrong.') }}
           </div>
           <ul>
           @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
           </ul>
           </div>
         @endif
        <form action="{{ route('moviesave', ['action' => $action]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @if($action == 'add')
            <div style='text-align:center;font-weight:bold;color:#15c; font-size:18px;'>THÊM THÔNG TIN PHIM</div>
           @else
            <div style='text-align:center;font-weight:bold;color:#15c; font-size:18px;'>SỬA THÔNG TIN PHIM</div>
           @endif

           <label style="margin-top: 15px;">Tên phim (Tiếng Việt)</label>
           <input type='text' class='form-control form-control-sm' name='movie_name_vn' value="{{ $movie->movie_name_vn ?? '' }}">

           <label>Tên phim (Tiếng Anh)</label>
           <input type='text' class='form-control form-control-sm' name='movie_name_en' value="{{ $movie->movie_name_en ?? '' }}">

           <label>Ngày phát hành</label>
           <input type='date' class='form-control form-control-sm' name='release_date' value="{{ $movie->release_date ?? '' }}">

           <label>Đánh giá</label>
           <input type='number' step='0.1' class='form-control form-control-sm' name='vote_average' value="{{ $movie->vote_average ?? '' }}">

           <label>Độ phổ biến</label>
           <input type='number' step='0.1' class='form-control form-control-sm' name='popularity' value="{{ $movie->popularity ?? '' }}">

           <label>Thể loại</label>
           <select name='genre_id' class='form-control form-control-sm'>
            <option value=''>-- Chọn thể loại --</option>
            @php
           $selected = isset($movie->genre_id) ? $movie->genre_id : "";
           @endphp
           @foreach($genres as $row)
           <option value='{{ $row->id }}' {{ $selected == $row->id ? 'selected' : '' }}>
           {{ $row->genre_name_vn ?? $row->name ?? '' }}
           </option>
            @endforeach
            </select>

           <label>Ảnh đại diện</label><br>
           @if($action == 'edit' && !empty($movie->image))
           <img src="{{ asset('storage/movie_image/'.$movie->image) }}" width="100px" class='mb-1' style="border-radius:4px;"/>
            <input type='hidden' value='{{ $movie->id }}' name='id'>
            <div style="margin-top: 10px; margin-bottom: 10px;">
              <small style="color: #999;">Ảnh hiện tại</small>
            </div>
           @endif
            <input type="file" name="image" accept="image/*" class="form-control-file">
            <small style="color: #999;">Định dạng: JPG, PNG. Kích thước tối đa: 5MB</small>

            <div style='text-align:center; margin-top: 20px;'>
              <input type='submit' class='btn btn-primary' value='Lưu'>
              <a href="{{ route('movielist') }}" class="btn btn-secondary" style="margin-left: 10px; background-color: #6c757d; color: white; padding: 6px 15px; border-radius: 3px; text-decoration: none; display: inline-block;">Quay lại</a>
            </div>
         </form>
    </div>
    </div>
</x-movie-layout>

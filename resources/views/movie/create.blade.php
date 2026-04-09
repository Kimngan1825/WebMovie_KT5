<x-movie-layout>
    <x-slot name="title">
        Thêm phim mới
    </x-slot>

    <style>
        .form-container {
            padding: 20px 40px;
            width: 100%;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .form-title {
            text-align: center;
            color: #0056b3; /* Màu xanh nước biển giống ảnh */
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px; /* Khoảng cách giữa các hàng */
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box; /*giúp thẻ input không bị tràn ra ngoài div */
        }
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        textarea.form-control {
            height: 120px;
            resize: vertical;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .text-center {
            text-align: center;
        }
        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }
    </style>

    <div class="form-container">
        <h3 class="form-title">THÊM PHIM MỚI</h3>

        @if(session('success'))
            <p style="color: green; text-align:center; margin-bottom: 15px;">
                {{ session('success') }}
            </p>
        @endif

        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="movie_name">Tên tiếng Anh</label>
                <input type="text" id="movie_name" name="movie_name" class="form-control" value="{{ old('movie_name') }}">
                @error('movie_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="movie_name_vn">Tên tiếng Việt</label>
                <input type="text" id="movie_name_vn" name="movie_name_vn" class="form-control" value="{{ old('movie_name_vn') }}">
                @error('movie_name_vn')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="release_date">Ngày phát hành</label>
                <input type="date" id="release_date" name="release_date" class="form-control" value="{{ old('release_date') }}">
                @error('release_date')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="overview_vn">Mô tả</label>
                <textarea id="overview_vn" name="overview_vn" class="form-control">{{ old('overview_vn') }}</textarea>
                @error('overview_vn')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh đại diện</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" style="padding: 7px;">
                @error('image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group text-center" style="margin-top: 30px;">
                <button type="submit" class="btn-submit">Lưu</button>
            </div>

        </form>
    </div>
</x-movie-layout>
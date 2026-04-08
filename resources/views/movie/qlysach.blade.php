<x-movie-layout>
    <x-slot name="title">Danh sách phim</x-slot>

    <style>
        .movies-section {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            margin: 20px;
        }
        .page-title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }
        .btn-them {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-them:hover {
            background-color: #218838;
        }
        .dataTables_wrapper {
            margin-top: 20px;
        }
        .dataTables_length {
            margin-bottom: 15px;
        }
        .dataTables_filter {
            margin-bottom: 15px;
            text-align: right;
        }
        .dataTables_info {
            margin-top: 15px;
            font-size: 13px;
            color: #666;
        }
        .dataTables_paginate {
            margin-top: 15px;
            text-align: right;
        }
        table.table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        table.table thead {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        table.table thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            border: 1px solid #dee2e6;
        }
        table.table tbody td {
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            vertical-align: middle;
            font-size: 14px;
        }
        table.table tbody tr:hover {
            background-color: #f9f9f9;
        }
        .img-movie {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }
        .rating-badge {
            background-color: #dc3545;
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            display: inline-block;
            font-weight: 600;
            font-size: 13px;
        }
        .btn-xem {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            border-radius: 3px;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        .btn-xem:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }
        .btn-xoa {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
        }
        .btn-xoa:hover {
            background-color: #c82333;
        }
        .movie-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }
        .movie-title-en {
            color: #999;
            font-size: 12px;
        }
        .status-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
    </style>

    <div class="movies-section">
        <div class="page-title">DANH SÁCH PHIM</div>

        @if(session('status'))
            <div class="status-message">
                ✓ {{ session('status') }}
            </div>
        @endif

        <div>
            <button class="btn-them" onclick="window.location.href='{{ route('moviecreate') }}'">+ Thêm</button>
        </div>

        <table id="moviesTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 80px; text-align: center;">Ảnh đại diện</th>
                    <th style="width: 150px;">Tiêu đề</th>
                    <th style="width: auto;">Giới thiệu</th>
                    <th style="width: 120px;">Ngày phát hành</th>
                    <th style="width: 100px; text-align: center;">Điểm đánh giá</th>
                    <th style="width: 160px; text-align: center;">Điểm action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movies as $row)
                    <tr>
                        <td style="text-align: center;">
                            @if($row->image)
                                <img src="{{ asset('storage/'.$row->image) }}" 
                                    alt="{{ $row->movie_name_vn }}" class="img-fluid rounded">
                            @else
                                <div style="width: 60px; height: 80px; background: #e0e0e0; display: flex; align-items: center; justify-content: center; border-radius: 4px; margin: 0 auto; font-size: 11px; color: #999;">
                                    No Image
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="movie-title">{{ $row->movie_name_vn ?? '' }}</div>
                            @if($row->movie_name)
                                <div class="movie-title-en">{{ $row->movie_name }}</div>
                            @endif
                        </td>
                        <td>
                            {{ Str::limit($row->overview ?? '', 60, '...') }}
                        </td>
                        <td>
                            {{ $row->release_date ?? '' }}
                        </td>
                        <td style="text-align: center;">
                            <span class="rating-badge">{{ number_format($row->vote_average, 1) }}</span>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('movieedit', ['id' => $row->id]) }}" class="btn-xem">Xem</a>
                            <form action="{{ route('moviedelete') }}" method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Bạn có chắc muốn xóa bộ phim này?');">
                                @csrf
                                <input type="hidden" name="id" value="{{ $row->id }}">
                                <button type="submit" class="btn-xoa">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #999;">
                            Không có phim nào
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-movie-layout>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#moviesTable').DataTable({
            responsive: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            bStateSave: true,
            language: {
                "search": "Tìm kiếm:",
                "lengthMenu": "Hiển thị _MENU_ bộ phim",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "first": "Đầu tiên",
                    "last": "Cuối cùng",
                    "next": "Tiếp theo",
                    "previous": "Trước đó"
                },
                "emptyTable": "Không có dữ liệu"
            }
        });
    });
</script>

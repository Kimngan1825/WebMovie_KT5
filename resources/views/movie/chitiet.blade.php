<x-movie-layout>
    <x-slot name="title">Chi tiết: {{ $movie->movie_name_vn }}</x-slot>

    <x-slot>
        <div class="row movie-info"> <div class="col-md-3">
                <img src="{{ asset('storage/'.$movie->image) }}" 
                     alt="{{ $movie->movie_name_vn }}" class="img-fluid rounded"
                    style="width: 100%; height: auto; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                </div>
            <div class="col-md-8">
                <h2 class="font-weight-bold">{{ $movie->movie_name_vn }}</h2>
                <ul class="list-unstyled mt-3">
                    <li><b>Ngày phát hành:</b> {{ $movie->release_date }} </li>
                    <li><b>Quốc gia:</b> {{ $movie->country_name }} </li>
                    <li><b>Thời gian:</b> {{ $movie->runtime }} phút </li>
                    <li><b>Doanh thu:</b> {{ number_format($movie->revenue ?? 0) }} </li>
                </ul>
                <div class="mt-3">
                    <p><b>Mô tả:</b></p>
                    <p>{{ $movie->overview_vn }} </p>
                </div>
                <a href="#" class="btn btn-success mt-2">Xem trailer </a>
            </div>
        </div>
    </x-slot>
</x-movie-layout>
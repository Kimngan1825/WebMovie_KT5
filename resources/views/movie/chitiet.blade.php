<x-movie-layout>
    <x-slot name="title">Chi tiết: {{ $movie->movie_name_vn }}</x-slot>

    <x-slot>
        <div class="row" style="margin-top: 20px;"> <div class="col-md-4">
            <img src="{{ asset('storage/'.$movie->image) }}" 
                alt="{{ $movie->movie_name_vn }}" 
                class="img-fluid rounded" 
                style="width: 100%; display: block;">
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
                    <p>{{ $movie->overview_vn ?? $movie->overview }}</p>
                </div>
                <a href="#" class="btn btn-success mt-2">Xem trailer </a>
            </div>
        </div>
    </x-slot>
</x-movie-layout>
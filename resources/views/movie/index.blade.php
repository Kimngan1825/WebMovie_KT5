<x-movie-layout>
    <x-slot name="title">Trang chủ Movie</x-slot>

    <x-slot> 
        <div class="list-movie"> @foreach($movies as $row)
                <div class="movie"> <a href="{{ url('/chitiet/'.$row->id) }}">
                        <img src="{{ asset('storage/'.$row->image) }}" 
                             alt="{{ $row->movie_name_vn }}" 
                             style="width:100%">
                        
                        <div class="p-2">
                            <b>{{ $row->movie_name_vn }}</b>
                            <p class="small text-muted">{{ $row->release_date }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </x-slot>
</x-movie-layout>
@extends('layouts.template') {{-- pastikan ada layoutnya --}}
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Popular Movie</h2>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="card d-flex flex-row h-100">
                        <img src="{{ $movie->cover_image }}" class="card-img-left img-fluid" style="max-width: 150px;"
                            alt="Poster">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($movie->synopsis, 150) }}</p>
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-success btn-sm">Lihat
                                Selanjutnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $movies->links('vendor.pagination.bootstrap-5') }}
        </div>

    </div>
@endsection

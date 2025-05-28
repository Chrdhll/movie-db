@extends('layouts.template') {{-- pastikan ada layoutnya --}}
@section('title', 'Homepage')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Popular Movie</h2>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="card d-flex flex-row h-100">
                        <img src="{{ $movie->cover_image_url }}" alt="Cover" class="card-img-left img-fluid"
                            style="max-width: 150px;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">{{ Str::limit($movie->synopsis, 150) }}</p>
                                <p class="card-text small text-secondary"> Year : {{ $movie->year }}</p>
                            </div>
                            <a href="/movies/{{ $movie->id }}/{{ $movie->slug }}"
                                class="btn btn-outline-success btn-sm mt-3">Read
                                More
                            </a>
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


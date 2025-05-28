@extends('layouts.template')
@section('title', 'Detail Movie')
@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="text-primary">Detail Movie</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $movie->cover_image_url }}" alt="Cover Image" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-8">
                    <h3>{{ $movie->title }}</h3>
                    <p><strong>Kategori:</strong> {{ $movie->category->category_name }}</p>
                    <p><strong>Tahun:</strong> {{ $movie->year }}</p>
                    <p><strong>Sinopsis:</strong></p>
                    <p>{{ $movie->actors ?? 'Actors tidak tersedia.' }}</p>
                    <p>{{ $movie->synopsis ?? 'Synopsis tidak tersedia.' }}</p>
                    <a href="{{ url('/movies') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<div class="row">
    <div class="col-md-4">
        <img src="{{ $movie->cover_image_url }}" class="img-fluid rounded shadow" alt="Cover Image">
    </div>
    <div class="col-md-8">
        <h3>{{ $movie->title }}</h3>
        <p><strong>Kategori:</strong> {{ $movie->category->category_name }}</p>
        <p><strong>Aktor:</strong> {{ $movie->actors ?? 'Actors tidak tersedia.' }}</p>
        <p><strong>Tahun:</strong> {{ $movie->year }}</p>
        <p><strong>Sinopsis:</strong><br>{{ $movie->synopsis ?? 'Sinopsis tidak tersedia.' }}</p>
    </div>
</div>

@extends('layouts.template')
@section('title', 'Form input movie')
@section('content')
    {{-- form input data movie --}}
    <div class="container mt-5">
        <h1>
            Form Input Movie
        </h1>
        <form action="/movie/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control border-success" id="floatingInput" placeholder="Judul" required
                    name="title">
                <label for="floatingInput">Judul</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control border-success" placeholder="Synopsis" id="floatingTextarea2" name="synopsis" required
                    style="height: 100px"></textarea>
                <label for="floatingTextarea2">Sysnopsis</label>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select border-success" name="category_id" id="floatingSelect"
                            aria-label="Floating label select example" required>
                            <option selected disabled>Pilih kategori</option>
                            @foreach ($categories as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Kategori</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control border-success" id="floatingInput" placeholder="Tahun"
                            required name="year" required>
                        <label for="floatingInput">Tahun</label>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control border-success" id="floatingInput" placeholder="Judul" required
                    name="actors">
                <label for="floatingInput">Aktor</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" class="form-control border-success" id="floatingInput" placeholder="gambar" required
                    name="cover_image">
                <label for="floatingInput">Pilih gambar</label>
            </div>

            <button type="submit" class="btn btn-success mb-3 mt-3">Submit</button>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection

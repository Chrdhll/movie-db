@extends('layouts.template')
@section('title', 'Edit Movie')
@section('content')
    <div class="container mt-5">
        <div>
            <h1>Form Edit Movie</h1>
        </div>

        <form action="/movie/{{ $movies->id }}/update" method="POST" enctype="multipart/form-data" class="needs-validation"
            novalidate>
            @csrf
            @method('PUT')

            <div class="form-floating mb-3">
                <input type="text" class="form-control border-success" id="title" placeholder="Judul" name="title"
                    required value="{{ old('title', $movies->title) }}">
                <label for="title">Judul</label>
                <div class="invalid-feedback">Judul wajib diisi.</div>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control border-success" placeholder="Synopsis" id="synopsis" name="synopsis" required
                    style="height: 150px">{{ old('synopsis', $movies->synopsis) }}</textarea>
                <label for="synopsis">Synopsis</label>
                <div class="invalid-feedback">Synopsis wajib diisi.</div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select border-success" name="category_id" id="category_id" required>
                            <option selected disabled value="">Pilih kategori</option>
                            @foreach ($categories as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('category_id', $movies->category_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="category_id">Kategori</label>
                        <div class="invalid-feedback">Kategori wajib dipilih.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control border-success" id="year" name="year"
                            placeholder="Tahun" required value="{{ old('year', $movies->year) }}">
                        <label for="year">Tahun</label>
                        <div class="invalid-feedback">Tahun wajib diisi.</div>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control border-success" id="actors" name="actors" placeholder="Aktor"
                    required value="{{ old('actors', $movies->actors) }}">
                <label for="actors">Aktor</label>
                <div class="invalid-feedback">Aktor wajib diisi.</div>
            </div>

            <div class="form-floating mb-3">

                <input type="file" class="form-control border-success" id="cover_image" name="cover_image" required>
                @if ($movies->cover_image_url)
                    <img src="{{ $movies->cover_image_url }}" alt="Cover" style="max-width: 150px; margin-top: 10px;">
                @endif
                <label for="cover_image">Pilih gambar</label>
                <div class="invalid-feedback">Gambar wajib dipilih.</div>
            </div>

            <button type="submit" class="btn btn-success mb-3 mt-3">Submit</button>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    {{-- Bootstrap validation script --}}
    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection

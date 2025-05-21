@extends('layouts.template')
@section('title', 'Form input movie')
@section('content')
    <div class="container mt-5">
        <h1>Form Input Movie</h1>

        <form action="/movie/store" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control border-success" id="title" placeholder="Judul" name="title" required>
                <label for="title">Judul</label>
                <div class="invalid-feedback">Judul wajib diisi.</div>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control border-success" placeholder="Synopsis" id="synopsis" name="synopsis" required style="height: 150px"></textarea>
                <label for="synopsis">Synopsis</label>
                <div class="invalid-feedback">Synopsis wajib diisi.</div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select border-success" name="category_id" id="category_id" required>
                            <option selected disabled value="">Pilih kategori</option>
                            @foreach ($categories as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="category_id">Kategori</label>
                        <div class="invalid-feedback">Kategori wajib dipilih.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control border-success" id="year" name="year" placeholder="Tahun" required>
                        <label for="year">Tahun</label>
                        <div class="invalid-feedback">Tahun wajib diisi.</div>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control border-success" id="actors" name="actors" placeholder="Aktor" required>
                <label for="actors">Aktor</label>
                <div class="invalid-feedback">Aktor wajib diisi.</div>
            </div>

            <div class="form-floating mb-3">
                <input type="file" class="form-control border-success" id="cover_image" name="cover_image" required>
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

@extends('layouts.template')
@section('title', 'Form Data movie')
@section('content')

    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Movie</h1>
        </div>

        {{-- table --}}
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-responsive table-bordered table-hover table-striped">
                            <thead class="text-white bg-success align-middle  ">
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tahun</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @if (count($movies) < 1)
                                <tbody>
                                    <td colspan='11'>
                                        <p class="text-center">No data available</p>
                                    </td>
                                </tbody>
                            @else
                                <tbody>
                                    @foreach ($movies as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->category->category_name }}</td>
                                            <td>{{ $item->year }}</td>
                                            <td><img src="{{ $item->cover_image_url }}" alt="Cover Image" width="100">
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm btn-primary m-1 btn-detail"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="/movies/{{ $item->id }}/edit"
                                                        class="btn btn-sm btn-warning m-1">
                                                        <i class="fas fa-pen"></i></a>
                                                    <form action="/movies/{{ $item->id }}/delete" method="POST"
                                                        class="m-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Yakin ingin hapus?')"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-eraser"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $movies->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent">Loading...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-detail').click(function(e) {
                e.preventDefault();
                var movieId = $(this).data('id');
                $('#modalContent').html('Loading...');
                $('#detailModal').modal('show');

                $.ajax({
                    url: '/movies/' + movieId + '/detail',
                    method: 'GET',
                    success: function(data) {
                        $('#modalContent').html(data);
                    },
                    error: function() {
                        $('#modalContent').html(
                            '<p class="text-danger">Gagal mengambil data movie.</p>');
                    }
                });
            });

            $('#detailModal').on('hidden.bs.modal', function() {
                $(this).find('#modalContent').html('Loading...');
            });
        });
    </script>

@endsection

@extends('layouts.kasir.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Category Table</h1>
                <button class="btn btn-info btn-rounded" type="submit" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                </p>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $k)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $k->nama_kategori }}</td>
                                <td class="text-sm text-secondary font-weight-regular">
                                    <button class="btn btn-warning btn-rounded"  type=" button" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{$k->id }}">Edit</button>
                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Form create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">

                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">
                        Create kategori
                    </h1>
                    <button type="btn" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label text-muted fw-regular">
                                Nama kategori:
                            </label>
                            <input type="text"
                                class="form-control input-modern @error('nama_kategori') is-invalid @enderror"
                                id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-end align-items-center border-0 pt-0">
                        <button type="button" class="button-modern button-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="button-modern button-created">create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form create -->

    <!-- Form edit -->
    @foreach ($kategori as $k)
        <div class="modal fade" id="editModal-{{$k->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{$k->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modern-modal">

                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{$k->id }}">
                            Edit kategori
                        </h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('kategori.update', $k->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="mb-3">
                                <label for="nama_kategori_{{$k->id }}" class="form-label text-muted fw-regular">
                                    Nama kategori:
                                </label>
                                <input type="text"
                                    class="form-control input-modern @error('nama_kategori') is-invalid @enderror"
                                    id="nama_kategori_{{$k->id }}" name="nama_kategori"
                                    value="{{ old('nama_kategori', $k->nama_kategori) }}">
                                @error('nama_kategori')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end align-items-center border-0 pt-0">
                            <button type="button" class="button-modern button-cancel" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="button-modern button-update">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
    <!-- Form edit -->
@endsection
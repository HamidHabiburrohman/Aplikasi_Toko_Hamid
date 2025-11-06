@extends('layouts.kasir.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Product Table</h1>
                <button class="btn btn-info btn-rounded" type="submit" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produk as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $p->nama_produk }}</td>
                                <td>{{ $p->stok }}</td>
                                <td>{{ $p->harga }}</td>
                                <td class="text-sm text-secondary font-weight-regular">
                                    <button class="btn btn-warning btn-rounded btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $p->id }}">Edit</button>
                                    <form action="{{ route('kasir.produk.destroy', $p->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-rounded btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data produk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">Create produk</h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kasir.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label text-muted fw-regular">Nama produk:</label>
                            <input type="text" class="form-control input-modern @error('nama_produk') is-invalid @enderror"
                                id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}">
                            @error('nama_produk')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label text-muted fw-regular">Stok:</label>
                            <input type="number" class="form-control input-modern @error('stok') is-invalid @enderror"
                                id="stok" name="stok" value="{{ old('stok') }}">
                            @error('stok')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label text-muted fw-regular">Harga:</label>
                            <input type="text" class="form-control input-modern @error('harga') is-invalid @enderror"
                                id="harga" name="harga" value="{{ old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label text-muted fw-semibold">Pilih Kategori:</label>
                            <select name="kategori_id" id="kategori_id"
                                class="form-control input-modern @error('kategori_id') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
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

    @foreach ($produk as $p)
        <div class="modal fade" id="editModal-{{ $p->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modern-modal">
                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $p->id }}">Edit produk</h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kasir.produk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="mb-3">
                                <label for="nama_produk_{{ $p->id }}" class="form-label text-muted fw-regular">Nama produk:</label>
                                <input type="text" class="form-control input-modern @error('nama_produk') is-invalid @enderror"
                                    id="nama_produk_{{ $p->id }}" name="nama_produk" value="{{ old('nama_produk', $p->nama_produk) }}">
                                @error('nama_produk')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="stok{{ $p->id }}" class="form-label text-muted fw-regular">Stok:</label>
                                <input type="text" class="form-control input-modern @error('stok') is-invalid @enderror"
                                    id="stok{{ $p->id }}" name="stok" value="{{ old('stok', $p->stok) }}">
                                @error('stok')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="harga{{ $p->id }}" class="form-label text-muted fw-regular">Harga:</label>
                                <input type="text" class="form-control input-modern @error('harga') is-invalid @enderror"
                                    id="harga{{ $p->id }}" name="harga" value="{{ old('harga', $p->harga) }}">
                                @error('harga')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id{{ $p->id }}" class="form-label text-muted fw-semibold">Kategori Produk:</label>
                                <select name="kategori_id" id="kategori_id{{ $p->id }}" class="form-control input-modern">
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}" {{ $p->kategori_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
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
@endsection
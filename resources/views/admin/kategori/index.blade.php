@extends('layouts.admin.master')

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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="kategoriTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $k)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td>{{ $k->slug }}</td>
                                    <td>{{ $k->deskripsi ?: '-' }}</td>
                                    <td>
                                        @if($k->is_active)
                                            <label class="badge badge-success" style="border-radius: 8px;">Aktif</label>
                                        @else
                                            <label class="badge badge-danger" style="border-radius: 8px;">Nonaktif</label>
                                        @endif
                                    </td>
                                    <td class="text-sm text-center text-secondary font-weight-regular">
                                        <button class="btn btn-warning btn-rounded btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $k->id }}">Edit</button>
                                        <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded btn-sm">
                                                <i class="fa fa-trash"></i>
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
    </div>

    <!-- Form create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">
                        Create kategori
                    </h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.kategori.store') }}" method="POST">
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
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label text-muted fw-regular">
                                Deskripsi:
                            </label>
                            <textarea class="form-control input-modern @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi kategori (optional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Status Aktif</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-end align-items-center border-0 pt-0">
                        <button type="button" class="button-modern button-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="button-modern button-created">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form create -->

    <!-- Form edit -->
    @foreach ($kategori as $k)
        <div class="modal fade" id="editModal-{{ $k->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $k->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modern-modal">
                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $k->id }}">
                            Edit kategori
                        </h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.kategori.update', $k->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="mb-3">
                                <label for="nama_kategori_{{ $k->id }}" class="form-label text-muted fw-regular">
                                    Nama kategori:
                                </label>
                                <input type="text"
                                    class="form-control input-modern @error('nama_kategori') is-invalid @enderror"
                                    id="nama_kategori_{{ $k->id }}" name="nama_kategori"
                                    value="{{ old('nama_kategori', $k->nama_kategori ) }}">
                                @error('nama_kategori')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug_{{ $k->id }}" class="form-label text-muted fw-regular">
                                    Slug:
                                </label>
                                <input type="text"
                                    class="form-control input-modern @error('slug') is-invalid @enderror"
                                    id="slug_{{ $k->id }}" name="slug" value="{{ old('slug', $k->slug) }}">
                                @error('slug')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_{{ $k->id }}" class="form-label text-muted fw-regular">
                                    Deskripsi:
                                </label>
                                <textarea class="form-control input-modern @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi_{{ $k->id }}" name="deskripsi" rows="3">{{ old('deskripsi', $k->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active_{{ $k->id }}" name="is_active" value="1"
                                        {{ $k->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active_{{ $k->id }}">Status Aktif</label>
                                </div>
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

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 14px;
            background: #ffffff;
            transition: all 0.3s ease;
            width: 300px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }

        /* Badge styles sesuai template purple */
        .badge-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .badge-danger {
            background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#kategoriTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 5]
                    },
                    {
                        searchable: false,
                        targets: [0, 5]
                    }
                ],
                order: [[0, 'asc']],
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });
        });
    </script>
@endpush
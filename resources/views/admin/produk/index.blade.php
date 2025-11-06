@extends('layouts.admin.master')

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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="produkTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('admin/images/' . $p->foto_produk) }}"
                                            alt="Foto {{ $p->nama_produk }}" class="me-3"
                                            style="width: 35px; height: 35px; object-fit: cover;">
                                        {{ $p->nama_produk }}
                                    </td>
                                    <td>{{ $p->stok }}</td>
                                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'in stock' => 'badge-success',
                                                'low stock' => 'badge-warning',
                                                'critical' => 'badge-danger',
                                                'empty' => 'badge-secondary',
                                                'backorder' => 'badge-info',
                                                'discontinued' => 'badge-dark',
                                            ][$p->status] ?? 'badge-secondary';
                                        @endphp
                                        <label class="badge {{ $badgeClass }}" style="border-radius: 8px;">
                                            {{ ucfirst($p->status) }}
                                        </label>
                                    </td>
                                    <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $p->supplier->nama_supplier ?? '-' }}</td>
                                    <td class="text-sm text-center text-secondary font-weight-regular">
                                        <button class="btn btn-warning btn-rounded btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $p->id }}">Edit</button>
                                        <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST"
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

    <!-- Create Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">Create produk</h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
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
                                id="harga" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 50000">
                            @error('harga')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label text-muted fw-semibold">Status:</label>
                            <select name="status" id="status" class="form-control input-modern @error('status') is-invalid @enderror">
                                <option value="">Pilih Status</option>
                                <option value="in stock" {{ old('status') == 'in stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="low stock" {{ old('status') == 'low stock' ? 'selected' : '' }}>Low Stock</option>
                                <option value="critical" {{ old('status') == 'critical' ? 'selected' : '' }}>Critical</option>
                                <option value="empty" {{ old('status') == 'empty' ? 'selected' : '' }}>Empty</option>
                                <option value="backorder" {{ old('status') == 'backorder' ? 'selected' : '' }}>Backorder</option>
                                <option value="discontinued" {{ old('status') == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label text-muted fw-regular">Deskripsi:</label>
                            <textarea class="form-control input-modern @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi produk (optional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
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
                                        {{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="supplier_id" class="form-label text-muted fw-semibold">Pilih Supplier:</label>
                            <select name="supplier_id" id="supplier_id"
                                class="form-control input-modern @error('supplier_id') is-invalid @enderror">
                                <option value="">Pilih Supplier</option>
                                @foreach ($supplier as $s)
                                    <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->nama_supplier }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto_produk" class="form-label text-muted fw-regular">Foto produk:</label>
                            <input type="file" class="form-control input-modern @error('foto_produk') is-invalid @enderror"
                                id="foto_produk" name="foto_produk">
                            @error('foto_produk')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
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

    <!-- Edit Modals -->
    @foreach ($produk as $p)
        <div class="modal fade" id="editModal-{{ $p->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $p->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modern-modal">
                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $p->id }}">Edit produk</h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.produk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="mb-3">
                                <label for="nama_produk_{{ $p->id }}" class="form-label text-muted fw-regular">Nama
                                    produk:</label>
                                <input type="text" class="form-control input-modern @error('nama_produk') is-invalid @enderror"
                                    id="nama_produk_{{ $p->id }}" name="nama_produk"
                                    value="{{ old('nama_produk', $p->nama_produk) }}">
                                @error('nama_produk')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="stok{{ $p->id }}" class="form-label text-muted fw-regular">Stok:</label>
                                <input type="number" class="form-control input-modern @error('stok') is-invalid @enderror"
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
                                <label for="status{{ $p->id }}" class="form-label text-muted fw-semibold">Status:</label>
                                <select name="status" id="status{{ $p->id }}" class="form-control input-modern @error('status') is-invalid @enderror">
                                    <option value="in stock" {{ $p->status == 'in stock' ? 'selected' : '' }}>In Stock</option>
                                    <option value="low stock" {{ $p->status == 'low stock' ? 'selected' : '' }}>Low Stock</option>
                                    <option value="critical" {{ $p->status == 'critical' ? 'selected' : '' }}>Critical</option>
                                    <option value="empty" {{ $p->status == 'empty' ? 'selected' : '' }}>Empty</option>
                                    <option value="backorder" {{ $p->status == 'backorder' ? 'selected' : '' }}>Backorder</option>
                                    <option value="discontinued" {{ $p->status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi{{ $p->id }}" class="form-label text-muted fw-regular">Deskripsi:</label>
                                <textarea class="form-control input-modern @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi{{ $p->id }}" name="deskripsi" rows="3">{{ old('deskripsi', $p->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id{{ $p->id }}" class="form-label text-muted fw-semibold">Kategori
                                    Produk:</label>
                                <select name="kategori_id" id="kategori_id{{ $p->id }}" class="form-control input-modern">
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}" {{ $p->kategori_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="supplier_id{{ $p->id }}" class="form-label text-muted fw-semibold">Supplier
                                    Produk:</label>
                                <select name="supplier_id" id="supplier_id{{ $p->id }}" class="form-control input-modern">
                                    @foreach ($supplier as $s)
                                        <option value="{{ $s->id }}" {{ $p->supplier_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_supplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="foto_produk{{ $p->id }}" class="form-label text-muted fw-regular">Foto
                                    produk:</label>
                                <input type="file" class="form-control input-modern @error('foto_produk') is-invalid @enderror"
                                    id="foto_produk{{ $p->id }}" name="foto_produk">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                @error('foto_produk')
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

        .dataTables_wrapper .dataTables_filter label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
            display: block;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 30px;
            text-align: center;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border: none !important;
            color: #4a5568 !important;
            border-radius: 3px !important;
            margin: 0 2px !important;
            padding: 6px 12px !important;
            font-weight: 400;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            min-width: 20px;
            text-align: center;
            display: inline-block;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #a0aec0 !important;
            box-shadow: none;
            cursor: not-allowed;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {

            color: #a0aec0 !important;
            transform: none;
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_paginate .ellipsis {
            padding: 8px 6px;
            color: #a0aec0;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 12px;
            background: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .dataTables_wrapper .dataTables_length label {
            font-weight: 500;
            color: #4a5568;
        }

        .dataTables_wrapper .dataTables_info {
            color: #718096;
            font-size: 14px;
            padding-top: 15px;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_processing {
            border: none !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.first,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next,
        .dataTables_wrapper .dataTables_paginate .paginate_button.last {
            display: none !important;
        }

        /* Badge styles sesuai template purple */
        .badge-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .badge-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        }
        .badge-danger {
            background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        }
        .badge-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #868e96 100%);
        }
        .badge-info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        }
        .badge-dark {
            background: linear-gradient(135deg, #343a40 0%, #495057 100%);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#produkTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 7]
                    },
                    {
                        searchable: false,
                        targets: [0, 7]
                    }
                ],
                order: [[0, 'asc']],
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                pagingType: "full_numbers"
            });
        });
    </script>
@endpush
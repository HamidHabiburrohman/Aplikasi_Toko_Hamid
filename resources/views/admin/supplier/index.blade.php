@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Supplier Table</h1>
                <button class="btn btn-info btn-rounded" type="submit" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="supplierTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Kode Supplier</th>
                                <th>Nama Supplier</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge badge-info" style="border-radius: 8px;">{{ $s->kode_supplier }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $s->nama_supplier }}</strong>
                                        @if($s->nama_kontak)
                                            <br><small class="text-muted">Contact: {{ $s->nama_kontak }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $s->telepon }}</div>
                                        @if($s->email)
                                            <small class="text-muted">{{ $s->email }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ Str::limit($s->kota, 30) }}</div>
                                        <small class="text-muted">{{ $s->alamat }}{{ $s->kode_pos ? ', ' . $s->kode_pos : '' }}</small>
                                    </td>
                                    <td>
                                        @if($s->is_active)
                                            <label class="badge badge-success" style="border-radius: 8px;">Aktif</label>
                                        @else
                                            <label class="badge badge-danger" style="border-radius: 8px;">Nonaktif</label>
                                        @endif
                                    </td>
                                    <td class="text-sm text-center text-secondary font-weight-regular">
                                        <button class="btn btn-warning btn-rounded btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $s->id }}">Edit</button>
                                        <form action="{{ route('admin.pemasok.destroy', $s->id) }}" method="POST"
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">
                        Create Supplier
                    </h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.pemasok.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode_supplier" class="form-label text-muted fw-regular">
                                        Kode Supplier:
                                    </label>
                                    <input type="text"
                                        class="form-control input-modern @error('kode_supplier') is-invalid @enderror"
                                        id="kode_supplier" name="kode_supplier" value="{{ old('kode_supplier') }}"
                                        placeholder="Contoh: SUP-001">
                                    @error('kode_supplier')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_supplier" class="form-label text-muted fw-regular">
                                        Nama Supplier:
                                    </label>
                                    <input type="text"
                                        class="form-control input-modern @error('nama_supplier') is-invalid @enderror"
                                        id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier') }}">
                                    @error('nama_supplier')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telepon" class="form-label text-muted fw-regular">
                                        Telepon:
                                    </label>
                                    <input type="text"
                                        class="form-control input-modern @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" value="{{ old('telepon') }}"
                                        placeholder="Contoh: 081234567890">
                                    @error('telepon')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label text-muted fw-regular">
                                        Email:
                                    </label>
                                    <input type="email"
                                        class="form-control input-modern @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Contoh: supplier@example.com">
                                    @error('email')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label text-muted fw-regular">
                                Alamat:
                            </label>
                            <textarea class="form-control input-modern @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" rows="2" placeholder="Alamat lengkap supplier">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kota" class="form-label text-muted fw-regular">
                                        Kota:
                                    </label>
                                    <input type="text"
                                        class="form-control input-modern @error('kota') is-invalid @enderror"
                                        id="kota" name="kota" value="{{ old('kota') }}">
                                    @error('kota')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label text-muted fw-regular">
                                        Kode Pos:
                                    </label>
                                    <input type="text"
                                        class="form-control input-modern @error('kode_pos') is-invalid @enderror"
                                        id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}"
                                        placeholder="Contoh: 12345">
                                    @error('kode_pos')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_kontak" class="form-label text-muted fw-regular">
                                        Nama Kontak:
                                    </label>
                                    <input type="text"
                                        class="form-control input-modern @error('nama_kontak') is-invalid @enderror"
                                        id="nama_kontak" name="nama_kontak" value="{{ old('nama_kontak') }}"
                                        placeholder="Nama orang yang bisa dihubungi">
                                    @error('nama_kontak')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch mt-4">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">Status Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label text-muted fw-regular">
                                Catatan:
                            </label>
                            <textarea class="form-control input-modern @error('catatan') is-invalid @enderror"
                                id="catatan" name="catatan" rows="2" placeholder="Catatan tambahan (optional)">{{ old('catatan') }}</textarea>
                            @error('catatan')
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
    @foreach ($supplier as $s)
        <div class="modal fade" id="editModal-{{ $s->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $s->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modern-modal">
                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $s->id }}">
                            Edit Supplier
                        </h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.pemasok.update', $s->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kode_supplier_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Kode Supplier:
                                        </label>
                                        <input type="text"
                                            class="form-control input-modern @error('kode_supplier') is-invalid @enderror"
                                            id="kode_supplier_{{ $s->id }}" name="kode_supplier"
                                            value="{{ old('kode_supplier', $s->kode_supplier) }}">
                                        @error('kode_supplier')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_supplier_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Nama Supplier:
                                        </label>
                                        <input type="text"
                                            class="form-control input-modern @error('nama_supplier') is-invalid @enderror"
                                            id="nama_supplier_{{ $s->id }}" name="nama_supplier"
                                            value="{{ old('nama_supplier', $s->nama_supplier) }}">
                                        @error('nama_supplier')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telepon_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Telepon:
                                        </label>
                                        <input type="text"
                                            class="form-control input-modern @error('telepon') is-invalid @enderror"
                                            id="telepon_{{ $s->id }}" name="telepon"
                                            value="{{ old('telepon', $s->telepon) }}">
                                        @error('telepon')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Email:
                                        </label>
                                        <input type="email"
                                            class="form-control input-modern @error('email') is-invalid @enderror"
                                            id="email_{{ $s->id }}" name="email"
                                            value="{{ old('email', $s->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_{{ $s->id }}" class="form-label text-muted fw-regular">
                                    Alamat:
                                </label>
                                <textarea class="form-control input-modern @error('alamat') is-invalid @enderror"
                                    id="alamat_{{ $s->id }}" name="alamat" rows="2">{{ old('alamat', $s->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kota_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Kota:
                                        </label>
                                        <input type="text"
                                            class="form-control input-modern @error('kota') is-invalid @enderror"
                                            id="kota_{{ $s->id }}" name="kota"
                                            value="{{ old('kota', $s->kota) }}">
                                        @error('kota')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kode_pos_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Kode Pos:
                                        </label>
                                        <input type="text"
                                            class="form-control input-modern @error('kode_pos') is-invalid @enderror"
                                            id="kode_pos_{{ $s->id }}" name="kode_pos"
                                            value="{{ old('kode_pos', $s->kode_pos) }}">
                                        @error('kode_pos')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_kontak_{{ $s->id }}" class="form-label text-muted fw-regular">
                                            Nama Kontak:
                                        </label>
                                        <input type="text"
                                            class="form-control input-modern @error('nama_kontak') is-invalid @enderror"
                                            id="nama_kontak_{{ $s->id }}" name="nama_kontak"
                                            value="{{ old('nama_kontak', $s->nama_kontak) }}">
                                        @error('nama_kontak')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" id="is_active_{{ $s->id }}" name="is_active" value="1"
                                                {{ $s->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active_{{ $s->id }}">Status Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="catatan_{{ $s->id }}" class="form-label text-muted fw-regular">
                                    Catatan:
                                </label>
                                <textarea class="form-control input-modern @error('catatan') is-invalid @enderror"
                                    id="catatan_{{ $s->id }}" name="catatan" rows="2">{{ old('catatan', $s->catatan) }}</textarea>
                                @error('catatan')
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
        .badge-danger {
            background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        }
        .badge-info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#supplierTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 6]
                    },
                    {
                        searchable: false,
                        targets: [0, 6]
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
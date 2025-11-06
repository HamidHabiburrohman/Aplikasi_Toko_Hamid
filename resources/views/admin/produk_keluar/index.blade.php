@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Produk Keluar Table</h1>
                <button class="btn btn-info btn-rounded" type="submit" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="produkKeluarTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Tipe Keluar</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk_keluar as $pk)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pk->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $pk->produk->nama_produk }}</td>
                                    <td class="text-center">{{ $pk->jumlah }}</td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'penjualan' => 'badge-success',
                                                'rusak' => 'badge-danger',
                                                'kadaluarsa' => 'badge-warning',
                                                'sample' => 'badge-info'
                                            ][$pk->tipe_keluar] ?? 'badge-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}" style="border-radius: 8px;">
                                            {{ ucfirst($pk->tipe_keluar) }}
                                        </span>
                                    </td>
                                    <td>{{ $pk->keterangan }}</td>
                                    <td class="text-sm text-center text-secondary font-weight-regular">
                                        <button class="btn btn-warning btn-rounded btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $pk->id }}">Edit</button>
                                        <form action="{{ route('admin.produk_keluar.destroy', $pk->id) }}" method="POST"
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
        <!-- Create Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modern-modal">
                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">Create Produk Keluar
                        </h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.produk_keluar.store') }}" method="POST">
                        @csrf
                        <div class="modal-body pt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label text-muted fw-regular">Tanggal:</label>
                                        <input type="date"
                                            class="form-control input-modern @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}">
                                        @error('tanggal')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tipe_keluar" class="form-label text-muted fw-regular">Tipe
                                            Keluar:</label>
                                        <select name="tipe_keluar" id="tipe_keluar"
                                            class="form-control input-modern @error('tipe_keluar') is-invalid @enderror">
                                            <option value="">Pilih Tipe Keluar</option>
                                            <option value="penjualan" {{ old('tipe_keluar') == 'penjualan' ? 'selected' : '' }}>Penjualan</option>
                                            <option value="rusak" {{ old('tipe_keluar') == 'rusak' ? 'selected' : '' }}>Rusak
                                            </option>
                                            <option value="kadaluarsa" {{ old('tipe_keluar') == 'kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                                            <option value="sample" {{ old('tipe_keluar') == 'sample' ? 'selected' : '' }}>
                                                Sample</option>
                                        </select>
                                        @error('tipe_keluar')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="produk_id" class="form-label text-muted fw-semibold">Produk:</label>
                                        <select name="produk_id" id="produk_id"
                                            class="form-control input-modern @error('produk_id') is-invalid @enderror">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produk as $p)
                                                <option value="{{ $p->id }}" {{ old('produk_id') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('produk_id')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="penjualan_id"
                                            class="form-label text-muted fw-regular">Penjualan:</label>
                                        <select name="penjualan_id" id="penjualan_id"
                                            class="form-control input-modern @error('penjualan_id') is-invalid @enderror">
                                            <option value="">Pilih Penjualan (Optional)</option>
                                            @foreach ($penjualan as $pj)
                                                <option value="{{ $pj->id }}" {{ old('penjualan_id') == $pj->id ? 'selected' : '' }}>
                                                    {{ $pj->kode_penjualan }} - {{ $pj->member->nama ?? 'Non-Member' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('penjualan_id')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label text-muted fw-regular">Jumlah:</label>
                                        <input type="number"
                                            class="form-control input-modern @error('jumlah') is-invalid @enderror"
                                            id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1">
                                        @error('jumlah')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label text-muted fw-regular">Keterangan:</label>
                                <textarea class="form-control input-modern @error('keterangan') is-invalid @enderror"
                                    id="keterangan" name="keterangan" rows="3"
                                    placeholder="Keterangan produk keluar">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
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
        @foreach ($produk_keluar as $pk)
            <div class="modal fade" id="editModal-{{ $pk->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $pk->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content modern-modal">
                        <div class="modal-header align-items-center border-0 pb-0">
                            <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $pk->id }}">Edit Produk
                                Keluar</h1>
                            <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.produk_keluar.update', $pk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body pt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tanggal_{{ $pk->id }}"
                                                class="form-label text-muted fw-regular">Tanggal:</label>
                                            <input type="date"
                                                class="form-control input-modern @error('tanggal') is-invalid @enderror"
                                                id="tanggal_{{ $pk->id }}" name="tanggal"
                                                value="{{ old('tanggal', $pk->tanggal) }}">
                                            @error('tanggal')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tipe_keluar_{{ $pk->id }}" class="form-label text-muted fw-regular">Tipe
                                                Keluar:</label>
                                            <select name="tipe_keluar" id="tipe_keluar_{{ $pk->id }}"
                                                class="form-control input-modern @error('tipe_keluar') is-invalid @enderror">
                                                <option value="penjualan" {{ $pk->tipe_keluar == 'penjualan' ? 'selected' : '' }}>
                                                    Penjualan</option>
                                                <option value="rusak" {{ $pk->tipe_keluar == 'rusak' ? 'selected' : '' }}>Rusak
                                                </option>
                                                <option value="kadaluarsa" {{ $pk->tipe_keluar == 'kadaluarsa' ? 'selected' : '' }}>Kadaluarsa</option>
                                                <option value="sample" {{ $pk->tipe_keluar == 'sample' ? 'selected' : '' }}>Sample
                                                </option>
                                            </select>
                                            @error('tipe_keluar')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="produk_id_{{ $pk->id }}"
                                                class="form-label text-muted fw-semibold">Produk:</label>
                                            <select name="produk_id" id="produk_id_{{ $pk->id }}"
                                                class="form-control input-modern">
                                                @foreach ($produk as $p)
                                                    <option value="{{ $p->id }}" {{ $pk->produk_id == $p->id ? 'selected' : '' }}>
                                                        {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="penjualan_id_{{ $pk->id }}"
                                                class="form-label text-muted fw-regular">Penjualan:</label>
                                            <select name="penjualan_id" id="penjualan_id_{{ $pk->id }}"
                                                class="form-control input-modern">
                                                <option value="">Pilih Penjualan (Optional)</option>
                                                @foreach ($penjualan as $pj)
                                                    <option value="{{ $pj->id }}" {{ $pk->penjualan_id == $pj->id ? 'selected' : '' }}>
                                                        {{ $pj->kode_penjualan }} - {{ $pj->member->nama ?? 'Non-Member' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jumlah_{{ $pk->id }}"
                                                class="form-label text-muted fw-regular">Jumlah:</label>
                                            <input type="number"
                                                class="form-control input-modern @error('jumlah') is-invalid @enderror"
                                                id="jumlah_{{ $pk->id }}" name="jumlah" value="{{ old('jumlah', $pk->jumlah) }}"
                                                min="1">
                                            @error('jumlah')
                                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan_{{ $pk->id }}"
                                        class="form-label text-muted fw-regular">Keterangan:</label>
                                    <textarea class="form-control input-modern @error('keterangan') is-invalid @enderror"
                                        id="keterangan_{{ $pk->id }}" name="keterangan"
                                        rows="3">{{ old('keterangan', $pk->keterangan) }}</textarea>
                                    @error('keterangan')
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
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <style>
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
        }

        .badge-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .badge-danger {
            background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
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
            $('#produkKeluarTable').DataTable({
                responsive: true,
                language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' },
                columnDefs: [
                    { orderable: false, targets: [0, 6] },
                    { searchable: false, targets: [0, 6] }
                ],
                order: [[1, 'desc']],
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });
        });
    </script>
@endpush
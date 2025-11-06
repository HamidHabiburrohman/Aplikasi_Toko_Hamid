@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Produk Masuk Table</h1>
                <button class="btn btn-info btn-rounded" type="submit" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="produkMasukTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Kode Pembelian</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Beli</th>
                                <th>Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk_masuk as $pm)
                                <tr data-id="{{ $pm->id }}" 
                                    data-kode="{{ $pm->kode_pembelian }}"
                                    data-tanggal="{{ \Carbon\Carbon::parse($pm->tanggal_masuk)->format('d/m/Y') }}"
                                    data-supplier="{{ $pm->supplier->nama_supplier }}"
                                    data-produk="{{ $pm->produk->nama_produk }}"
                                    data-jumlah="{{ $pm->jumlah }}"
                                    data-harga="{{ $pm->harga_beli }}"
                                    data-total="{{ $pm->total_harga }}"
                                    data-catatan="{{ $pm->catatan ?? '-' }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge badge-info" style="border-radius: 8px;">{{ $pm->kode_pembelian }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($pm->tanggal_masuk)->format('d M Y') }}</td>
                                    <td>{{ $pm->supplier->nama_supplier }}</td>
                                    <td>
                                        <strong>{{ $pm->produk->nama_produk }}</strong>
                                        @if($pm->catatan)
                                            <br><small class="text-muted">{{ Str::limit($pm->catatan, 30) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $pm->jumlah }}</td>
                                    <td>Rp {{ number_format($pm->harga_beli, 0, ',', '.') }}</td>
                                    <td><strong>Rp {{ number_format($pm->total_harga, 0, ',', '.') }}</strong></td>
                                    <td class="text-sm text-center text-secondary font-weight-regular">
                                        <button class="btn btn-warning btn-rounded btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal-{{ $pm->id }}">Edit</button>
                                        <button class="btn btn-success btn-rounded btn-sm" type="button" onclick="printStruk(this)">
                                            <i class="fa fa-print"></i> Cetak
                                        </button>
                                        <form action="{{ route('admin.produk_masuk.destroy', $pm->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data produk masuk?')">
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
                        Create Produk Masuk
                    </h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.produk_masuk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_masuk" class="form-label text-muted fw-regular">
                                        Tanggal Masuk:
                                    </label>
                                    <input type="date" class="form-control input-modern @error('tanggal_masuk') is-invalid @enderror"
                                        id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}">
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="supplier_id" class="form-label text-muted fw-regular">
                                        Supplier:
                                    </label>
                                    <select name="supplier_id" id="supplier_id"
                                        class="form-control input-modern @error('supplier_id') is-invalid @enderror">
                                        <option value="">Pilih Supplier</option>
                                        @foreach ($supplier as $s)
                                            <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama_supplier }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
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
                                            <option value="{{ $p->id }}" {{ old('produk_id') == $p->id ? 'selected' : '' }}
                                                data-harga="{{ $p->harga }}">
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
                                    <label for="harga_beli" class="form-label text-muted fw-regular">
                                        Harga Beli:
                                    </label>
                                    <input type="number" class="form-control input-modern @error('harga_beli') is-invalid @enderror"
                                        id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" 
                                        placeholder="Harga per item">
                                    @error('harga_beli')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label text-muted fw-regular">
                                        Jumlah:
                                    </label>
                                    <input type="number" class="form-control input-modern @error('jumlah') is-invalid @enderror"
                                        id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1">
                                    @error('jumlah')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted fw-regular">
                                        Total Harga:
                                    </label>
                                    <div class="form-control input-modern bg-light" id="total_harga_display">
                                        Rp 0
                                    </div>
                                    <input type="hidden" id="total_harga" name="total_harga">
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
    @foreach ($produk_masuk as $pm)
        <div class="modal fade" id="editModal-{{ $pm->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $pm->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modern-modal">
                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $pm->id }}">
                            Edit Produk Masuk
                        </h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.produk_masuk.update', $pm->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_masuk_{{ $pm->id }}" class="form-label text-muted fw-regular">
                                            Tanggal Masuk:
                                        </label>
                                        <input type="date" class="form-control input-modern @error('tanggal_masuk') is-invalid @enderror"
                                            id="tanggal_masuk_{{ $pm->id }}" name="tanggal_masuk" 
                                            value="{{ old('tanggal_masuk', $pm->tanggal_masuk) }}">
                                        @error('tanggal_masuk')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="supplier_id_{{ $pm->id }}" class="form-label text-muted fw-regular">
                                            Supplier:
                                        </label>
                                        <select name="supplier_id" id="supplier_id_{{ $pm->id }}"
                                            class="form-control input-modern @error('supplier_id') is-invalid @enderror">
                                            @foreach ($supplier as $s)
                                                <option value="{{ $s->id }}" {{ $pm->supplier_id == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_supplier }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="produk_id_{{ $pm->id }}" class="form-label text-muted fw-semibold">Produk:</label>
                                        <select name="produk_id" id="produk_id_{{ $pm->id }}" class="form-control input-modern">
                                            @foreach ($produk as $p)
                                                <option value="{{ $p->id }}" {{ $pm->produk_id == $p->id ? 'selected' : '' }}
                                                    data-harga="{{ $p->harga }}">
                                                    {{ $p->nama_produk }} (Stok: {{ $p->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga_beli_{{ $pm->id }}" class="form-label text-muted fw-regular">
                                            Harga Beli:
                                        </label>
                                        <input type="number" class="form-control input-modern @error('harga_beli') is-invalid @enderror"
                                            id="harga_beli_{{ $pm->id }}" name="harga_beli" 
                                            value="{{ old('harga_beli', $pm->harga_beli) }}">
                                        @error('harga_beli')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah_{{ $pm->id }}" class="form-label text-muted fw-regular">
                                            Jumlah:
                                        </label>
                                        <input type="number" class="form-control input-modern @error('jumlah') is-invalid @enderror"
                                            id="jumlah_{{ $pm->id }}" name="jumlah" 
                                            value="{{ old('jumlah', $pm->jumlah) }}" min="1">
                                        @error('jumlah')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted fw-regular">
                                            Total Harga:
                                        </label>
                                        <div class="form-control input-modern bg-light" id="total_harga_display_{{ $pm->id }}">
                                            Rp {{ number_format($pm->total_harga, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="catatan_{{ $pm->id }}" class="form-label text-muted fw-regular">
                                    Catatan:
                                </label>
                                <textarea class="form-control input-modern @error('catatan') is-invalid @enderror"
                                    id="catatan_{{ $pm->id }}" name="catatan" rows="2">{{ old('catatan', $pm->catatan) }}</textarea>
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

        .badge-info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#produkMasukTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                columnDefs: [
                    {
                        orderable: false,
                        targets: [0, 8]
                    },
                    {
                        searchable: false,
                        targets: [0, 8]
                    }
                ],
                order: [[1, 'desc']],
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                pagingType: "full_numbers"
            });

            // Auto calculate total harga
            function calculateTotal() {
                const harga = parseFloat($('#harga_beli').val()) || 0;
                const jumlah = parseInt($('#jumlah').val()) || 0;
                const total = harga * jumlah;
                $('#total_harga_display').text('Rp ' + total.toLocaleString('id-ID'));
                $('#total_harga').val(total);
            }

            $('#harga_beli, #jumlah').on('input', calculateTotal);

            // Auto fill harga beli when product selected
            $('#produk_id').change(function() {
                const selectedOption = $(this).find('option:selected');
                const hargaJual = selectedOption.data('harga');
                if (hargaJual) {
                    $('#harga_beli').val(hargaJual);
                    calculateTotal();
                }
            });
        });

        // Fungsi untuk mencetak struk
        function printStruk(button) {
            // Dapatkan baris terdekat dari tombol yang diklik
            const row = $(button).closest('tr');
            
            // Ambil data dari atribut data-*
            const kode = row.data('kode');
            const tanggal = row.data('tanggal');
            const supplier = row.data('supplier');
            const produk = row.data('produk');
            const jumlah = row.data('jumlah');
            const harga = parseFloat(row.data('harga'));
            const total = parseFloat(row.data('total'));
            const catatan = row.data('catatan');

            // Format harga
            const formatHarga = (num) => {
                return num.toLocaleString('id-ID');
            };

            // Buat HTML struk
            const strukHTML = `
                <div style="width: 280px; font-family: 'Courier New', monospace; padding: 10px; margin: 0 auto;">
                    <div style="text-align: center; margin-bottom: 15px;">
                        <h3 style="margin: 0; font-size: 16px; font-weight: bold;">TOKO KAMI</h3>
                        <p style="margin: 2px 0; font-size: 10px;">Jl. Contoh No. 123, Jakarta</p>
                        <p style="margin: 2px 0; font-size: 10px;">Telp: (021) 1234567</p>
                        <p style="margin: 8px 0; font-size: 10px;">------------------------------------------</p>
                    </div>
                    
                    <div style="margin-bottom: 12px; font-size: 10px;">
                        <p style="margin: 3px 0;">No. Transaksi: <strong>${kode}</strong></p>
                        <p style="margin: 3px 0;">Tanggal: ${tanggal}</p>
                        <p style="margin: 3px 0;">Supplier: ${supplier}</p>
                    </div>
                    
                    <div style="margin-bottom: 12px;">
                        <p style="margin: 3px 0; font-size: 10px;">------------------------------------------</p>
                        <table style="width: 100%; font-size: 10px; border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="padding: 2px 0; vertical-align: top;">${produk}</td>
                            </tr>
                            <tr>
                                <td style="padding: 2px 0; width: 50%;">${jumlah} x ${formatHarga(harga)}</td>
                                <td style="text-align: right; padding: 2px 0; width: 50%;">${formatHarga(total)}</td>
                            </tr>
                        </table>
                        <p style="margin: 3px 0; font-size: 10px;">------------------------------------------</p>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <table style="width: 100%; font-size: 11px; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 3px 0; font-weight: bold;">TOTAL:</td>
                                <td style="text-align: right; padding: 3px 0; font-weight: bold;">${formatHarga(total)}</td>
                            </tr>
                        </table>
                    </div>
                    
                    ${catatan !== '-' ? `
                    <div style="margin-bottom: 12px;">
                        <p style="margin: 3px 0; font-size: 9px; font-style: italic;">Catatan: ${catatan}</p>
                    </div>
                    ` : ''}
                    
                    <div style="text-align: center; margin-top: 15px;">
                        <p style="margin: 5px 0; font-size: 10px;">------------------------------------------</p>
                        <p style="margin: 5px 0; font-size: 10px;">Terima Kasih</p>
                        <p style="margin: 5px 0; font-size: 9px;">Barang yang sudah dibeli</p>
                        <p style="margin: 5px 0; font-size: 9px;">tidak dapat dikembalikan</p>
                        <p style="margin: 5px 0; font-size: 10px;">------------------------------------------</p>
                    </div>
                </div>
            `;

            // Cetak menggunakan print.js
            printJS({
                printable: strukHTML,
                type: 'raw-html',
                style: `
                    @media print {
                        @page { 
                            margin: 2mm; 
                            size: auto;
                        } 
                        body { 
                            margin: 0; 
                            -webkit-print-color-adjust: exact;
                            font-size: 10px;
                        }
                    }
                `,
                scanStyles: false
            });
        }
    </script>
@endpush
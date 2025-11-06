@extends('layouts.member.master')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Detail Transaksi #{{ $penjualan->id }}</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Pesanan</h5>
                    <table class="table">
                        <tr>
                            <td>Tanggal Pembelian</td>
                            <td>{{ $penjualan->created_at->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>{{ $penjualan->metodePembayaran->nama }}</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>
                                <span class="badge bg-{{ $penjualan->status_pembayaran == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($penjualan->status_pembayaran) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Pengiriman</td>
                            <td>
                                <span class="badge bg-{{ $penjualan->status_pengiriman == 'delivered' ? 'success' : ($penjualan->status_pengiriman == 'shipped' ? 'info' : 'secondary') }}">
                                    {{ ucfirst($penjualan->status_pengiriman) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Detail Produk</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan->detailKeranjangs as $detail)
                                <tr>
                                    <td>{{ $detail->produk->nama_produk }}</td>
                                    <td>Rp {{ number_format($detail->produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp {{ number_format($detail->produk->harga * $detail->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Pembayaran</h5>
                    <table class="table">
                        <tr>
                            <td>Total Produk</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Ongkos Kirim</td>
                            <td>Rp {{ number_format($penjualan->ongkir, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td><strong>Rp {{ number_format($penjualan->total_harga + $penjualan->ongkir, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            @if($penjualan->status_pengiriman == 'shipped' || $penjualan->status_pengiriman == 'delivered')
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Informasi Pengiriman</h5>
                    <p><strong>No. Resi:</strong> {{ $penjualan->no_resi }}</p>
                    <p><strong>Nama Kurir:</strong> {{ $penjualan->nama_kurir }}</p>
                    <p><strong>Estimasi Tiba:</strong> {{ $penjualan->estimasi_tiba->format('d F Y') }}</p>
                    
                    @if($penjualan->status_pengiriman == 'shipped')
                    <a href="#" class="btn btn-primary">Lacak Pengiriman</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@extends('layouts.member.master')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Riwayat Pembelian</h1>
    
    @if($penjualans->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pengiriman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualans as $penjualan)
                        <tr>
                            <td>#{{ $penjualan->id }}</td>
                            <td>{{ $penjualan->created_at->format('d F Y') }}</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $penjualan->status_pembayaran == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($penjualan->status_pembayaran) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $penjualan->status_pengiriman == 'delivered' ? 'success' : ($penjualan->status_pengiriman == 'shipped' ? 'info' : 'secondary') }}">
                                    {{ ucfirst($penjualan->status_pengiriman) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('member.history.show', $penjualan) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $penjualans->links() }}
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body text-center">
            <h4>Belum Ada Riwayat Pembelian</h4>
            <p>Anda belum melakukan pembelian apapun.</p>
            <a href="{{ route('member.produks.index') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
    </div>
    @endif
</div>
@endsection
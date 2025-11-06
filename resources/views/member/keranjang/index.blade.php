{{-- resources/views/member/keranjang/index.blade.php --}}
@extends('layouts.member.master')

@section('content')
<div class="container">
    <h2>Keranjang Belanja</h2>

    @if(isset($keranjang) && $keranjang->detailKeranjangs->count() > 0)
    <div class="row">
        <div class="col-md-8">
            @foreach($keranjang->detailKeranjangs as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            @if($item->produk->foto_produk)
                            <img src="{{ asset('storage/' . $item->produk->foto_produk) }}" 
                                 alt="{{ $item->produk->nama_produk }}" 
                                 class="img-fluid" style="max-height: 80px;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 80px; width: 80px;">
                                <span class="text-muted">No Image</span>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $item->produk->nama_produk }}</h5>
                            <p class="text-muted">Rp {{ number_format($item->produk->harga) }}</p>
                            <small class="text-muted">Stok: {{ $item->produk->stok }}</small>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('member.keranjang.update', $item->produk_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="jumlah" value="{{ $item->jumlah }}" 
                                       min="0" max="{{ $item->produk->stok }}" 
                                       class="form-control" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="col-md-2">
                            <p class="fw-bold">Rp {{ number_format($item->jumlah * $item->produk->harga) }}</p>
                            <form action="{{ route('member.keranjang.hapus', $item->produk_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <form action="{{ route('member.keranjang.kosongkan') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Kosongkan Keranjang</button>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Ringkasan Belanja</h5>
                    @php
                        $totalItems = 0;
                        $totalPrice = 0;
                        foreach($keranjang->detailKeranjangs as $item) {
                            $totalItems += $item->jumlah;
                            $totalPrice += ($item->jumlah * $item->produk->harga);
                        }
                    @endphp
                    <p>Total Item: {{ $totalItems }}</p>
                    <p class="fw-bold">Total: Rp {{ number_format($totalPrice) }}</p>
                    <a href="{{ route('member.checkout') }}" class="btn btn-success w-100">Checkout</a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <h4>Keranjang belanja kosong</h4>
        <p>Silakan tambahkan produk ke keranjang belanja Anda.</p>
        <a href="{{ route('member.produk.index') }}" class="btn btn-primary">Belanja Sekarang</a>
    </div>
    @endif
</div>
@endsection
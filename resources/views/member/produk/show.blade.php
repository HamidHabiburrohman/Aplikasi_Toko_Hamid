@extends('layouts.member.master')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $produk->gambar) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $produk->nama_produk }}</h1>
            <p class="h3 text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p>{{ $produk->deskripsi }}</p>
            
            <div class="mb-3">
                <span class="badge bg-secondary">Kategori: {{ $produk->kategori }}</span>
                <span class="badge bg-info ms-2">Stok: {{ $produk->stok }}</span>
            </div>
            
            <form action="{{ route('member.produks.add-to-cart', $produk) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <h3>Produk Terkait</h3>
            <div class="row">
                @foreach($produkTerkait as $related)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $related->gambar) }}" class="card-img-top" alt="{{ $related->nama_produk }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $related->nama_produk }}</h5>
                            <p class="card-text">Rp {{ number_format($related->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('member.produks.show', $related) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
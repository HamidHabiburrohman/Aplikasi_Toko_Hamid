@extends('layouts.member.master')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Katalog Produk</h1>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari produk..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <select class="form-select" name="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="sort">
                    <option value="">Urutkan</option>
                    <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi
                    </option>
                </select>
            </div>
        </div>

        @foreach($produk as $p)
            <div class="product-item">
                <h3>{{ $p->nama_produk }}</h3>
                <p>Harga: Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                <p>Stok: {{ $p->stok }}</p>

                <!-- Akses property id dari individual product, bukan dari paginator -->
                <a href="{{ route('member.produk.show', $p->id) }}" class="btn btn-primary">
                    Lihat Detail
                </a>
            </div>
        @endforeach

        <!-- Pagination Links -->
        {{ $produk->links() }}
    </div>
@endsection
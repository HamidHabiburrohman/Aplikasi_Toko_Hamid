<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukMasuk;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukMasukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $supplier = Supplier::all();
        $produk_masuk = ProdukMasuk::with(['produk', 'supplier'])->get();
        return view('admin.produk_masuk.index', compact('supplier', 'produk_masuk', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'produk_id' => 'required|exists:produks,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'catatan' => 'nullable|string|max:500'
        ]);

        $total_harga = $request->jumlah * $request->harga_beli;
        $kode_pembelian = 'PM-' . date('Ymd') . '-' . Str::random(6);

        $produkMasuk = ProdukMasuk::create([
            'kode_pembelian' => $kode_pembelian,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'harga_beli' => $request->harga_beli,
            'total_harga' => $total_harga,
            'produk_id' => $request->produk_id,
            'supplier_id' => $request->supplier_id,
            'catatan' => $request->catatan
        ]);

        $produk = Produk::find($request->produk_id);
        $produk->stok += $request->jumlah;
        $produk->save();

        return redirect()->route('admin.produk_masuk.index')->with('create', 'Data berhasil dibuat');
    }

    public function update(Request $request, string $id)
    {
        $produk_masuk = ProdukMasuk::findOrFail($id);
        
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'harga_beli' => 'required|numeric|min:0',
            'produk_id' => 'required|exists:produks,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'catatan' => 'nullable|string|max:500'
        ]);

        $oldJumlah = $produk_masuk->jumlah;
        $oldProdukId = $produk_masuk->produk_id;
        $total_harga = $request->jumlah * $request->harga_beli;

        $produk_masuk->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'harga_beli' => $request->harga_beli,
            'total_harga' => $total_harga,
            'produk_id' => $request->produk_id,
            'supplier_id' => $request->supplier_id,
            'catatan' => $request->catatan
        ]);

        if ($oldProdukId == $request->produk_id) {
            $produk = Produk::find($request->produk_id);
            $produk->stok += ($request->jumlah - $oldJumlah);
            $produk->save();
        } else {
            $oldProduk = Produk::find($oldProdukId);
            $oldProduk->stok -= $oldJumlah;
            $oldProduk->save();

            $newProduk = Produk::find($request->produk_id);
            $newProduk->stok += $request->jumlah;
            $newProduk->save();
        }

        return redirect()->route('admin.produk_masuk.index')->with('edit', 'Data berhasil diedit');
    }

    public function destroy(string $id)
    {
        $produk_masuk = ProdukMasuk::findOrFail($id);
        
        $produk = Produk::find($produk_masuk->produk_id);
        $produk->stok -= $produk_masuk->jumlah;
        $produk->save();

        $produk_masuk->delete();

        return redirect()->route('admin.produk_masuk.index')->with('delete', 'Data berhasil dihapus');
    }
}
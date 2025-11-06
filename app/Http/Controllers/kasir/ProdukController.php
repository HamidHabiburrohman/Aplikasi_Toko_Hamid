<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        $produk = Produk::all();
        return view('kasir.produk.index', compact('produk', 'kategori','supplier'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'foto_produk' => 'nullable|image|mimes:png,jpg|max:2048',
                'nama_produk' => 'required|max:100',
                'stok' => 'required|numeric',
                'harga' => 'required|string|max:70',
                'kategori_id' => 'required|exists:kategoris,id',
                'supplier_id' => 'required|exists:suppliers,id',
            ],
            [
                'foto_produk.nullable' => 'Kami sarankan tambahkan foto produk',
                'foto_produk.mimes' => 'Foto harus berformat png dan jpg',
                'nama_produk.required' => 'Nama harap diisi',
                'stok.required' => 'Stok diisi ya',
                'harga.required' => 'Harga ditentukan ya',
                'kategori_id.required' => 'Kategori wajib dipilih',
                'supplier_id.required' => 'Supplier wajib dipilih',
            ]
        );

        Produk::create([
            'foto_produk' => $request->foto_produk,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('kasir.produk.index')->with('create', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate(
            [
                'foto_produk' => 'nullable|image|mimes:png,jpg|max:2048',
                'nama_produk' => 'required|max:100',
                'stok' => 'required|numeric',
                'harga' => 'required|string|max:70',
                'kategori_id' => 'required|exists:kategoris,id',
                'supplier_id' => 'required|exists:suppliers,id',
            ],
            [
                'foto_produk.nullable' => 'Kami sarankan tambahkan foto produk',
                'foto_produk.mimes' => 'Foto harus berformat png dan jpg',
                'nama_produk.required' => 'Nama harap diisi',
                'stok.required' => 'Stok diisi ya',
                'harga.required' => 'Harga ditentukan ya',
                'kategori_id.required' => 'Kategori wajib dipilih',
                'supplier_id.required' => 'Supplier wajib dipilih',
            ]
        );

        $produk->update([
            'foto_produk' => $request->foto_produk,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('kasir.produk.index')->with('edit', 'Produk berhasil diedit');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('kasir.produk.index')->with('delete', 'Produk berhasil dihapus');
    }
}

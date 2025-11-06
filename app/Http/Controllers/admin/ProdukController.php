<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        $produk = Produk::with(['kategori', 'supplier'])->get();
        return view('admin.produk.index', compact('produk', 'kategori', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_produk' => 'nullable|image|mimes:png,jpg|max:2048',
            'nama_produk' => 'required|max:100',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:in stock,low stock,critical,empty,backorder,discontinued',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $foto_produk = 'nophoto.jpg';

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $foto_produk = uniqid() . '.' . $file->extension();
            $file->move(public_path('admin/images'), $foto_produk);
        }

        Produk::create([
            'foto_produk' => $foto_produk,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.produk.index')->with('create', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'foto_produk' => 'nullable|image|mimes:png,jpg|max:2048',
            'nama_produk' => 'required|max:100',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:in stock,low stock,critical,empty,backorder,discontinued',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $foto_produk = $produk->foto_produk;

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');

            if ($produk->foto_produk && $produk->foto_produk !== 'nophoto.jpg') {
                $oldImagePath = public_path('admin/images/' . $produk->foto_produk);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $foto_produk = uniqid() . '.' . $file->extension();
            $file->move(public_path('admin/images'), $foto_produk);
        }

        $produk->update([
            'foto_produk' => $foto_produk,
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.produk.index')->with('edit', 'Produk berhasil diedit');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk && $produk->foto_produk !== 'nophoto.jpg') {
            $imagePath = public_path('admin/images/' . $produk->foto_produk);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('delete', 'Produk berhasil dihapus');
    }
}
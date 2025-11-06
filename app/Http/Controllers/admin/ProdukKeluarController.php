<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukKeluar;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class ProdukKeluarController extends Controller
{
    public function index()
    {
        $produk_keluar = ProdukKeluar::with(['produk', 'penjualan'])->get();
        $produk = Produk::all();
        $penjualan = Penjualan::all();

        return view('admin.produk_keluar.index', compact('penjualan', 'produk', 'produk_keluar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
            'tipe_keluar' => 'required|in:penjualan,rusak,kadaluarsa,sample',
            'produk_id' => 'required|exists:produks,id',
            'penjualan_id' => 'nullable|exists:penjualans,id',
            'keterangan' => 'required|string|max:500'
        ]);

        $produk = Produk::find($request->produk_id);
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $produk->stok);
        }

        ProdukKeluar::create([
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'tipe_keluar' => $request->tipe_keluar,
            'produk_id' => $request->produk_id,
            'penjualan_id' => $request->penjualan_id,
            'keterangan' => $request->keterangan
        ]);

        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('admin.produk_keluar.index')->with('create', 'Data berhasil dibuat');
    }

    public function update(Request $request, string $id)
    {
        $produk_keluar = ProdukKeluar::findOrFail($id);
        
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
            'tipe_keluar' => 'required|in:penjualan,rusak,kadaluarsa,sample',
            'produk_id' => 'required|exists:produks,id',
            'penjualan_id' => 'nullable|exists:penjualans,id',
            'keterangan' => 'required|string|max:500'
        ]);

        $oldJumlah = $produk_keluar->jumlah;
        $oldProdukId = $produk_keluar->produk_id;

        $produk_keluar->update([
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'tipe_keluar' => $request->tipe_keluar,
            'produk_id' => $request->produk_id,
            'penjualan_id' => $request->penjualan_id,
            'keterangan' => $request->keterangan
        ]);

        if ($oldProdukId == $request->produk_id) {
            $produk = Produk::find($request->produk_id);
            $produk->stok += ($oldJumlah - $request->jumlah);
            $produk->save();
        } else {
            $oldProduk = Produk::find($oldProdukId);
            $oldProduk->stok += $oldJumlah;
            $oldProduk->save();

            $newProduk = Produk::find($request->produk_id);
            if ($newProduk->stok < $request->jumlah) {
                $produk_keluar->update([
                    'jumlah' => $oldJumlah,
                    'produk_id' => $oldProdukId
                ]);
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }
            $newProduk->stok -= $request->jumlah;
            $newProduk->save();
        }

        return redirect()->route('admin.produk_keluar.index')->with('edit', 'Data berhasil diedit');
    }

    public function destroy(string $id)
    {
        $produk_keluar = ProdukKeluar::findOrFail($id);
        
        $produk = Produk::find($produk_keluar->produk_id);
        $produk->stok += $produk_keluar->jumlah;
        $produk->save();

        $produk_keluar->delete();

        return redirect()->route('admin.produk_keluar.index')->with('delete', 'Data berhasil dihapus');
    }
}
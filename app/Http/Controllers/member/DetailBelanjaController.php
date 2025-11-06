<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\DetailKeranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailBelanjaController extends Controller
{
    public function index()
    {
        // Tidak perlu method index terpisah, karena sudah ada di KeranjangBelanjaController
        return redirect()->route('member.keranjang.index');
    }

    public function store(Request $request)
    {
        // Method ini sudah ditangani oleh KeranjangBelanjaController::tambahProduk
        $request->validate([
            'keranjang_id' => 'required|exists:keranjang_belanjas,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        try {
            // Verifikasi keranjang milik member yang login
            $member = Auth::user()->member;
            $keranjang = $member->keranjangBelanja;

            if (!$keranjang || $keranjang->id != $request->keranjang_id) {
                return redirect()->back()->with('error', 'Akses ditolak!');
            }

            $detail = DetailKeranjang::create($request->all());

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    public function update(Request $request, DetailKeranjang $detailKeranjang)
    {
        // Method ini sudah ditangani oleh KeranjangBelanjaController::updateJumlah
        $request->validate([
            'jumlah' => 'required|integer|min:0',
        ]);

        try {
            // Verifikasi detail keranjang milik member yang login
            $member = Auth::user()->member;
            if ($detailKeranjang->keranjangBelanja->member_id != $member->id) {
                return redirect()->back()->with('error', 'Akses ditolak!');
            }

            if ($request->jumlah == 0) {
                $detailKeranjang->delete();
                return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
            }

            $detailKeranjang->update(['jumlah' => $request->jumlah]);

            return redirect()->back()->with('success', 'Jumlah produk berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update produk: ' . $e->getMessage());
        }
    }

    public function destroy(DetailKeranjang $detailKeranjang)
    {
        // Method ini sudah ditangani oleh KeranjangBelanjaController::hapusProduk
        try {
            // Verifikasi detail keranjang milik member yang login
            $member = Auth::user()->member;
            if ($detailKeranjang->keranjangBelanja->member_id != $member->id) {
                return redirect()->back()->with('error', 'Akses ditolak!');
            }

            $detailKeranjang->delete();

            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}
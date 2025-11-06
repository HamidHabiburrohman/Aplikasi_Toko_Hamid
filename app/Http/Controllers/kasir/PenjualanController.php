<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return Penjualan::with(['member', 'metodePembayaran'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_penjualan' => 'required|date',
            'id_member' => 'nullable|exists:members,id',
            'id_kasir' => 'required|integer',
            'total_bayar' => 'required|numeric',
            'metode_pembayaran_id' => 'required|exists:metode_pembayarans,id',
            'status_transaksi' => 'required|string|max:20',
        ]);

        return Penjualan::create($validated);
    }

    public function show(Penjualan $penjualan)
    {
        return $penjualan->load(['member', 'metodePembayaran', 'detailKeranjangs.produk']);
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'tanggal_penjualan' => 'sometimes|required|date',
            'id_member' => 'sometimes|nullable|exists:members,id',
            'id_kasir' => 'sometimes|required|integer',
            'total_bayar' => 'sometimes|required|numeric',
            'metode_pembayaran_id' => 'sometimes|required|exists:metode_pembayarans,id',
            'status_transaksi' => 'sometimes|required|string|max:20',
        ]);

        $penjualan->update($validated);
        return $penjualan;
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return response()->noContent();
    }
}

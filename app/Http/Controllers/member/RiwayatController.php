<?php
namespace App\Http\Controllers\member;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RiwayatController extends Controller
{
    public function index()
    {
        $member = auth()->user()->member;
        $penjualans = Penjualan::where('member_id', $member->id)
            ->with(['metodePembayaran', 'detailKeranjangs.produk'])
            ->latest()
            ->paginate(10);
            
        return view('member.history.index', compact('penjualans'));
    }

    public function show(Penjualan $penjualan)
    {
        if ($penjualan->member_id !== auth()->user()->member->id) {
            abort(403, 'Unauthorized action.');
        }
        
        $penjualan->load(['metodePembayaran', 'detailKeranjangs.produk']);
        return view('member.history.show', compact('penjualan'));
    }
}
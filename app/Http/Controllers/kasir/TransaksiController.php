<?php
namespace App\Http\Controllers\kasir;

use App\Models\Penjualan;
use App\Models\DetailKeranjang;
use App\Models\KeranjangBelanja;
use App\Models\Member;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Menampilkan form pembayaran
     */
    public function create(Request $request)
    {
        // Ambil member berdasarkan ID atau nomor telepon
        $member = null;
        if ($request->has('member_id')) {
            $member = Member::find($request->member_id);
        } elseif ($request->has('telepon')) {
            $member = Member::where('telepon', $request->telepon)->first();
        }
        
        // Ambil keranjang member
        $keranjang = null;
        if ($member) {
            $keranjang = KeranjangBelanja::where('member_id', $member->id)->first();
        }
        
        // Hitung total
        $total = 0;
        if ($keranjang) {
            $detailKeranjangs = DetailKeranjang::where('keranjang_id', $keranjang->id)
                ->with('produk')
                ->get();
                
            foreach ($detailKeranjangs as $detail) {
                $total += $detail->produk->harga * $detail->jumlah;
            }
        }
        
        // Ambil metode pembayaran
        $metodePembayarans = MetodePembayaran::all();
        
        return view('kasir.transaksi.create', compact('member', 'keranjang', 'detailKeranjangs', 'total', 'metodePembayarans'));
    }
    
    /**
     * Menyimpan transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'nullable|exists:members,id',
            'metode_pembayaran_id' => 'required|exists:metode_pembayarans,id',
            'total_bayar' => 'required|numeric|min:0',
            'bayar' => 'required|numeric|min:' . $request->total_bayar,
            'keterangan' => 'nullable|string|max:255'
        ]);
        
        // Hitung kembalian
        $kembalian = $request->bayar - $request->total_bayar;
        
        // Buat transaksi
        $penjualan = Penjualan::create([
            'tanggal_penjualan' => now(),
            'member_id' => $request->member_id,
            'kasir_id' => auth()->user()->kasir->id,
            'total_bayar' => $request->total_bayar,
            'metode_pembayaran_id' => $request->metode_pembayaran_id,
            'status_transaksi' => 'paid',
            'keterangan' => $request->keterangan
        ]);
        
        // Ambil keranjang
        $keranjang = null;
        if ($request->member_id) {
            $keranjang = KeranjangBelanja::where('member_id', $request->member_id)->first();
        }
        
        // Pindahkan item keranjang ke detail penjualan
        if ($keranjang) {
            $detailKeranjangs = DetailKeranjang::where('keranjang_id', $keranjang->id)->get();
            
            foreach ($detailKeranjangs as $detail) {
                // Kurangi stok
                $produk = $detail->produk;
                $produk->stok -= $detail->jumlah;
                $produk->save();
                
                // Buat detail penjualan
                $penjualan->detailKeranjangs()->create([
                    'produk_id' => $detail->produk_id,
                    'jumlah' => $detail->jumlah,
                    'harga' => $produk->harga
                ]);
            }
            
            // Hapus keranjang
            $keranjang->delete();
        }
        
        return redirect()->route('kasir.penjualan.show', $penjualan)
            ->with('success', 'Transaksi berhasil disimpan')
            ->with('kembalian', $kembalian);
    }
    
    /**
     * Menampilkan riwayat transaksi
     */
    public function history(Request $request)
    {
        $query = Penjualan::query();
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal_mulai') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tanggal_penjualan', [
                $request->tanggal_mulai,
                $request->tanggal_akhir
            ]);
        }
        
        // Filter berdasarkan member
        if ($request->has('member_id')) {
            $query->where('member_id', $request->member_id);
        }
        
        // Sorting
        if ($request->has('sort')) {
            $sort = $request->sort;
            if ($sort === 'terbaru') {
                $query->latest();
            } elseif ($sort === 'terlama') {
                $query->oldest();
            }
        }
        
        $penjualans = $query->paginate(10);
        
        return view('kasir.transaksi.history', compact('penjualans'));
    }
    
    /**
     * Menampilkan detail transaksi
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['detailKeranjangs.produk', 'member', 'metodePembayaran', 'kasir']);
        
        return view('kasir.transaksi.show', compact('penjualan'));
    }
}
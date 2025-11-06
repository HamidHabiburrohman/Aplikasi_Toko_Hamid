<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\KeranjangBelanja;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangBelanjaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user->member) {
            $member = Member::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'username' => $user->name ?? explode('@', $user->email)[0],
                'telepon' => '000000000000',
            ]);
        } else {
            $member = $user->member;
        }

        $keranjang = $member->keranjangBelanja;
        
        if (!$keranjang) {
            $keranjang = KeranjangBelanja::create([
                'member_id' => $member->id,
                'tanggal_dibuat' => now()
            ]);
        }
        
        $keranjang->load(['detailKeranjangs.produk.kategori', 'detailKeranjangs.produk.supplier']);
        
        return view('member.keranjang.index', compact('keranjang'));
    }

    public function tambahProduk(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        
        if (!$user->member) {
            $member = Member::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'username' => $user->name ?? explode('@', $user->email)[0],
                'telepon' => '000000000000',
            ]);
        } else {
            $member = $user->member;
        }

        $produk = Produk::findOrFail($request->produk_id);

        if (!$produk->isStokCukup($request->jumlah)) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi! Stok tersedia: ' . $produk->stok);
        }

        if ($produk->status !== 'aktif') {
            return redirect()->back()->with('error', 'Produk tidak tersedia untuk dibeli!');
        }

        $keranjang = $member->keranjangBelanja;
        if (!$keranjang) {
            $keranjang = KeranjangBelanja::create([
                'member_id' => $member->id,
                'tanggal_dibuat' => now()
            ]);
        }

        $detail = $keranjang->detailKeranjangs()->where('produk_id', $request->produk_id)->first();

        if ($detail) {
            $detail->update(['jumlah' => $detail->jumlah + $request->jumlah]);
        } else {
            $keranjang->detailKeranjangs()->create([
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->route('member.keranjang.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function updateProduk(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $detail = DetailKeranjang::findOrFail($id);
        $produk = $detail->produk;

        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        $detail->update(['jumlah' => $request->jumlah]);

        return redirect()->back()->with('success', 'Keranjang berhasil diupdate');
    }

    public function hapusProduk($id)
    {
        $detail = DetailKeranjang::findOrFail($id);
        $detail->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
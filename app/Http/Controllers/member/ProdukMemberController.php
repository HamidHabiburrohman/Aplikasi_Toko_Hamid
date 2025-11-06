<?php
namespace App\Http\Controllers\member;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukMemberController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $query = Produk::query();
        
        // Hanya tampilkan produk dengan status aktif
        $query->where('status', 'aktif');
        
        if ($request->has('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }
        
        if ($request->has('sort')) {
            $sort = $request->sort;
            if ($sort === 'harga_asc') {
                $query->orderBy('harga', 'asc');
            } elseif ($sort === 'harga_desc') {
                $query->orderBy('harga', 'desc');
            } else {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $produk = $query->paginate(12);
        
        return view('member.produk.index', compact('produk', 'kategori'));
    }
    
    public function show($id)
    {
        $produk = Produk::where('status', 'aktif')->findOrFail($id);
        
        $produkTerkait = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->where('status', 'aktif')
            ->limit(4)
            ->get();
            
        return view('member.produk.show', compact('produk', 'produkTerkait'));
    }
    
    public function byKategori($kategori_id)
    {
        $produk = Produk::where('kategori_id', $kategori_id)
            ->where('status', 'aktif')
            ->paginate(12);
            
        $kategori = Kategori::findOrFail($kategori_id);
            
        return view('member.produk.by-kategori', compact('produk', 'kategori'));
    }
}
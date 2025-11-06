<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index () {

        $produk = Produk::all();

        $showProduk = Produk::with(['kategori','supplier'])
            ->latest()
            ->take(3)
            ->get();

        return view('Landing_Page', compact (
            'showProduk'
        ));
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Revenue
        $totalRevenue = DB::table('penjualans')->sum('total_bayar');

        // Today's Revenue
        $todayRevenue = DB::table('penjualans')
            ->whereDate('tanggal_penjualan', today())
            ->sum('total_bayar');

        // Today's Transactions
        $todayTransactions = DB::table('penjualans')
            ->whereDate('tanggal_penjualan', today())
            ->count();

        // Net Profit
        $totalPenjualan = DB::table('penjualans')->sum('total_bayar');
        $totalPembelian = DB::table('produk_masuks')->sum('total_harga');
        $netProfit = $totalPenjualan - $totalPembelian;

        // Total Transactions
        $totalTransactions = DB::table('penjualans')->count();

        // Recent Transactions
        $recentTransactions = DB::table('penjualans')
            ->leftJoin('kasirs', 'penjualans.kasir_id', '=', 'kasirs.id')
            ->leftJoin('metode_pembayarans', 'penjualans.metode_pembayaran_id', '=', 'metode_pembayarans.id')
            ->select(
                'penjualans.*',
                'kasirs.nama as kasir_nama',
                'metode_pembayarans.nama_metode'
            )
            ->orderBy('penjualans.created_at', 'desc')
            ->limit(10)
            ->get();

        // Low Stock Products
        $lowStockProducts = DB::table('produks')
            ->leftJoin('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
            ->select('produks.*', 'kategoris.nama_kategori')
            ->where('produks.stok', '<', 10)
            ->get();

        // Additional stats
        $totalProducts = DB::table('produks')->count();
        $totalMembers = DB::table('members')->count();
        $totalKasirs = DB::table('kasirs')->count();
        $totalSuppliers = DB::table('suppliers')->count();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'todayRevenue',
            'todayTransactions',
            'netProfit',
            'totalTransactions',
            'recentTransactions',
            'lowStockProducts',
            'totalProducts',
            'totalMembers',
            'totalKasirs',
            'totalSuppliers'
        ));
    }
}
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;

// Admin Controllers
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\BarangMasukController;
use App\Http\Controllers\admin\BarangKeluarController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

// Kasir Controllers (Perlu Anda buat sendiri)
use App\Http\Controllers\kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\kasir\TransaksiController;

// Member Controllers
use App\Http\Controllers\member\DashboardController as MemberDashboardController;
use App\Http\Controllers\member\ProdukMemberController;
use App\Http\Controllers\member\RiwayatTransaksiController;


// Landing Page
Route::get('/', function () {
    return view('admin.dashboard'); // Menggunakan 'kebab-case' untuk nama view yang lebih standar
})->name('landing');

// Authentication (Guest Middleware)
Route::middleware('guest')->group(function () {
    Route::get('/signin', [SigninController::class, 'showsignin'])->name('signin');
    Route::post('/signin', [SigninController::class, 'actionsignin'])->name('signin.action');

    Route::get('/signup', [SignupController::class, 'index'])->name('signup.index');
    Route::post('/signup', [SignupController::class, 'store'])->name('signup.store');
});

// Logout
Route::post('/logout', [SigninController::class, 'actionlogout'])->name('logout')->middleware('auth');

// Default Redirect After Login (Menggantikan konflik rute '/')
Route::get('/home', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard.index');
        } elseif (auth()->user()->role === 'kasir') {
            return redirect()->route('kasir.dashboard.index');
        } elseif (auth()->user()->role === 'member') {
            return redirect()->route('member.dashboard.index');
        }
    }
    // Jika auth gagal atau role tidak dikenal, arahkan ke landing page
    return redirect()->route('landing');
})->name('home');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    Route::resources([
        'produk' => ProdukController::class,
        'barang_masuk' => BarangMasukController::class,
        'barang_keluar' => BarangKeluarController::class,
        'kategori' => KategoriController::class,
        'supplier' => SupplierController::class,
        'user' => UserController::class,
    ]);
});

/* Kasir Routes
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->as('kasir.')->group(function () {
    Route::get('/dashboard', [KasirDashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.index');
}); */

// Member Routes
Route::middleware(['auth', 'role:member'])->prefix('member')->as('member.')->group(function () {
    
    
    
    Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])->name('riwayat-transaksi.index');
    Route::get('/riwayat-transaksi/{id}', [RiwayatTransaksiController::class, 'show'])->name('riwayat-transaksi.show');

    // Grouping rute produk untuk member
    Route::prefix('produk')->as('produk.')->group(function () {
        Route::get('/', [ProdukMemberController::class, 'index'])->name('index');
        Route::get('/{barang}', [ProdukMemberController::class, 'show'])->name('show');
    });
});
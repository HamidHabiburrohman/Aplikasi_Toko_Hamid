<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\AuthValidationController; 

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DiskonController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Admin\ProdukMasukController;
use App\Http\Controllers\Admin\ProdukKeluarController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KasirController as AdminKasirController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;

use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\Kasir\PenjualanController;
use App\Http\Controllers\Kasir\KategoriController as KasirKategoriController;
use App\Http\Controllers\Kasir\TransaksiController;
use App\Http\Controllers\Kasir\KasirProfileController;
use App\Http\Controllers\Kasir\ProdukController as KasirProdukController;

use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\MemberProfileController;
use App\Http\Controllers\Member\RiwayatController;
use App\Http\Controllers\Member\ProdukMemberController;
use App\Http\Controllers\Member\KeranjangBelanjaController;
use App\Http\Controllers\Member\DetailBelanjaController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');

Route::controller(SignupController::class)->group(function () {
    Route::get('signup', 'index')->name('signup');
    Route::post('action-signup', 'store')->name('action-signup');
});

Route::controller(SigninController::class)->group(function () {
    Route::get('signin', 'showSignin')->name('signin');
    Route::post('action-signin', 'actionsignin')->name('action-signin');
    Route::get('action-logout', 'actionlogout')->name('action-logout');
});

Route::post('validate-field-realtime', [AuthValidationController::class, 'validateField']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/beranda', [AdminDashboardController::class, 'index'])->name('beranda');
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.export-pdf');
    Route::get('laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export-excel');
    Route::get('laporan/produk-terlaris', [LaporanController::class, 'produkTerlaris'])->name('laporan.produk-terlaris');
    Route::get('laporan/member-aktif', [LaporanController::class, 'memberAktif'])->name('laporan.member-aktif');
    // PERBAIKAN: Dikembalikan ke penamaan ASLI Anda 'pengguna'
    Route::resource('pengguna', UserController::class); 
    Route::resource('kasir', AdminKasirController::class);
    Route::resource('member', AdminMemberController::class);

    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('pemasok', SupplierController::class);
    Route::resource('diskon', DiskonController::class);
    Route::resource('metode-pembayaran', MetodePembayaranController::class);
    
    Route::resource('produk_masuk', ProdukMasukController::class);
    Route::resource('produk_keluar', ProdukKeluarController::class);
});


Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/beranda', [KasirDashboardController::class, 'index'])->name('beranda');
    Route::get('profil', [KasirProfileController::class, 'index'])->name('profil');

    Route::resource('produk', KasirProdukController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('penjualan', PenjualanController::class)->only(['index', 'show']);
    
    Route::get('produk', [KasirProdukController::class, 'index'])->name('produk.index');
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
});


Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/beranda', [MemberDashboardController::class, 'index'])->name('beranda');
    Route::get('profil', [MemberProfileController::class, 'index'])->name('profil');
    Route::get('riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    Route::resource('produk_member', ProdukMemberController::class);
    Route::resource('keranjang', KeranjangBelanjaController::class);
    Route::resource('detail_belanja', DetailBelanjaController::class);
});

require __DIR__.'/auth.php';

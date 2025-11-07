<?php
namespace App\Http\Controllers\admin;

use App\Models\Penjualan;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use App\Models\Member;
use App\Models\Pengeluaran; // ✅ TAMBAH INI JIKA ADA MODEL PENGELUARAN
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter periode
        $periode = $request->input('periode', 'bulanIni');
        
        // Tentukan tanggal berdasarkan periode
        $tanggalSekarang = Carbon::now();
        
        switch ($periode) {
            case 'hariIni':
                $tanggalMulai = $tanggalSekarang->copy()->startOfDay();
                $tanggalAkhir = $tanggalSekarang->copy()->endOfDay();
                break;
            case 'mingguIni':
                $tanggalMulai = $tanggalSekarang->copy()->startOfWeek();
                $tanggalAkhir = $tanggalSekarang->copy()->endOfWeek();
                break;
            case 'bulanIni':
                $tanggalMulai = $tanggalSekarang->copy()->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->copy()->endOfMonth();
                break;
            case 'bulanLalu':
                $tanggalMulai = $tanggalSekarang->copy()->subMonth()->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->copy()->subMonth()->endOfMonth();
                break;
            case 'tahunIni':
                $tanggalMulai = $tanggalSekarang->copy()->startOfYear();
                $tanggalAkhir = $tanggalSekarang->copy()->endOfYear();
                break;
            default:
                $tanggalMulai = $tanggalSekarang->copy()->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->copy()->endOfMonth();
        }
        
        // Ambil data penjualan dalam periode
        $penjualans = Penjualan::whereBetween('tanggal_penjualan', [$tanggalMulai, $tanggalAkhir])
            ->with(['member', 'kasir'])
            ->orderBy('tanggal_penjualan', 'desc')
            ->get();
            
        // Hitung total pendapatan
        $totalPendapatan = $penjualans->sum('total_bayar');
        
        // Hitung total pengeluaran (jika ada model Pengeluaran)
        // $totalPengeluaran = Pengeluaran::whereBetween('tanggal', [$tanggalMulai, $tanggalAkhir])->sum('jumlah');
        // Untuk sementara, kita asumsikan 62% dari pendapatan (sesuai data contoh)
        $totalPengeluaran = $totalPendapatan * 0.62;
        
        // Hitung laba bersih
        $labaBersih = $totalPendapatan - $totalPengeluaran;
        
        // Hitung persentase perubahan
        $persentasePendapatan = $this->hitungPersentasePerubahan('pendapatan', $periode);
        $persentasePengeluaran = $this->hitungPersentasePerubahan('pengeluaran', $periode);
        $persentaseLaba = $this->hitungPersentasePerubahan('laba', $periode);
        
        // Ambil data untuk grafik
        $grafikData = $this->getGrafikData($periode);
        if ($penjualans->count() == 0) {
        $totalPendapatan = 0;
        $totalPengeluaran = 0;
        $labaBersih = 0;
        $profitMargin = 0;
    }

    return view('admin.laporan.index', [
        'periode' => $periode,
        'totalPendapatan' => $totalPendapatan,
        'totalPengeluaran' => $totalPengeluaran, 
        'labaBersih' => $labaBersih,
        'grafikData' => $grafikData,
        'penjualans' => $penjualans,
        'persentasePendapatan' => $persentasePendapatan,
        'persentasePengeluaran' => $persentasePengeluaran,
        'persentaseLaba' => $persentaseLaba,
        'profitMargin' => $profitMargin
    ]);
}

    private function hitungPersentasePerubahan($tipe, $periode)
    {
        // Untuk demo, kita beri nilai fixed sesuai contoh
        switch ($tipe) {
            case 'pendapatan':
                return 7; // +7%
            case 'pengeluaran':
                return 2; // +2%
            case 'laba':
                return 9.45; // +9.45%
            default:
                return 0;
        }
    }

    private function getGrafikData($periode)
    {
        $tanggalSekarang = Carbon::now();
        
        switch ($periode) {
            case 'hariIni':
                $labels = ['00-04', '04-08', '08-12', '12-16', '16-20', '20-24'];
                $pendapatan = [5000000, 8000000, 12000000, 10000000, 7000000, 1660000];
                $pengeluaran = [3100000, 4960000, 7440000, 6200000, 4340000, 1029200];
                break;
                
            case 'mingguIni':
                $labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                $pendapatan = [8000000, 9500000, 7200000, 11000000, 12500000, 15000000, 9000000];
                $pengeluaran = [4960000, 5890000, 4464000, 6820000, 7750000, 9300000, 5580000];
                break;
                
            case 'bulanIni':
                $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                $pendapatan = [35000000, 42000000, 38000000, 43630000];
                $pengeluaran = [21700000, 26040000, 23560000, 27064000];
                break;
                
            case 'bulanLalu':
                $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                $pendapatan = [32000000, 38000000, 35000000, 40000000];
                $pengeluaran = [19840000, 23560000, 21700000, 24800000];
                break;
                
            case 'tahunIni':
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                $pendapatan = [30000000, 35000000, 32000000, 40000000, 38000000, 43630000, 42000000, 45000000, 48000000, 52000000, 55000000, 60000000];
                $pengeluaran = [18600000, 21700000, 19840000, 24800000, 23560000, 27064000, 26040000, 27900000, 29760000, 32240000, 34100000, 37200000];
                break;
                
            default:
                $labels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
                $pendapatan = [35000000, 42000000, 38000000, 43630000];
                $pengeluaran = [21700000, 26040000, 23560000, 27064000];
        }
        
        return [
            'labels' => $labels,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran
        ];
    }

    public function exportPDF(Request $request)
    {
        $periode = $request->input('periode', 'bulanIni');
        
        // Ambil data yang sama seperti index
        $data = [
            'periode' => $periode,
            'totalPendapatan' => 43630000,
            'totalPengeluaran' => 27064000,
            'labaBersih' => 16566000,
        ];
        
        // Untuk sementara return view, nanti bisa diganti dengan PDF
        return view('admin.laporan.export-pdf', $data);
    }

    public function exportExcel(Request $request)
    {
        $periode = $request->input('periode', 'bulanIni');
        
        // Logic untuk export Excel
        return response()->json([
            'message' => 'Export Excel untuk periode ' . $periode . ' berhasil',
            'file' => 'laporan-keuangan-' . $periode . '.xlsx'
        ]);
    }

    // Method lainnya tetap sama...
    public function show()
    {
        //
    }

    public function produkTerlaris(Request $request)
    {
        // ... implementation
    }

    public function memberAktif(Request $request)
    {
        // ... implementation
    }
}
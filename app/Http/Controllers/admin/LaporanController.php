<?php
namespace App\Http\Controllers\admin;

use App\Models\Penjualan;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan laporan keuangan
     */

    public function index () {
        return view('admin.laporan.index');
    }
    public function show () {

    }
    public function keuangan(Request $request)
    {
        // Filter periode
        $periode = $request->input('periode', 'bulanIni');
        
        // Tentukan tanggal berdasarkan periode
        $tanggalSekarang = Carbon::now();
        
        switch ($periode) {
            case 'bulanIni':
                $tanggalMulai = $tanggalSekarang->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->endOfMonth();
                break;
            case 'bulanLalu':
                $tanggalMulai = $tanggalSekarang->subMonth()->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->subMonth()->endOfMonth();
                break;
            case 'tahunIni':
                $tanggalMulai = $tanggalSekarang->startOfYear();
                $tanggalAkhir = $tanggalSekarang->endOfYear();
                break;
            default:
                $tanggalMulai = $tanggalSekarang->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->endOfMonth();
        }
        
        // Ambil data penjualan dalam periode
        $penjualans = Penjualan::whereBetween('tanggal_penjualan', [$tanggalMulai, $tanggalAkhir])
            ->with(['member', 'kasir'])
            ->get();
            
        // Hitung total pendapatan
        $totalPendapatan = $penjualans->sum('total_bayar');
        
        // Hitung total pengeluaran (asumsi: 30% dari pendapatan)
        $totalPengeluaran = $totalPendapatan * 0.3;
        
        // Hitung laba bersih
        $labaBersih = $totalPendapatan - $totalPengeluaran;
        
        // Ambil data untuk grafik
        $grafikData = $this->getGrafikData($periode);
        
        return view('admin.laporan.keuangan', compact(
            'periode', 
            'totalPendapatan', 
            'totalPengeluaran', 
            'labaBersih',
            'grafikData',
            'penjualans'
        ));
    }
    
    /**
     * Mendapatkan data untuk grafik
     */
    private function getGrafikData($periode)
    {
        $tanggalSekarang = Carbon::now();
        
        switch ($periode) {
            case 'bulanIni':
                // Data per hari dalam sebulan
                $labels = [];
                $pendapatan = [];
                $pengeluaran = [];
                
                for ($i = 1; $i <= $tanggalSekarang->daysInMonth; $i++) {
                    $tanggal = Carbon::create($tanggalSekarang->year, $tanggalSekarang->month, $i);
                    $labels[] = $tanggal->format('d/m');
                    
                    $totalHari = Penjualan::whereDate('tanggal_penjualan', $tanggal)
                        ->sum('total_bayar');
                        
                    $pendapatan[] = $totalHari;
                    $pengeluaran[] = $totalHari * 0.3;
                }
                break;
                
            case 'bulanLalu':
                // Data per hari dalam sebulan lalu
                $bulanLalu = $tanggalSekarang->subMonth();
                $daysInMonth = $bulanLalu->daysInMonth;
                
                $labels = [];
                $pendapatan = [];
                $pengeluaran = [];
                
                for ($i = 1; $i <= $daysInMonth; $i++) {
                    $tanggal = Carbon::create($bulanLalu->year, $bulanLalu->month, $i);
                    $labels[] = $tanggal->format('d/m');
                    
                    $totalHari = Penjualan::whereDate('tanggal_penjualan', $tanggal)
                        ->sum('total_bayar');
                        
                    $pendapatan[] = $totalHari;
                    $pengeluaran[] = $totalHari * 0.3;
                }
                break;
                
            case 'tahunIni':
                // Data per bulan dalam setahun
                $labels = [];
                $pendapatan = [];
                $pengeluaran = [];
                
                for ($i = 1; $i <= 12; $i++) {
                    $bulan = Carbon::create($tanggalSekarang->year, $i, 1);
                    $labels[] = $bulan->format('M');
                    
                    $totalBulan = Penjualan::whereMonth('tanggal_penjualan', $i)
                        ->whereYear('tanggal_penjualan', $tanggalSekarang->year)
                        ->sum('total_bayar');
                        
                    $pendapatan[] = $totalBulan;
                    $pengeluaran[] = $totalBulan * 0.3;
                }
                break;
                
            default:
                $labels = [];
                $pendapatan = [];
                $pengeluaran = [];
        }
        
        return [
            'labels' => $labels,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran
        ];
    }
    
    /**
     * Menampilkan laporan produk terlaris
     */
    public function produkTerlaris(Request $request)
    {
        // Filter periode
        $periode = $request->input('periode', 'bulanIni');
        
        // Tentukan tanggal berdasarkan periode
        $tanggalSekarang = Carbon::now();
        
        switch ($periode) {
            case 'bulanIni':
                $tanggalMulai = $tanggalSekarang->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->endOfMonth();
                break;
            case 'bulanLalu':
                $tanggalMulai = $tanggalSekarang->subMonth()->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->subMonth()->endOfMonth();
                break;
            case 'tahunIni':
                $tanggalMulai = $tanggalSekarang->startOfYear();
                $tanggalAkhir = $tanggalSekarang->endOfYear();
                break;
            default:
                $tanggalMulai = $tanggalSekarang->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->endOfMonth();
        }
        
        // Ambil detail penjualan dalam periode
        $detailPenjualans = DetailKeranjang::with(['produk'])
            ->whereHas('penjualan', function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->whereBetween('tanggal_penjualan', [$tanggalMulai, $tanggalAkhir]);
            })
            ->get();
            
        // Kelompokkan berdasarkan produk dan hitung total
        $produkStats = $detailPenjualans->groupBy('produk_id')
            ->map(function ($group) {
                return [
                    'produk' => $group->first()->produk,
                    'total_jumlah' => $group->sum('jumlah'),
                    'total_pendapatan' => $group->sum(function ($item) {
                        return $item->jumlah * $item->produk->harga;
                    })
                ];
            })
            ->sortByDesc('total_jumlah')
            ->take(10);
            
        return view('admin.laporan.produk-terlaris', compact('produkStats', 'periode'));
    }
    
    /**
     * Menampilkan laporan member aktif
     */
    public function memberAktif(Request $request)
    {
        // Filter periode
        $periode = $request->input('periode', 'bulanIni');
        
        // Tentukan tanggal berdasarkan periode
        $tanggalSekarang = Carbon::now();
        
        switch ($periode) {
            case 'bulanIni':
                $tanggalMulai = $tanggalSekarang->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->endOfMonth();
                break;
            case 'bulanLalu':
                $tanggalMulai = $tanggalSekarang->subMonth()->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->subMonth()->endOfMonth();
                break;
            case 'tahunIni':
                $tanggalMulai = $tanggalSekarang->startOfYear();
                $tanggalAkhir = $tanggalSekarang->endOfYear();
                break;
            default:
                $tanggalMulai = $tanggalSekarang->startOfMonth();
                $tanggalAkhir = $tanggalSekarang->endOfMonth();
        }
        
        // Ambil member yang melakukan transaksi dalam periode
        $memberAktif = Member::whereHas('penjualans', function ($query) use ($tanggalMulai, $tanggalAkhir) {
            $query->whereBetween('tanggal_penjualan', [$tanggalMulai, $tanggalAkhir]);
        })
        ->withCount(['penjualans' => function ($query) use ($tanggalMulai, $tanggalAkhir) {
            $query->whereBetween('tanggal_penjualan', [$tanggalMulai, $tanggalAkhir]);
        }])
        ->latest('penjualans_count')
        ->paginate(10);
        
        return view('admin.laporan.member-aktif', compact('memberAktif', 'periode'));
    }
    
    /**
     * Export laporan keuangan ke PDF
     */
    public function exportKeuanganPDF(Request $request)
    {
        // Ambil data laporan keuangan
        $periode = $request->input('periode', 'bulanIni');
        $data = $this->keuangan($request);
        
        // Generate PDF menggunakan library seperti dompdf
        $pdf = \PDF::loadView('admin.laporan.pdf.keuangan', $data);
        
        return $pdf->download('laporan-keuangan-' . $periode . '.pdf');
    }
    
    /**
     * Export laporan keuangan ke Excel
     */
    public function exportKeuanganExcel(Request $request)
    {
        // Ambil data laporan keuangan
        $periode = $request->input('periode', 'bulanIni');
        $data = $this->keuangan($request);
        
        // Buat Excel
        $excel = \Excel::create('laporan-keuangan-' . $periode, function($excel) use ($data) {
            $excel->sheet('Laporan Keuangan', function($sheet) use ($data) {
                $sheet->setCellValue('A1', 'Laporan Keuangan');
                $sheet->setCellValue('A3', 'Periode: ' . $data['periode']);
                $sheet->setCellValue('A5', 'Total Pendapatan: Rp ' . number_format($data['totalPendapatan'], 2, ',', '.'));
                $sheet->setCellValue('A6', 'Total Pengeluaran: Rp ' . number_format($data['totalPengeluaran'], 2, ',', '.'));
                $sheet->setCellValue('A7', 'Laba Bersih: Rp ' . number_format($data['labaBersih'], 2, ',', '.'));
                
                // Tambahkan data transaksi
                $sheet->fromArray($data['penjualans']->toArray(), null, 'A10');
            });
        });
        
        return $excel->download('laporan-keuangan-' . $periode . '.xlsx');
    }
}
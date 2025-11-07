<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan - {{ $periode }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .text-success { color: green; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Keuangan</h1>
        <p>Periode: {{ $periode }}</p>
    </div>
    
    <table class="table">
        <tr>
            <th>Metrik</th>
            <th>Nilai</th>
        </tr>
        <tr>
            <td>Total Pendapatan</td>
            <td class="text-right text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Pengeluaran</td>
            <td class="text-right">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Laba Bersih</td>
            <td class="text-right text-success">Rp {{ number_format($labaBersih, 0, ',', '.') }}</td>
        </tr>
    </table>
    
    <p style="margin-top: 20px; font-size: 12px; color: #666;">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}
    </p>
</body>
</html>
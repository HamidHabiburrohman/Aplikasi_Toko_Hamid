@extends('layouts.admin.master')

@section('content')
    <div class="dashboard-container">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <header class="dashboard-header">
            <h1 class="dashboard-title">Laporan Keuangan</h1>
            <div class="filter-container">
                <select class="filter-select" id="periodeFilter">
                    <option value="hariIni">Hari Ini</option>
                    <option value="mingguIni">Minggu Ini</option>
                    <option value="bulanIni" selected>Bulan Ini</option>
                    <option value="bulanLalu">Bulan Lalu</option>
                    <option value="tahunIni">Tahun Ini</option>
                    <option value="custom">Custom</option>
                </select>
                <button class="filter-btn" id="terapkanFilter">
                    <i class="fas fa-filter"></i> Terapkan
                </button>
            </div>
        </header>

        <section class="metrics-grid">
            <div class="metric-card revenue">
                <div class="metric-header">
                    <div>
                        <h3 class="metric-title">Total Pendapatan</h3>
                        <div class="metric-value">Rp 43.630.000</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i> +7% vs periode sebelumnya
                        </div>
                    </div>
                    <div class="metric-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>

            <div class="metric-card expense">
                <div class="metric-header">
                    <div>
                        <h3 class="metric-title">Total Pengeluaran</h3>
                        <div class="metric-value">Rp 27.064.000</div>
                        <div class="metric-change negative">
                            <i class="fas fa-arrow-up"></i> +2% vs periode sebelumnya
                        </div>
                    </div>
                    <div class="metric-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>

            <div class="metric-card profit">
                <div class="metric-header">
                    <div>
                        <h3 class="metric-title">Laba Bersih</h3>
                        <div class="metric-value">Rp 16.566.000</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i> +9.45% vs periode sebelumnya
                        </div>
                    </div>
                    <div class="metric-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
        </section>

        <section class="charts-section">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Trend Pendapatan vs Pengeluaran</h3>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color revenue"></div>
                            <span>Pendapatan</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color expense"></div>
                            <span>Pengeluaran</span>
                        </div>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Komposisi Pengeluaran</h3>
                </div>
                <div class="chart-container">
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>
        </section>

        <section class="table-section">
            <div class="table-header">
                <h3 class="table-title">Detail Transaksi</h3>
                <div class="table-actions">
                    <button class="action-btn">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-right">Pendapatan</th>
                            <th class="text-right">Pengeluaran</th>
                            <th class="text-right">Saldo</th>
                            <th>Metode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15 Jan 2024</td>
                            <td><span class="badge badge-success">Penjualan</span></td>
                            <td>Penjualan Produk A</td>
                            <td class="text-right text-success">Rp 5.000.000</td>
                            <td class="text-right">-</td>
                            <td class="text-right text-success">Rp 5.000.000</td>
                            <td><span class="badge badge-info">Transfer Bank</span></td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>15 Jan 2024</td>
                            <td><span class="badge badge-danger">Operasional</span></td>
                            <td>Biaya Listrik</td>
                            <td class="text-right">-</td>
                            <td class="text-right text-danger">Rp 1.500.000</td>
                            <td class="text-right text-success">Rp 3.500.000</td>
                            <td><span class="badge badge-info">Transfer Bank</span></td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>14 Jan 2024</td>
                            <td><span class="badge badge-success">Penjualan</span></td>
                            <td>Penjualan Produk B</td>
                            <td class="text-right text-success">Rp 7.500.000</td>
                            <td class="text-right">-</td>
                            <td class="text-right text-success">Rp 11.000.000</td>
                            <td><span class="badge badge-info">E-Wallet</span></td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>14 Jan 2024</td>
                            <td><span class="badge badge-danger">Gaji</span></td>
                            <td>Gaji Karyawan</td>
                            <td class="text-right">-</td>
                            <td class="text-right text-danger">Rp 10.000.000</td>
                            <td class="text-right text-success">Rp 1.000.000</td>
                            <td><span class="badge badge-info">Transfer Bank</span></td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>13 Jan 2024</td>
                            <td><span class="badge badge-success">Penjualan</span></td>
                            <td>Penjualan Produk C</td>
                            <td class="text-right text-success">Rp 3.200.000</td>
                            <td class="text-right">-</td>
                            <td class="text-right text-success">Rp 4.200.000</td>
                            <td><span class="badge badge-info">Tunai</span></td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="pagination-info">Menampilkan 5 dari 25 transaksi</div>
                <div class="pagination">
                    <button class="page-btn disabled">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">5</button>
                    <button class="page-btn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-color: #10b981;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --warning-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .dashboard-container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff00;
            position: relative;
        }

        .dashboard-header {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
            padding: 16px 0;
        }

        @media (min-width: 768px) {
            .dashboard-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        @media (min-width: 768px) {
            .dashboard-title {
                font-size: 28px;
                text-align: left;
            }
        }

        .filter-container {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (min-width: 768px) {
            .filter-container {
                justify-content: flex-end;
            }
        }

        .filter-select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background-color: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 140px;
        }

        .filter-select:hover {
            border-color: #9ca3af;
        }

        .filter-btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: var(--primary-gradient);
            color: white;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 640px) {
            .metrics-grid {
                grid-template-columns: 1fr;
            }
        }

        .metric-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-hover-shadow);
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .metric-card.revenue::before {
            background: var(--success-color);
        }

        .metric-card.expense::before {
            background: var(--danger-color);
        }

        .metric-card.profit::before {
            background: var(--info-color);
        }

        .metric-card.margin::before {
            background: var(--warning-color);
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .metric-title {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }

        .metric-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .metric-card.revenue .metric-icon {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .metric-card.expense .metric-icon {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .metric-card.profit .metric-icon {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .metric-card.margin .metric-icon {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .metric-value {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        @media (min-width: 768px) {
            .metric-value {
                font-size: 28px;
            }
        }

        .metric-card.revenue .metric-value {
            color: var(--success-color);
        }

        .metric-card.expense .metric-value {
            color: var(--danger-color);
        }

        .metric-card.profit .metric-value {
            color: var(--info-color);
        }

        .metric-card.margin .metric-value {
            color: var(--warning-color);
        }

        .metric-change {
            font-size: 12px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .metric-change.positive {
            color: var(--success-color);
        }

        .metric-change.negative {
            color: var(--danger-color);
        }

        .charts-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (min-width: 1024px) {
            .charts-section {
                grid-template-columns: 2fr 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            height: 400px;
            display: flex;
            flex-direction: column;
        }

        .chart-header {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        @media (min-width: 640px) {
            .chart-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .chart-title {
            font-size: 16px;
            font-weight: 600;
        }

        .chart-legend {
            display: flex;
            gap: 12px;
            font-size: 12px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .legend-color.revenue {
            background-color: var(--success-color);
        }

        .legend-color.expense {
            background-color: var(--danger-color);
        }

        .chart-container {
            flex: 1;
            position: relative;
            min-height: 300px;
        }

        .table-section {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--card-shadow);
        }

        .table-header {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }

        @media (min-width: 768px) {
            .table-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .table-title {
            font-size: 16px;
            font-weight: 600;
        }

        .table-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .table-actions {
                justify-content: flex-end;
            }
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .action-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .data-table th {
            text-align: left;
            padding: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        .data-table td {
            padding: 12px;
            font-size: 14px;
            border-bottom: 1px solid #f3f4f6;
            white-space: nowrap;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
        }

        .text-right {
            text-align: right;
        }

        .text-success {
            color: var(--success-color);
        }

        .text-danger {
            color: var(--danger-color);
        }

        .text-info {
            color: var(--info-color);
        }

        .table-footer {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        @media (min-width: 640px) {
            .table-footer {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .pagination-info {
            font-size: 12px;
            color: #6b7280;
        }

        .pagination {
            display: flex;
            gap: 4px;
        }

        .page-btn {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #6b7280;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn:hover {
            background: #f9fafb;
        }

        .page-btn.active {
            background: var(--primary-gradient);
            color: white;
            border: none;
        }

        .page-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: var(--primary-gradient);
            top: -100px;
            right: -100px;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: var(--secondary-gradient);
            bottom: 100px;
            left: -50px;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: var(--primary-gradient);
            bottom: -50px;
            right: 100px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize charts
            initCharts();

            // Handle window resize
            window.addEventListener('resize', function() {
                // Re-initialize charts on resize for better responsiveness
                initCharts();
            });

            function initCharts() {
                // Trend Chart
                const trendCtx = document.getElementById('trendChart');
                if (window.trendChart) {
                    window.trendChart.destroy();
                }
                
                window.trendChart = new Chart(trendCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        datasets: [
                            {
                                label: 'Pendapatan',
                                data: [30000000, 35000000, 32000000, 40000000, 38000000, 43630000],
                                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                                borderColor: '#10b981',
                                borderWidth: 1
                            },
                            {
                                label: 'Pengeluaran',
                                data: [20000000, 22000000, 21000000, 25000000, 24000000, 27064000],
                                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                                borderColor: '#ef4444',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000000).toFixed(0) + 'jt';
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // Expense Chart
                const expenseCtx = document.getElementById('expenseChart');
                if (window.expenseChart) {
                    window.expenseChart.destroy();
                }
                
                window.expenseChart = new Chart(expenseCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Operasional', 'Gaji', 'Bahan Baku', 'Pemasaran', 'Lainnya'],
                        datasets: [{
                            data: [30, 25, 20, 15, 10],
                            backgroundColor: [
                                '#667eea',
                                '#764ba2',
                                '#f093fb',
                                '#f5576c',
                                '#4facfe'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    font: {
                                        size: 11
                                    },
                                    usePointStyle: true
                                }
                            }
                        },
                        cutout: '60%'
                    }
                });
            }

            document.getElementById('terapkanFilter').addEventListener('click', function() {
                const periode = document.getElementById('periodeFilter').value;
                console.log('Filter applied:', periode);
            });
        });
    </script>
@endpush
document.addEventListener('DOMContentLoaded', () => {
    const keuanganData = window.keuanganData || {};
    let keuanganChart;

    const initChart = (data) => {
        const ctx = document.getElementById('multiLineData');
        if (!ctx) return;
        if (keuanganChart) keuanganChart.destroy();

        keuanganChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [
                    { label: 'Pendapatan', backgroundColor: '#6f42c1', data: data.pendapatan },
                    { label: 'Pengeluaran', backgroundColor: '#d63384', data: data.pengeluaran }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } },
                scales: {
                    y: { ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') } }
                }
            }
        });
    };

    const updateData = (periode) => {
        const data = keuanganData[periode];
        initChart(data);
    };

    const generatePDFContent = () => {
        // Clone section laporan dari DOM agar sesuai tampilannya
        const laporanSection = document.getElementById('laporan-keuangan');
        if (!laporanSection) return '';

        const clone = laporanSection.cloneNode(true);
        // Hilangkan tombol, filter, dsb. biar rapi
        clone.querySelectorAll('button, select').forEach(el => el.remove());
        return clone.outerHTML;
    };

    const exportToPDF = () => {
        const modalBody = document.getElementById('pdfPreview');
        modalBody.innerHTML = generatePDFContent();

        const modal = new bootstrap.Modal(document.getElementById('pdfModal'));
        modal.show();

        // render chart di modal setelah DOM dimuat
        setTimeout(() => {
            const ctx = document.getElementById('pdfChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: keuanganChart.data,
                    options: keuanganChart.options
                });
            }
        }, 300);
    };

    const printPDF = () => {
        const printWindow = window.open('', '_blank');
        const content = generatePDFContent();

        printWindow.document.write(`
            <html>
            <head>
                <title>Laporan Keuangan</title>
                <link rel="stylesheet" href="/css/app.css">
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </head>
            <body>${content}</body>
            </html>
        `);
        printWindow.document.close();

        setTimeout(() => {
            const ctx = printWindow.document.getElementById('pdfChart');
            if (ctx) {
                new printWindow.Chart(ctx, {
                    type: 'bar',
                    data: keuanganChart.data,
                    options: keuanganChart.options
                });
            }
            setTimeout(() => printWindow.print(), 800);
        }, 800);
    };

    const exportToExcel = () => {
        const wb = XLSX.utils.book_new();
        const table = document.querySelector('#keuanganTable');
        const ws = XLSX.utils.table_to_sheet(table);
        XLSX.utils.book_append_sheet(wb, ws, 'Laporan');
        XLSX.writeFile(wb, 'laporan-keuangan.xlsx');
    };

    // Event bindings
    document.getElementById('exportPDF')?.addEventListener('click', exportToPDF);
    document.getElementById('printPDF')?.addEventListener('click', printPDF);
    document.getElementById('exportExcel')?.addEventListener('click', exportToExcel);
});

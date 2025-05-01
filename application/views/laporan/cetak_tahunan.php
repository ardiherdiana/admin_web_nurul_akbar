<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .header h3 {
            margin: 5px 0;
        }
        .info {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .summary-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 30%;
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 16px;
            font-weight: bold;
        }
        .green {
            color: green;
        }
        .red {
            color: red;
        }
        .blue {
            color: blue;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>MASJID NURUL AKBAR</h2>
        <h3><?= $judul ?></h3>
    </div>
    
    <div class="info">
        <p>Tanggal Cetak: <?= date('d M Y') ?></p>
        <p>Admin: <?= $this->session->userdata('admin_name') ?></p>
    </div>
    
    <div class="summary">
        <div class="summary-box">
            <div class="summary-title">Total Pemasukan</div>
            <div class="summary-value green">Rp <?= number_format($total_pemasukan_tahunan, 0, ',', '.') ?></div>
        </div>
        <div class="summary-box">
            <div class="summary-title">Total Pengeluaran</div>
            <div class="summary-value red">Rp <?= number_format($total_pengeluaran_tahunan, 0, ',', '.') ?></div>
        </div>
        <div class="summary-box">
            <div class="summary-title">Saldo</div>
            <div class="summary-value <?= $saldo_tahunan >= 0 ? 'green' : 'red' ?>">
                Rp <?= number_format($saldo_tahunan, 0, ',', '.') ?>
            </div>
        </div>
    </div>
    
    <h3>Laporan Keuangan Bulanan Tahun <?= $tahun ?></h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($bulanan as $bulan): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $bulan['bulan'] ?></td>
                    <td style="text-align: right;">Rp <?= number_format($bulan['total_pemasukan'], 0, ',', '.') ?></td>
                    <td style="text-align: right;">Rp <?= number_format($bulan['total_pengeluaran'], 0, ',', '.') ?></td>
                    <td style="text-align: right; <?= $bulan['saldo'] >= 0 ? 'color: green;' : 'color: red;' ?> font-weight: bold;">
                        Rp <?= number_format($bulan['saldo'], 0, ',', '.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="total">Total:</td>
                <td style="text-align: right; font-weight: bold;">Rp <?= number_format($total_pemasukan_tahunan, 0, ',', '.') ?></td>
                <td style="text-align: right; font-weight: bold;">Rp <?= number_format($total_pengeluaran_tahunan, 0, ',', '.') ?></td>
                <td style="text-align: right; <?= $saldo_tahunan >= 0 ? 'color: green;' : 'color: red;' ?> font-weight: bold;">
                    Rp <?= number_format($saldo_tahunan, 0, ',', '.') ?>
                </td>
            </tr>
        </tfoot>
    </table>
    
    <div class="footer">
        <p>Tangerang, <?= date('d M Y') ?></p>
        <br><br><br>
        <p><?= $this->session->userdata('admin_name') ?></p>
        <p>Administrator</p>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>
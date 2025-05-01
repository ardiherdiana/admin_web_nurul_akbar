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
        <p>Periode: <?= date('d M Y', strtotime($tanggal_mulai)) ?> - <?= date('d M Y', strtotime($tanggal_akhir)) ?></p>
    </div>
    
    <div class="info">
        <p>Tanggal Cetak: <?= date('d M Y') ?></p>
        <p>Admin: <?= $this->session->userdata('admin_name') ?></p>
    </div>
    
    <div class="summary">
        <div class="summary-box">
            <div class="summary-title">Total Pemasukan</div>
            <div class="summary-value green">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></div>
        </div>
        <div class="summary-box">
            <div class="summary-title">Total Pengeluaran</div>
            <div class="summary-value red">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></div>
        </div>
        <div class="summary-box">
            <div class="summary-title">Saldo</div>
            <div class="summary-value <?= $saldo >= 0 ? 'green' : 'red' ?>">
                Rp <?= number_format($saldo, 0, ',', '.') ?>
            </div>
        </div>
    </div>
    
    <h3>Detail Pemasukan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Donatur</th>
                <th>Jenis Pemasukan</th>
                <th>Metode Pembayaran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($pemasukan)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data pemasukan</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach($pemasukan as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                        <td><?= $row->nama_donatur ?></td>
                        <td><?= $row->jenis_pemasukan ?></td>
                        <td><?= $row->metode_pembayaran ?></td>
                        <td style="text-align: right;">Rp <?= number_format($row->jumlah, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" class="total">Total Pemasukan:</td>
                    <td style="text-align: right; font-weight: bold;">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <h3>Detail Pengeluaran</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tujuan</th>
                <th>Metode Pembayaran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($pengeluaran)): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data pengeluaran</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach($pengeluaran as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                        <td><?= $row->tujuan ?></td>
                        <td><?= $row->metode_pembayaran ?></td>
                        <td style="text-align: right;">Rp <?= number_format($row->jumlah, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="total">Total Pengeluaran:</td>
                    <td style="text-align: right; font-weight: bold;">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
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
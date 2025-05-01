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
        .total {
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
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
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tujuan</th>
                <th>Metode Pembayaran</th>
                <th>Jumlah</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($pengeluaran)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data pengeluaran pada periode yang dipilih</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach($pengeluaran as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d M Y', strtotime($row->tanggal)) ?></td>
                        <td><?= $row->tujuan ?></td>
                        <td><?= $row->metode_pembayaran ?></td>
                        <td style="text-align: right;">Rp <?= number_format($row->jumlah, 0, ',', '.') ?></td>
                        <td><?= $row->catatan ?: '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total Pengeluaran</strong></td>
                <td style="text-align: right;"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                <td></td>
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
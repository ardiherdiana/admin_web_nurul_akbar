<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Laporan Keuangan Tahunan</h1>

        <div class="flex space-x-2">
            <a href="<?= base_url('laporan/cetak_tahunan?tahun=' . $tahun) ?>" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Cetak Laporan
            </a>

            <a href="<?= base_url('laporan') ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
    <!-- Filter Tahun -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form action="<?= base_url('laporan/tahunan') ?>" method="get" class="flex items-end space-x-4">
            <div class="w-full md:w-1/3">
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tahun</label>
                <select id="tahun" name="tahun" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                    <?php for ($y = date('Y'); $y >= date('Y') - 5; $y--): ?>
                        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-filter mr-2"></i> Tampilkan
            </button>
        </form>
    </div>

    <!-- Ringkasan Keuangan Tahunan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Pemasukan -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <i class="fas fa-hand-holding-usd text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pemasukan <?= $tahun ?></p>
                    <p class="text-2xl font-bold">Rp <?= number_format($total_pemasukan_tahunan, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pengeluaran <?= $tahun ?></p>
                    <p class="text-2xl font-bold">Rp <?= number_format($total_pengeluaran_tahunan, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>

        <!-- Saldo -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Saldo Tahun <?= $tahun ?></p>
                    <p class="text-2xl font-bold <?= $saldo_tahunan >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                        Rp <?= number_format($saldo_tahunan, 0, ',', '.') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Bulanan -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-blue-600 text-white px-4 py-2">
            <h2 class="text-lg font-semibold">Laporan Keuangan Bulanan Tahun <?= $tahun ?></h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Pemasukan</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Pengeluaran</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($bulanan as $index => $bulan): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $bulan['bulan'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                Rp <?= number_format($bulan['total_pemasukan'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                Rp <?= number_format($bulan['total_pengeluaran'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-right <?= $bulan['saldo'] >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                                Rp <?= number_format($bulan['saldo'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <a href="<?= base_url('laporan?filter_type=bulan&tahun=' . $tahun . '&bulan=' . sprintf("%02d", $index)) ?>" class="text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td class="px-6 py-3 text-right font-semibold">Total:</td>
                        <td class="px-6 py-3 font-bold text-right text-green-600">
                            Rp <?= number_format($total_pemasukan_tahunan, 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-3 font-bold text-right text-red-600">
                            Rp <?= number_format($total_pengeluaran_tahunan, 0, ',', '.') ?>
                        </td>
                        <td class="px-6 py-3 font-bold text-right <?= $saldo_tahunan >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                            Rp <?= number_format($saldo_tahunan, 0, ',', '.') ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
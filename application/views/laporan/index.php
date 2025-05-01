<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Laporan Keuangan</h1>
        
        <div class="flex space-x-2">
            <?php $cetak_url = $filter_type == 'periode' ? 
                base_url('laporan/cetak?filter_type=periode&tanggal_mulai='.$tanggal_mulai.'&tanggal_akhir='.$tanggal_akhir) : 
                base_url('laporan/cetak?filter_type=bulan&tahun='.$tahun.'&bulan='.$bulan); ?>
                
            <a href="<?= $cetak_url ?>" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Cetak Laporan
            </a>
            
            <a href="<?= base_url('laporan/tahunan') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i> Laporan Tahunan
            </a>
        </div>
    </div>
    
    <!-- Filter Form -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Filter Laporan</h2>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="filter_type" value="bulan" class="text-primary-600 focus:ring-primary-500" <?= $filter_type == 'bulan' ? 'checked' : '' ?> onclick="toggleFilter('bulan')">
                    <span class="ml-2">Filter Berdasarkan Bulan</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="filter_type" value="periode" class="text-primary-600 focus:ring-primary-500" <?= $filter_type == 'periode' ? 'checked' : '' ?> onclick="toggleFilter('periode')">
                    <span class="ml-2">Filter Berdasarkan Periode</span>
                </label>
            </div>
        </div>
        
        <!-- Form Filter Bulan -->
        <form id="form-bulan" action="<?= base_url('laporan') ?>" method="get" class="grid grid-cols-1 md:grid-cols-3 gap-4 <?= $filter_type == 'bulan' ? '' : 'hidden' ?>">
            <input type="hidden" name="filter_type" value="bulan">
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <select id="tahun" name="tahun" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                    <?php for($y = date('Y'); $y >= date('Y')-5; $y--): ?>
                        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                <select id="bulan" name="bulan" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                    <option value="01" <?= $bulan == '01' ? 'selected' : '' ?>>Januari</option>
                    <option value="02" <?= $bulan == '02' ? 'selected' : '' ?>>Februari</option>
                    <option value="03" <?= $bulan == '03' ? 'selected' : '' ?>>Maret</option>
                    <option value="04" <?= $bulan == '04' ? 'selected' : '' ?>>April</option>
                    <option value="05" <?= $bulan == '05' ? 'selected' : '' ?>>Mei</option>
                    <option value="06" <?= $bulan == '06' ? 'selected' : '' ?>>Juni</option>
                    <option value="07" <?= $bulan == '07' ? 'selected' : '' ?>>Juli</option>
                    <option value="08" <?= $bulan == '08' ? 'selected' : '' ?>>Agustus</option>
                    <option value="09" <?= $bulan == '09' ? 'selected' : '' ?>>September</option>
                    <option value="10" <?= $bulan == '10' ? 'selected' : '' ?>>Oktober</option>
                    <option value="11" <?= $bulan == '11' ? 'selected' : '' ?>>November</option>
                    <option value="12" <?= $bulan == '12' ? 'selected' : '' ?>>Desember</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-filter mr-2"></i> Tampilkan
                </button>
            </div>
        </form>
        
        <!-- Form Filter Periode -->
        <form id="form-periode" action="<?= base_url('laporan') ?>" method="get" class="grid grid-cols-1 md:grid-cols-3 gap-4 <?= $filter_type == 'periode' ? '' : 'hidden' ?>">
            <input type="hidden" name="filter_type" value="periode">
            <div>
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?= $tanggal_mulai ?>" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-filter mr-2"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Ringkasan Keuangan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Pemasukan -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <i class="fas fa-hand-holding-usd text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pemasukan</p>
                    <p class="text-2xl font-bold">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></p>
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
                    <p class="text-sm text-gray-500 font-medium">Total Pengeluaran</p>
                    <p class="text-2xl font-bold">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></p>
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
                    <p class="text-sm text-gray-500 font-medium">Saldo</p>
                    <p class="text-2xl font-bold <?= $saldo >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                        Rp <?= number_format($saldo, 0, ',', '.') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Informasi Periode -->
    <div class="bg-gray-100 rounded-lg p-4 mb-6">
        <p class="text-center text-gray-700">
            <i class="fas fa-calendar mr-2"></i>
            Periode Laporan: <strong><?= date('d F Y', strtotime($tanggal_mulai)) ?></strong> s/d <strong><?= date('d F Y', strtotime($tanggal_akhir)) ?></strong>
        </p>
    </div>
    
    <!-- Detail Pemasukan dan Pengeluaran -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Tabel Pemasukan -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-green-600 text-white px-4 py-2">
                <h2 class="text-lg font-semibold">Detail Pemasukan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donatur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if(empty($pemasukan)): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data pemasukan</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($pemasukan as $row): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $row->nama_donatur ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row->jenis_pemasukan ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        Rp <?= number_format($row->jumlah, 0, ',', '.') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right font-semibold">Total Pemasukan:</td>
                            <td class="px-6 py-3 font-bold text-green-600">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <!-- Tabel Pengeluaran -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-red-600 text-white px-4 py-2">
                <h2 class="text-lg font-semibold">Detail Pengeluaran</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if(empty($pengeluaran)): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data pengeluaran</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($pengeluaran as $row): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d/m/Y', strtotime($row->tanggal)) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $row->tujuan ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row->metode_pembayaran ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        Rp <?= number_format($row->jumlah, 0, ',', '.') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right font-semibold">Total Pengeluaran:</td>
                            <td class="px-6 py-3 font-bold text-red-600">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFilter(type) {
        if (type === 'bulan') {
            document.getElementById('form-bulan').classList.remove('hidden');
            document.getElementById('form-periode').classList.add('hidden');
        } else {
            document.getElementById('form-bulan').classList.add('hidden');
            document.getElementById('form-periode').classList.remove('hidden');
        }
    }
</script>
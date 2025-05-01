<!-- application/views/dashboard/index.php -->
<div class="flex-1 p-6 overflow-auto">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Acara -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Acara</p>
                    <p class="text-2xl font-bold"><?= $total_acara ?></p>
                </div>
            </div>
            <div class="mt-2">
                <a href="<?= base_url('acara') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Detail <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
        
        <!-- Total Pengurus -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pengurus</p>
                    <p class="text-2xl font-bold"><?= $total_pengurus ?></p>
                </div>
            </div>
            <div class="mt-2">
                <a href="<?= base_url('pengurus') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Detail <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
        
        <!-- Total Pemasukan -->
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <i class="fas fa-hand-holding-usd text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pemasukan</p>
                    <p class="text-2xl font-bold format-rupiah"><?= $total_pemasukan ?></p>
                </div>
            </div>
            <div class="mt-2">
                <a href="<?= base_url('pemasukan') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Detail <i class="fas fa-arrow-right ml-1"></i></a>
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
                    <p class="text-2xl font-bold format-rupiah"><?= $total_pengeluaran ?></p>
                </div>
            </div>
            <div class="mt-2">
                <a href="<?= base_url('pengeluaran') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Detail <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Acara Terbaru -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="font-semibold text-lg">Acara Terbaru</h3>
                <a href="<?= base_url('acara') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Semua</a>
            </div>
            
            <div class="p-4">
                <?php if (empty($acara_terbaru)): ?>
                    <p class="text-gray-500 text-center py-4">Belum ada data acara</p>
                <?php else: ?>
                    <ul class="divide-y">
                        <?php foreach ($acara_terbaru as $acara): ?>
                            <li class="py-3">
                                <div class="flex items-start">
                                    <div class="p-2 rounded-full bg-yellow-100 text-yellow-500 mr-3">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium"><?= $acara->nama_acara ?></p>
                                        <div class="flex text-xs text-gray-500 mt-1">
                                            <p><i class="fas fa-clock mr-1"></i> <?= date('d M Y', strtotime($acara->tanggal)) ?> - <?= date('H:i', strtotime($acara->waktu)) ?></p>
                                            <p class="ml-3"><i class="fas fa-map-marker-alt mr-1"></i> <?= $acara->tempat ?></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Pemasukan Terbaru -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="font-semibold text-lg">Pemasukan Terbaru</h3>
                <a href="<?= base_url('pemasukan') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Semua</a>
            </div>
            
            <div class="p-4">
                <?php if (empty($pemasukan_terbaru)): ?>
                    <p class="text-gray-500 text-center py-4">Belum ada data pemasukan</p>
                <?php else: ?>
                    <ul class="divide-y">
                        <?php foreach ($pemasukan_terbaru as $pemasukan): ?>
                            <li class="py-3">
                                <div class="flex items-start">
                                    <div class="p-2 rounded-full bg-green-100 text-green-500 mr-3">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <p class="font-medium"><?= $pemasukan->nama_donatur ?></p>
                                            <p class="font-semibold format-rupiah"><?= $pemasukan->jumlah ?></p>
                                        </div>
                                        <div class="flex text-xs text-gray-500 mt-1">
                                            <p><i class="fas fa-calendar mr-1"></i> <?= date('d M Y', strtotime($pemasukan->tanggal)) ?></p>
                                            <p class="ml-3"><i class="fas fa-tag mr-1"></i> <?= $pemasukan->jenis_pemasukan ?></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Pengeluaran Terbaru -->
        <div class="bg-white rounded-lg shadow">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="font-semibold text-lg">Pengeluaran Terbaru</h3>
                <a href="<?= base_url('pengeluaran') ?>" class="text-sm text-primary-600 hover:text-primary-800">Lihat Semua</a>
            </div>
            
            <div class="p-4">
                <?php if (empty($pengeluaran_terbaru)): ?>
                    <p class="text-gray-500 text-center py-4">Belum ada data pengeluaran</p>
                <?php else: ?>
                    <ul class="divide-y">
                        <?php foreach ($pengeluaran_terbaru as $pengeluaran): ?>
                            <li class="py-3">
                                <div class="flex items-start">
                                    <div class="p-2 rounded-full bg-red-100 text-red-500 mr-3">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <p class="font-medium"><?= $pengeluaran->tujuan ?></p>
                                            <p class="font-semibold format-rupiah"><?= $pengeluaran->jumlah ?></p>
                                        </div>
                                        <div class="flex text-xs text-gray-500 mt-1">
                                            <p><i class="fas fa-calendar mr-1"></i> <?= date('d M Y', strtotime($pengeluaran->tanggal)) ?></p>
                                            <p class="ml-3"><i class="fas fa-credit-card mr-1"></i> <?= $pengeluaran->metode_pembayaran ?></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
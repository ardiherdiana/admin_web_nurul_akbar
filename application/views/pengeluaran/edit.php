<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Pengeluaran</h1>
        
        <a href="<?= base_url('pengeluaran') ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?= base_url('pengeluaran/update/'.$pengeluaran->id_pengeluaran) ?>" method="post">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="<?= $pengeluaran->tanggal ?>" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" id="jumlah" name="jumlah" value="<?= $pengeluaran->jumlah ?>" min="0" step="1000" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan Pengeluaran <span class="text-red-500">*</span></label>
                    <input type="text" id="tujuan" name="tujuan" value="<?= $pengeluaran->tujuan ?>" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran <span class="text-red-500">*</span></label>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Cash" <?= $pengeluaran->metode_pembayaran == 'Cash' ? 'selected' : '' ?>>Cash</option>
                        <option value="Transfer Bank" <?= $pengeluaran->metode_pembayaran == 'Transfer Bank' ? 'selected' : '' ?>>Transfer Bank</option>
                        <option value="Debit" <?= $pengeluaran->metode_pembayaran == 'Debit' ? 'selected' : '' ?>>Debit</option>
                        <option value="E-wallet" <?= $pengeluaran->metode_pembayaran == 'E-wallet' ? 'selected' : '' ?>>E-wallet</option>
                    </select>
                </div>
                
                <div class="md:col-span-2">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="4" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"><?= $pengeluaran->catatan ?></textarea>
                </div>
            </div>
            
            <div class="mt-6 text-right">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
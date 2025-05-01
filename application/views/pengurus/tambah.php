<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Tambah Pengurus</h1>
        
        <a href="<?= base_url('pengurus') ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?= base_url('pengurus/simpan') ?>" method="post" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_pengurus" class="block text-sm font-medium text-gray-700 mb-1">Nama Pengurus <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_pengurus" name="nama_pengurus" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" id="jabatan" name="jabatan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div class="col-span-2">
                    <label for="foto_pengurus" class="block text-sm font-medium text-gray-700 mb-1">Foto Pengurus</label>
                    <input type="file" id="foto_pengurus" name="foto_pengurus" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</p>
                </div>
                
                <div class="col-span-2">
                    <label for="jobdesk" class="block text-sm font-medium text-gray-700 mb-1">Jobdesk</label>
                    <textarea id="jobdesk" name="jobdesk" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"></textarea>
                </div>
                
                <div class="col-span-2">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"></textarea>
                </div>
            </div>
            
            <div class="mt-6 text-right">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
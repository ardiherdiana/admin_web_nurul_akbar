<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Artikel</h1>
        
        <a href="<?= base_url('artikel/tambah') ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tulis Artikel
        </a>
    </div>
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Publikasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Diperbarui</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(empty($artikel)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada artikel</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach($artikel as $row): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if(!empty($row->foto_artikel)): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($row->foto_artikel) ?>" alt="<?= $row->judul ?>" class="h-16 w-24 object-cover rounded">
                                    <?php else: ?>
                                        <div class="h-16 w-24 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= $row->judul ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($row->status == 'published'): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dipublikasikan
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Draft
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= $row->tanggal_publikasi ? date('d M Y', strtotime($row->tanggal_publikasi)) : '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= date('d M Y H:i', strtotime($row->updated_at)) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if($row->status == 'draft'): ?>
                                        <a href="<?= base_url('artikel/publikasi/'.$row->id_artikel) ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-globe"></i> Publikasikan
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('artikel/draft/'.$row->id_artikel) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-file"></i> Jadikan Draft
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('artikel/edit/'.$row->id_artikel) ?>" class="text-primary-600 hover:text-primary-900 mr-3">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" onclick="confirmDelete(<?= $row->id_artikel ?>)" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            window.location.href = '<?= base_url('artikel/hapus/') ?>' + id;
        }
    }
</script>
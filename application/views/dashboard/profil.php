<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Profil Admin</h1>

        <a href="<?= base_url('dashboard') ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Informasi Profil -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-primary-600 mx-auto flex items-center justify-center text-3xl font-semibold text-white">
                        <?= substr($admin->nama_admin, 0, 1) ?>
                    </div>
                    <h2 class="text-xl font-semibold mt-4"><?= $admin->nama_admin ?></h2>
                    <p class="text-gray-500">Administrator</p>
                </div>

                <div class="border-t pt-4">
                    <div class="mb-2">
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="font-medium"><?= $admin->nama_admin ?></p>
                    </div>


                    <div>
                        <p class="text-sm text-gray-500">Login Terakhir</p>
                        <p class="font-medium"><?= date('d M Y H:i') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit Profil -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4 pb-2 border-b">Edit Profil</h2>

                <form action="<?= base_url('dashboard/update_profil') ?>" method="post">
                    <div class="mb-4">
                        <label for="nama_admin" class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                        <input type="text" id="nama_admin" name="nama_admin" value="<?= $admin->nama_admin ?>" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                    </div>

                    <h3 class="text-md font-medium mt-6 mb-4 pb-2 border-b">Ubah Password</h3>
                    <p class="text-sm text-gray-500 mb-4">Kosongkan bidang password jika tidak ingin mengubah password.</p>

                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" id="new_password" name="new_password" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                        <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
                    </div>

                    <div class="mb-6">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="w-full p-2 rounded-md border border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tips Keamanan -->

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            // Reset pesan error
            document.querySelectorAll('.error-message').forEach(el => el.remove());

            // Jika ada field password yang diisi, semua field harus diisi
            if (currentPassword || newPassword || confirmPassword) {
                let hasError = false;

                if (!currentPassword) {
                    showError('current_password', 'Password saat ini harus diisi');
                    hasError = true;
                }

                if (!newPassword) {
                    showError('new_password', 'Password baru harus diisi');
                    hasError = true;
                } else if (newPassword.length < 6) {
                    showError('new_password', 'Password minimal 6 karakter');
                    hasError = true;
                }

                if (!confirmPassword) {
                    showError('confirm_password', 'Konfirmasi password harus diisi');
                    hasError = true;
                } else if (newPassword !== confirmPassword) {
                    showError('confirm_password', 'Konfirmasi password tidak cocok');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                }
            }
        });

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-red-500 text-xs mt-1 error-message';
            errorDiv.textContent = message;
            field.parentNode.appendChild(errorDiv);
        }
    });
</script>
<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Acara</h1>
        
        <a href="<?= base_url('acara') ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?= base_url('acara/update/'.$acara->id_acara) ?>" method="post" enctype="multipart/form-data" id="acaraForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label for="nama_acara" class="block text-sm font-medium text-gray-700 mb-1">Nama Acara <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_acara" name="nama_acara" value="<?= $acara->nama_acara ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="<?= $acara->tanggal ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="waktu" class="block text-sm font-medium text-gray-700 mb-1">Waktu <span class="text-red-500">*</span></label>
                    
                    <!-- Input tersembunyi untuk menyimpan nilai sebenarnya -->
                    <input type="hidden" id="waktu_value" name="waktu" value="<?= substr($acara->waktu, 0, 5) ?>" required>
                    
                    <!-- Div kustom untuk tampilan waktu format 24 jam -->
                    <div class="relative">
                        <input type="text" id="waktu_display"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 cursor-pointer"
                            readonly placeholder="00:00" value="<?= substr($acara->waktu, 0, 5) ?>" required>
                        <div id="jam_picker" class="hidden absolute mt-1 w-1/4 bg-white border border-gray-300 rounded-md shadow-lg z-10">
                            <div class="flex">
                                <!-- Jam -->
                                <div class="w-1/2 h-48 overflow-y-auto border-r">
                                    <div id="jam_list" class="py-1">
                                        <!-- Jam 00-23 akan ditambahkan melalui JavaScript -->
                                    </div>
                                </div>
                                <!-- Menit -->
                                <div class="w-1/2 h-48 overflow-y-auto">
                                    <div id="menit_list" class="py-1">
                                        <!-- Menit 00-59 akan ditambahkan melalui JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="tempat" class="block text-sm font-medium text-gray-700 mb-1">Tempat <span class="text-red-500">*</span></label>
                    <input type="text" id="tempat" name="tempat" value="<?= $acara->tempat ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
                </div>
                
                <div>
                    <label for="panitia" class="block text-sm font-medium text-gray-700 mb-1">Panitia</label>
                    <input type="text" id="panitia" name="panitia" value="<?= $acara->panitia ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                </div>
                
                <div class="col-span-2">
                    <label for="foto_acara" class="block text-sm font-medium text-gray-700 mb-1">Foto Acara</label>
                    <?php if(!empty($acara->foto_acara)): ?>
                        <div class="mb-2">
                            <img src="data:image/jpeg;base64,<?= base64_encode($acara->foto_acara) ?>" alt="<?= $acara->nama_acara ?>" class="h-32 w-auto object-cover rounded">
                            <p class="text-xs text-gray-500 mt-1">Foto saat ini. Upload foto baru untuk mengganti.</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" id="foto_acara" name="foto_acara" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</p>
                </div>
                
                <div class="col-span-2">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50"><?= $acara->catatan ?></textarea>
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

<script>
    // Fungsi untuk menambahkan nol di depan angka < 10
    function pad(num) {
        return num < 10 ? '0' + num : num;
    }
    
    // Elemen-elemen
    const waktuDisplay = document.getElementById('waktu_display');
    const waktuValue = document.getElementById('waktu_value');
    const jamPicker = document.getElementById('jam_picker');
    const jamList = document.getElementById('jam_list');
    const menitList = document.getElementById('menit_list');
    
    // Buat opsi jam (00-23)
    for (let i = 0; i < 24; i++) {
        const jamItem = document.createElement('div');
        jamItem.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer text-center';
        jamItem.textContent = pad(i);
        jamItem.onclick = function() {
            selectJam(i);
        };
        jamList.appendChild(jamItem);
    }
    
    // Buat opsi menit (00-59)
    for (let i = 0; i < 60; i++) {
        const menitItem = document.createElement('div');
        menitItem.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer text-center';
        menitItem.textContent = pad(i);
        menitItem.onclick = function() {
            selectMenit(i);
        };
        menitList.appendChild(menitItem);
    }
    
    // Set nilai awal dari database
    const initialTime = '<?= substr($acara->waktu, 0, 5) ?>'.split(':');
    let selectedJam = parseInt(initialTime[0]);
    let selectedMenit = parseInt(initialTime[1]);
    
    // Tampilkan atau sembunyikan picker
    waktuDisplay.onclick = function() {
        jamPicker.classList.toggle('hidden');
    };
    
    // Tutup picker saat klik di luar
    document.addEventListener('click', function(event) {
        if (!waktuDisplay.contains(event.target) && !jamPicker.contains(event.target)) {
            jamPicker.classList.add('hidden');
        }
    });
    
    // Pilih jam
    function selectJam(jam) {
        selectedJam = jam;
        updateDisplay();
    }
    
    // Pilih menit
    function selectMenit(menit) {
        selectedMenit = menit;
        updateDisplay();
        
        // Jika kedua-duanya sudah dipilih, sembunyikan picker
        if (selectedJam !== null && selectedMenit !== null) {
            jamPicker.classList.add('hidden');
        }
    }
    
    // Update tampilan dan nilai
    function updateDisplay() {
        if (selectedJam !== null && selectedMenit !== null) {
            const waktu = `${pad(selectedJam)}:${pad(selectedMenit)}`;
            waktuDisplay.value = waktu;
            waktuValue.value = waktu;
        }
    }

    // Form conflict checking
    document.getElementById('acaraForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const tanggal = document.getElementById('tanggal').value;
        const waktu = document.getElementById('waktu_value').value;
        const tempat = document.getElementById('tempat').value;
        const currentId = '<?= $acara->id_acara ?>';

        try {
            const response = await fetch('<?= base_url('acara/check_conflict') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `tanggal=${tanggal}&waktu=${waktu}&tempat=${tempat}&current_id=${currentId}`
            });

            const data = await response.json();
            
            if (data.conflict) {
                alert(data.message);
                return false;
            } else {
                this.submit();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memeriksa jadwal');
        }
    });
</script>
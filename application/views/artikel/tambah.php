<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Tulis Artikel</h1>
        
        <a href="<?= base_url('artikel') ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p><?= $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?= base_url('artikel/simpan') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" id="judul" name="judul" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
            </div>
            
            <div class="mb-6">
                <label for="foto_artikel" class="block text-sm font-medium text-gray-700 mb-1">Cover Artikel</label>
                <input type="file" id="foto_artikel" name="foto_artikel" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</p>
            </div>
            
            <div class="mb-6">
                <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel <span class="text-red-500">*</span></label>
                <div class="border rounded-md shadow-sm">
                    <div class="flex items-center gap-2 p-2 border-b">
                        <button type="button" onclick="document.execCommand('undo')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-undo"></i></button>
                        <button type="button" onclick="document.execCommand('redo')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-redo"></i></button>
                        <button type="button" onclick="document.execCommand('bold')" class="p-1 hover:bg-gray-100 rounded font-bold">B</button>
                        <button type="button" onclick="document.execCommand('italic')" class="p-1 hover:bg-gray-100 rounded italic">I</button>
                        <button type="button" onclick="document.execCommand('justifyLeft')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-align-left"></i></button>
                        <button type="button" onclick="document.execCommand('justifyCenter')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-align-center"></i></button>
                        <button type="button" onclick="document.execCommand('justifyRight')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-align-right"></i></button>
                        <button type="button" onclick="document.execCommand('insertUnorderedList')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-list-ul"></i></button>
                        <button type="button" onclick="document.execCommand('insertOrderedList')" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-list-ol"></i></button>
                        <button type="button" onclick="insertLink()" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-link"></i></button>
                        <button type="button" onclick="insertImage()" class="p-1 hover:bg-gray-100 rounded"><i class="fas fa-image"></i></button>
                    </div>
                    <div id="editor" contenteditable="true" class="w-full p-2 min-h-[300px] focus:outline-none"></div>
                    <textarea id="isi" name="isi" class="hidden"></textarea>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="draft" class="text-primary-600 focus:ring-primary-500" checked>
                        <span class="ml-2">Simpan sebagai Draft</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="published" class="text-primary-600 focus:ring-primary-500">
                        <span class="ml-2">Publikasikan</span>
                    </label>
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

<script>
    // Fungsi untuk preview gambar
    document.getElementById('foto_artikel').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (document.getElementById('preview')) {
                    document.getElementById('preview').src = e.target.result;
                } else {
                    const preview = document.createElement('img');
                    preview.id = 'preview';
                    preview.src = e.target.result;
                    preview.className = 'h-32 w-auto object-cover rounded mt-2';
                    document.getElementById('foto_artikel').parentNode.appendChild(preview);
                }
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    const editor = document.getElementById('editor');
    const hiddenTextarea = document.getElementById('isi');

    // Update hidden textarea before form submit
    document.querySelector('form').addEventListener('submit', function() {
        hiddenTextarea.value = editor.innerHTML;
    });

    // Handle keyboard shortcuts
    editor.addEventListener('keydown', function(e) {
        if (e.ctrlKey) {
            switch(e.key.toLowerCase()) {
                case 'b':
                    e.preventDefault();
                    document.execCommand('bold');
                    break;
                case 'i':
                    e.preventDefault();
                    document.execCommand('italic');
                    break;
            }
        }
    });

    function insertLink() {
        const url = prompt('Enter URL:');
        if (url) {
            document.execCommand('createLink', false, url);
        }
    }

    function insertImage() {
        const url = prompt('Enter image URL:');
        if (url) {
            document.execCommand('insertImage', false, url);
        }
    }
</script>
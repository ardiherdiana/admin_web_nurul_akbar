<div class="flex-1 p-6 overflow-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Artikel</h1>
        
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
        <form action="<?= base_url('artikel/update/' . $artikel->id_artikel) ?>" method="post" enctype="multipart/form-data" id="artikelEditForm">
            <div class="mb-6">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($artikel->judul) ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" required>
            </div>
            
            <div class="mb-6">
                <label for="foto_artikel" class="block text-sm font-medium text-gray-700 mb-1">Cover Artikel</label>
                <input type="file" id="foto_artikel" name="foto_artikel" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
                
                <?php if(!empty($artikel->foto_artikel)): ?>
                <div class="mt-2">
                    <p class="text-sm text-gray-700 mb-1">Gambar Saat Ini:</p>
                    <img src="data:image/jpeg;base64,<?= base64_encode($artikel->foto_artikel) ?>" class="h-32 w-auto object-cover rounded" alt="Cover artikel">
                </div>
                <?php endif; ?>
                
                <div id="image-preview-container" class="mt-2 hidden">
                    <p class="text-sm text-gray-700 mb-1">Gambar Baru:</p>
                    <img id="preview" class="h-32 w-auto object-cover rounded" alt="Preview gambar">
                </div>
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
                    <div id="editor" contenteditable="true" class="w-full p-2 min-h-[300px] focus:outline-none"><?= htmlspecialchars_decode($artikel->isi) ?></div>
                    <textarea id="isi" name="isi" class="hidden"></textarea>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="draft" class="text-primary-600 focus:ring-primary-500" <?= ($artikel->status == 'draft') ? 'checked' : '' ?>>
                        <span class="ml-2">Simpan sebagai Draft</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="published" class="text-primary-600 focus:ring-primary-500" <?= ($artikel->status == 'published') ? 'checked' : '' ?>>
                        <span class="ml-2">Publikasikan</span>
                    </label>
                </div>
            </div>
            
            <div class="mt-6 text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-save mr-2"></i> Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Remove CKEditor script -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editor = document.getElementById('editor');
        const hiddenTextarea = document.getElementById('isi');
        const form = document.getElementById('artikelEditForm');

        // Update hidden textarea before form submit
        form.addEventListener('submit', function(e) {
            const content = editor.innerHTML.trim();
            if (!content) {
                e.preventDefault();
                alert('Isi artikel tidak boleh kosong!');
                return false;
            }
            hiddenTextarea.value = content;
            
            const judulContent = document.getElementById('judul').value.trim();
            if (!judulContent) {
                e.preventDefault();
                alert('Judul artikel tidak boleh kosong!');
                return false;
            }
            return true;
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

    // Existing image preview code remains the same...
</script>
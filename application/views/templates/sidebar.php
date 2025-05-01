<!-- Sidebar -->
<aside class="bg-primary-800 text-white w-64 min-h-screen flex flex-col">
    <!-- Logo -->
    <div class="p-4 border-b border-primary-700">
        <div class="flex items-center justify-center">
            <h1 class="text-xl font-bold">Masjid Nurul Akbar</h1>
        </div>
    </div>
    
    <!-- User Info -->
    <div class="p-4 border-b border-primary-700">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-lg font-semibold">
                <?= substr($this->session->userdata('admin_name') ?? 'A', 0, 1) ?>
            </div>
            <div class="ml-3">
                <p class="font-medium"><?= $this->session->userdata('admin_name') ?? 'Admin' ?></p>
                <p class="text-xs text-primary-300">Administrator</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto p-4">
        <ul class="space-y-1">
            <li>
                <a href="<?= base_url('dashboard') ?>" class="<?= $this->uri->segment(1) == 'dashboard' && !$this->uri->segment(2) ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            
            <li class="mt-4">
                <p class="text-xs text-primary-400 uppercase font-semibold mb-2 px-4">Master Data</p>
            </li>
            
            <li>
                <a href="<?= base_url('acara') ?>" class="<?= $this->uri->segment(1) == 'acara' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span class="ml-3">Acara</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('pengurus') ?>" class="<?= $this->uri->segment(1) == 'pengurus' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Pengurus</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('artikel') ?>" class="<?= $this->uri->segment(1) == 'artikel' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="ml-3">Artikel</span>
                </a>
            </li>
            
            <li class="mt-4">
                <p class="text-xs text-primary-400 uppercase font-semibold mb-2 px-4">Keuangan</p>
            </li>
            
            <li>
                <a href="<?= base_url('pemasukan') ?>" class="<?= $this->uri->segment(1) == 'pemasukan' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-hand-holding-usd w-5"></i>
                    <span class="ml-3">Pemasukan</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('pengeluaran') ?>" class="<?= $this->uri->segment(1) == 'pengeluaran' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-money-bill-wave w-5"></i>
                    <span class="ml-3">Pengeluaran</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('laporan') ?>" class="<?= $this->uri->segment(1) == 'laporan' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="ml-3">Laporan Keuangan</span>
                </a>
            </li>
            
            <li class="mt-4">
                <p class="text-xs text-primary-400 uppercase font-semibold mb-2 px-4">Pengaturan</p>
            </li>
            
            <li>
                <a href="<?= base_url('dashboard/profil') ?>" class="<?= $this->uri->segment(2) == 'profil' ? 'bg-primary-700' : 'hover:bg-primary-700' ?> px-4 py-2 rounded flex items-center">
                    <i class="fas fa-user-cog w-5"></i>
                    <span class="ml-3">Profil Admin</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('auth/logout') ?>" class="hover:bg-red-700 px-4 py-2 rounded flex items-center text-red-200">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- Footer -->
    <div class="p-4 border-t border-primary-700 text-center text-xs text-primary-400">
        &copy; <?= date('Y') ?> Masjid Nurul Akbar
    </div>
</aside>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin' ?> — RT 01</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="admin-page">

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <span>🏘️</span>
            <div>
                <div class="sidebar-brand-rt">RT 01 / RW 05</div>
                <div class="sidebar-brand-desa">Admin Panel</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="<?= base_url('admin') ?>" class="sidebar-link <?= ($title == 'Dashboard Admin') ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>

        <div class="nav-section-label">Konten</div>
        <a href="<?= base_url('admin/berita') ?>" class="sidebar-link <?= (strpos($title, 'Berita') !== false) ? 'active' : '' ?>">
            <i class="fas fa-newspaper"></i>
            <span>Berita</span>
        </a>
        <a href="<?= base_url('admin/agenda') ?>" class="sidebar-link <?= (strpos($title, 'Agenda') !== false) ? 'active' : '' ?>">
            <i class="fas fa-calendar-alt"></i>
            <span>Agenda</span>
        </a>

        <div class="nav-section-label">Lainnya</div>
        <a href="<?= base_url() ?>" class="sidebar-link" target="_blank">
            <i class="fas fa-globe"></i>
            <span>Lihat Website</span>
        </a>
        <a href="<?= base_url('admin/logout') ?>" class="sidebar-link sidebar-link-logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </nav>
</aside>

<!-- Main -->
<div class="admin-main" id="adminMain">
    <!-- Top Bar -->
    <header class="admin-topbar">
        <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="topbar-title"><?= isset($title) ? $title : 'Admin' ?></div>
        <div class="topbar-user">
            <i class="fas fa-user-circle"></i>
            <span><?= $this->session->userdata('admin_nama') ?></span>
        </div>
    </header>

    <!-- Content -->
    <div class="admin-content">

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?= $this->session->flashdata('success') ?>
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            <?= $this->session->flashdata('error') ?>
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="dashboard-stats">
            <div class="stat-card-admin">
                <div class="stat-card-icon news">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-number"><?= $total_berita ?></div>
                    <div class="stat-card-label">Total Berita</div>
                </div>
            </div>
            <div class="stat-card-admin">
                <div class="stat-card-icon publish">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-number"><?= $berita_publish ?></div>
                    <div class="stat-card-label">Berita Publish</div>
                </div>
            </div>
            <div class="stat-card-admin">
                <div class="stat-card-icon agenda">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-number"><?= $total_agenda ?></div>
                    <div class="stat-card-label">Total Agenda</div>
                </div>
            </div>
            <div class="stat-card-admin">
                <div class="stat-card-icon upcoming">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-number"><?= $agenda_upcoming ?></div>
                    <div class="stat-card-label">Agenda Mendatang</div>
                </div>
            </div>
        </div>

        <!-- Tables Row -->
        <div class="dashboard-tables">
            <!-- Berita Terbaru -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3><i class="fas fa-newspaper"></i> Berita Terbaru</h3>
                    <a href="<?= base_url('admin/berita/tambah') ?>" class="btn-admin-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($berita_terbaru && count($berita_terbaru) > 0): ?>
                                <?php foreach ($berita_terbaru as $b): ?>
                                <tr>
                                    <td><?= htmlspecialchars(substr($b->judul, 0, 40)) ?><?= strlen($b->judul) > 40 ? '...' : '' ?></td>
                                    <td><?= date('d/m/Y', strtotime($b->tanggal)) ?></td>
                                    <td>
                                        <span class="status-badge <?= $b->status ?>">
                                            <?= ucfirst($b->status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/berita/edit/' . $b->id) ?>" class="btn-table-edit"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('admin/berita/hapus/' . $b->id) ?>" class="btn-table-delete" onclick="return confirm('Hapus berita ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted">Belum ada berita</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="admin-card-footer">
                    <a href="<?= base_url('admin/berita') ?>">Lihat semua berita →</a>
                </div>
            </div>

            <!-- Agenda Terbaru -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3><i class="fas fa-calendar-alt"></i> Agenda</h3>
                    <a href="<?= base_url('admin/agenda/tambah') ?>" class="btn-admin-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($agenda_terbaru && count($agenda_terbaru) > 0): ?>
                                <?php foreach ($agenda_terbaru as $a): ?>
                                <tr>
                                    <td><?= htmlspecialchars(substr($a->judul, 0, 40)) ?><?= strlen($a->judul) > 40 ? '...' : '' ?></td>
                                    <td><?= date('d/m/Y', strtotime($a->tanggal)) ?></td>
                                    <td>
                                        <span class="status-badge <?= $a->status ?>">
                                            <?= $a->status == 'upcoming' ? 'Mendatang' : 'Selesai' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/agenda/edit/' . $a->id) ?>" class="btn-table-edit"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('admin/agenda/hapus/' . $a->id) ?>" class="btn-table-delete" onclick="return confirm('Hapus agenda ini?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted">Belum ada agenda</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="admin-card-footer">
                    <a href="<?= base_url('admin/agenda') ?>">Lihat semua agenda →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('adminMain').classList.toggle('expanded');
}
</script>
</body>
</html>

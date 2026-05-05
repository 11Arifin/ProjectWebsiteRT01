<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> — RT 01</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="admin-page">

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
        <a href="<?= base_url('admin') ?>" class="sidebar-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        <div class="nav-section-label">Konten</div>
        <a href="<?= base_url('admin/berita') ?>" class="sidebar-link"><i class="fas fa-newspaper"></i><span>Berita</span></a>
        <a href="<?= base_url('admin/agenda') ?>" class="sidebar-link active"><i class="fas fa-calendar-alt"></i><span>Agenda</span></a>
        <div class="nav-section-label">Lainnya</div>
        <a href="<?= base_url() ?>" class="sidebar-link" target="_blank"><i class="fas fa-globe"></i><span>Lihat Website</span></a>
        <a href="<?= base_url('admin/logout') ?>" class="sidebar-link sidebar-link-logout"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </nav>
</aside>

<div class="admin-main" id="adminMain">
    <header class="admin-topbar">
        <button class="sidebar-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        <div class="topbar-title"><?= $title ?></div>
        <div class="topbar-user">
            <i class="fas fa-user-circle"></i>
            <span><?= $this->session->userdata('admin_nama') ?></span>
        </div>
    </header>

    <div class="admin-content">
        <!-- Flash -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?= $this->session->flashdata('success') ?>
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
        <?php endif; ?>

        <div class="admin-card">
            <div class="admin-card-header">
                <h3><i class="fas fa-calendar-alt"></i> Daftar Agenda</h3>
                <a href="<?= base_url('admin/agenda/tambah') ?>" class="btn-admin-primary">
                    <i class="fas fa-plus"></i> Tambah Agenda
                </a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Judul</th>
                            <th width="12%">Tanggal</th>
                            <th width="10%">Waktu</th>
                            <th width="18%">Lokasi</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($agenda && count($agenda) > 0): ?>
                            <?php foreach ($agenda as $i => $a): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= htmlspecialchars(substr($a->judul, 0, 50)) ?><?= strlen($a->judul) > 50 ? '...' : '' ?></strong></td>
                                <td><?= date('d/m/Y', strtotime($a->tanggal)) ?></td>
                                <td><?= $a->waktu ? date('H:i', strtotime($a->waktu)) : '—' ?></td>
                                <td><?= $a->lokasi ? htmlspecialchars(substr($a->lokasi, 0, 25)) : '<span class="text-muted">—</span>' ?></td>
                                <td>
                                    <span class="status-badge <?= $a->status ?>">
                                        <?= $a->status == 'upcoming' ? 'Mendatang' : 'Selesai' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="<?= base_url('admin/agenda/edit/' . $a->id) ?>" class="btn-table-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('admin/agenda/hapus/' . $a->id) ?>" class="btn-table-delete" title="Hapus"
                                           onclick="return confirm('Yakin hapus agenda ini?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted" style="padding: 2rem;">
                                    <i class="fas fa-calendar-times" style="font-size: 2rem; opacity:.3;"></i><br>
                                    Belum ada agenda. <a href="<?= base_url('admin/agenda/tambah') ?>">Tambah sekarang</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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

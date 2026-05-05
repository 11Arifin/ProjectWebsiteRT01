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
        <div class="admin-card">
            <div class="admin-card-header">
                <h3>
                    <i class="fas fa-<?= $action == 'tambah' ? 'plus' : 'edit' ?>"></i>
                    <?= $title ?>
                </h3>
                <a href="<?= base_url('admin/agenda') ?>" class="btn-admin-outline">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="form-area">
                <?php
                $form_action = ($action == 'tambah')
                    ? base_url('admin/agenda/simpan')
                    : base_url('admin/agenda/update/' . (isset($agenda) ? $agenda->id : ''));
                ?>
                <form action="<?= $form_action ?>" method="post" class="admin-form">

                    <div class="form-group">
                        <label class="form-label">Judul Agenda <span class="required">*</span></label>
                        <input type="text" name="judul" class="form-input"
                               placeholder="Masukkan judul kegiatan"
                               value="<?= isset($agenda) ? htmlspecialchars($agenda->judul) : set_value('judul') ?>"
                               required>
                    </div>

                    <div class="form-row-3">
                        <div class="form-group">
                            <label class="form-label">Tanggal <span class="required">*</span></label>
                            <input type="date" name="tanggal" class="form-input"
                                   value="<?= isset($agenda) ? $agenda->tanggal : date('Y-m-d') ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Waktu</label>
                            <input type="time" name="waktu" class="form-input"
                                   value="<?= isset($agenda) ? $agenda->waktu : '08:00' ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select name="status" class="form-input">
                                <option value="upcoming" <?= !isset($agenda) || $agenda->status == 'upcoming' ? 'selected' : '' ?>>Mendatang</option>
                                <option value="done" <?= isset($agenda) && $agenda->status == 'done' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lokasi Kegiatan</label>
                        <input type="text" name="lokasi" class="form-input"
                               placeholder="misal: Balai RT, Masjid Al-Ikhlas, dll"
                               value="<?= isset($agenda) ? htmlspecialchars($agenda->lokasi) : set_value('lokasi') ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" class="form-textarea"
                                  placeholder="Tulis detail kegiatan..."
                                  rows="6"><?= isset($agenda) ? htmlspecialchars($agenda->deskripsi) : set_value('deskripsi') ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-admin-primary">
                            <i class="fas fa-save"></i>
                            <?= $action == 'tambah' ? 'Simpan Agenda' : 'Perbarui Agenda' ?>
                        </button>
                        <a href="<?= base_url('admin/agenda') ?>" class="btn-admin-outline">Batal</a>
                    </div>
                </form>
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

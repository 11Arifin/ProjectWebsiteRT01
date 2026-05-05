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
        <a href="<?= base_url('admin/berita') ?>" class="sidebar-link active"><i class="fas fa-newspaper"></i><span>Berita</span></a>
        <a href="<?= base_url('admin/agenda') ?>" class="sidebar-link"><i class="fas fa-calendar-alt"></i><span>Agenda</span></a>
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
                <a href="<?= base_url('admin/berita') ?>" class="btn-admin-outline">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="form-area">
                <?php
                $form_action = ($action == 'tambah')
                    ? base_url('admin/berita/simpan')
                    : base_url('admin/berita/update/' . (isset($berita) ? $berita->id : ''));
                ?>
                <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="admin-form">

                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Judul Berita <span class="required">*</span></label>
                            <input type="text" name="judul" class="form-input"
                                   placeholder="Masukkan judul berita"
                                   value="<?= isset($berita) ? htmlspecialchars($berita->judul) : set_value('judul') ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-input"
                                   placeholder="misal: Pengumuman, Kegiatan, dll"
                                   value="<?= isset($berita) ? htmlspecialchars($berita->kategori) : set_value('kategori') ?>">
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">Tanggal <span class="required">*</span></label>
                            <input type="date" name="tanggal" class="form-input"
                                   value="<?= isset($berita) ? $berita->tanggal : date('Y-m-d') ?>"
                                   required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select name="status" class="form-input">
                                <option value="draft" <?= (isset($berita) && $berita->status == 'draft') || !isset($berita) ? 'selected' : '' ?>>Draft</option>
                                <option value="publish" <?= isset($berita) && $berita->status == 'publish' ? 'selected' : '' ?>>Publish</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konten Berita <span class="required">*</span></label>
                        <textarea name="konten" class="form-textarea"
                                  placeholder="Tulis konten berita di sini..."
                                  rows="10" required><?= isset($berita) ? htmlspecialchars($berita->konten) : set_value('konten') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Gambar Berita</label>
                        <?php if (isset($berita) && $berita->gambar): ?>
                        <div class="current-img-preview">
                            <img src="<?= base_url('assets/img/berita/' . $berita->gambar) ?>" alt="Gambar saat ini">
                            <p class="text-muted">Gambar saat ini. Upload baru untuk mengganti.</p>
                        </div>
                        <?php endif; ?>
                        <div class="file-input-wrap">
                            <input type="file" name="gambar" id="gambarInput" class="file-input"
                                   accept="image/*" onchange="previewImage(this)">
                            <label for="gambarInput" class="file-input-label">
                                <i class="fas fa-upload"></i>
                                <span>Pilih Gambar</span>
                                <small>JPG, PNG, WebP — maks 2MB</small>
                            </label>
                            <div id="imgPreview" class="img-preview" style="display:none;">
                                <img id="previewSrc" src="#" alt="Preview">
                                <button type="button" onclick="clearPreview()" class="clear-preview">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-admin-primary">
                            <i class="fas fa-save"></i>
                            <?= $action == 'tambah' ? 'Simpan Berita' : 'Perbarui Berita' ?>
                        </button>
                        <a href="<?= base_url('admin/berita') ?>" class="btn-admin-outline">
                            Batal
                        </a>
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
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('previewSrc').src = e.target.result;
            document.getElementById('imgPreview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function clearPreview() {
    document.getElementById('gambarInput').value = '';
    document.getElementById('imgPreview').style.display = 'none';
}
</script>
</body>
</html>

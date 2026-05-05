<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg"></div>
    <div class="container">
        <div class="page-header-content">
            <div class="breadcrumb">
                <a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a>
                <span>/</span>
                <a href="<?= base_url('berita') ?>">Berita</a>
                <span>/</span>
                <span><?= substr(htmlspecialchars($berita->judul), 0, 40) ?>...</span>
            </div>
            <h1 class="page-title"><?= htmlspecialchars($berita->judul) ?></h1>
            <div class="article-meta-header">
                <?php if ($berita->kategori): ?>
                <span class="article-category"><i class="fas fa-tag"></i> <?= htmlspecialchars($berita->kategori) ?></span>
                <?php endif; ?>
                <span class="article-date"><i class="fas fa-calendar-alt"></i> <?= date('d F Y', strtotime($berita->tanggal)) ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Konten Artikel -->
<section class="section">
    <div class="container">
        <div class="article-layout">
            <!-- Main Content -->
            <article class="article-main">
                <?php if ($berita->gambar): ?>
                <div class="article-hero-img">
                    <img src="<?= base_url('assets/img/berita/' . $berita->gambar) ?>"
                         alt="<?= htmlspecialchars($berita->judul) ?>">
                </div>
                <?php endif; ?>

                <div class="article-body">
                    <?= nl2br($berita->konten) ?>
                </div>

                <div class="article-share">
                    <span><i class="fas fa-share-alt"></i> Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
                       target="_blank" class="share-btn facebook" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://wa.me/?text=<?= urlencode($berita->judul . ' ' . current_url()) ?>"
                       target="_blank" class="share-btn whatsapp" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=<?= urlencode($berita->judul) ?>&url=<?= urlencode(current_url()) ?>"
                       target="_blank" class="share-btn twitter" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>

                <div class="article-back">
                    <a href="<?= base_url('berita') ?>" class="btn-outline">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita
                    </a>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="article-sidebar">
                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fas fa-info-circle"></i> Info Artikel</h3>
                    <ul class="widget-info">
                        <li>
                            <span>Tanggal</span>
                            <strong><?= date('d M Y', strtotime($berita->tanggal)) ?></strong>
                        </li>
                        <?php if ($berita->kategori): ?>
                        <li>
                            <span>Kategori</span>
                            <strong><?= htmlspecialchars($berita->kategori) ?></strong>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fas fa-link"></i> Menu Cepat</h3>
                    <ul class="widget-links">
                        <li><a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a></li>
                        <li><a href="<?= base_url('berita') ?>"><i class="fas fa-newspaper"></i> Semua Berita</a></li>
                        <li><a href="<?= base_url('agenda') ?>"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

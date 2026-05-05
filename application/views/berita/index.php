<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg"></div>
    <div class="container">
        <div class="page-header-content">
            <div class="breadcrumb">
                <a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a>
                <span>/</span>
                <span>Berita</span>
            </div>
            <h1 class="page-title"><i class="fas fa-newspaper"></i> Berita Terkini</h1>
            <p class="page-subtitle">Informasi dan berita terbaru seputar RT 01 Desa Sejahtera</p>
        </div>
    </div>
</section>

<!-- Konten Berita -->
<section class="section">
    <div class="container">

        <!-- Search Bar -->
        <div class="search-bar-wrap">
            <form action="<?= base_url('berita') ?>" method="get" class="search-form">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="q" class="search-input"
                           placeholder="Cari berita..."
                           value="<?= htmlspecialchars($keyword ?? '') ?>">
                    <button type="submit" class="search-btn">Cari</button>
                </div>
            </form>
        </div>

        <?php if ($keyword): ?>
        <div class="search-result-info">
            <i class="fas fa-filter"></i>
            Menampilkan hasil pencarian untuk: <strong>"<?= htmlspecialchars($keyword) ?>"</strong>
            — <?= $total ?> hasil ditemukan
            <a href="<?= base_url('berita') ?>" class="search-clear">
                <i class="fas fa-times"></i> Hapus Filter
            </a>
        </div>
        <?php endif; ?>

        <?php if ($berita && count($berita) > 0): ?>
        <div class="cards-grid">
            <?php foreach ($berita as $index => $item): ?>
            <article class="card animate-fadeInUp delay-<?= $index % 3 ?>">
                <div class="card-img-wrap">
                    <?php if ($item->gambar): ?>
                        <img src="<?= base_url('assets/img/berita/' . $item->gambar) ?>"
                             alt="<?= htmlspecialchars($item->judul) ?>" class="card-img">
                    <?php else: ?>
                        <div class="card-img-placeholder">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($item->kategori): ?>
                    <span class="card-badge"><?= htmlspecialchars($item->kategori) ?></span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="card-meta">
                        <span><i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($item->tanggal)) ?></span>
                    </div>
                    <h2 class="card-title">
                        <a href="<?= base_url('berita/' . $item->slug) ?>">
                            <?= htmlspecialchars($item->judul) ?>
                        </a>
                    </h2>
                    <p class="card-excerpt">
                        <?= substr(strip_tags($item->konten), 0, 130) ?>...
                    </p>
                    <a href="<?= base_url('berita/' . $item->slug) ?>" class="card-readmore">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pagination): ?>
        <div class="pagination-wrap">
            <?= $pagination ?>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-newspaper"></i>
            <h3>Belum Ada Berita</h3>
            <p>
                <?php if ($keyword): ?>
                    Tidak ada berita yang cocok dengan pencarian "<strong><?= htmlspecialchars($keyword) ?></strong>".
                <?php else: ?>
                    Belum ada berita yang dipublikasikan saat ini.
                <?php endif; ?>
            </p>
            <?php if ($keyword): ?>
            <a href="<?= base_url('berita') ?>" class="btn-primary" style="margin-top:1rem;">Lihat Semua Berita</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

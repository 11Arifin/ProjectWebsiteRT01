<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg"></div>
    <div class="container">
        <div class="page-header-content">
            <div class="breadcrumb">
                <a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a>
                <span>/</span>
                <a href="<?= base_url('agenda') ?>">Agenda</a>
                <span>/</span>
                <span>Detail</span>
            </div>
            <h1 class="page-title"><?= htmlspecialchars($agenda->judul) ?></h1>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="article-layout">
            <!-- Detail Agenda -->
            <div class="article-main">
                <div class="agenda-detail-card">
                    <!-- Header Info -->
                    <div class="agenda-detail-header">
                        <div class="agenda-detail-date-big">
                            <div class="agenda-date-box-big <?= $agenda->status ?>">
                                <span class="agenda-day"><?= date('d', strtotime($agenda->tanggal)) ?></span>
                                <span class="agenda-month"><?= date('F', strtotime($agenda->tanggal)) ?></span>
                                <span class="agenda-year"><?= date('Y', strtotime($agenda->tanggal)) ?></span>
                            </div>
                        </div>
                        <div class="agenda-detail-info-wrap">
                            <span class="agenda-badge <?= $agenda->status ?>">
                                <?= $agenda->status == 'upcoming' ? 'Mendatang' : 'Selesai' ?>
                            </span>
                            <div class="agenda-detail-meta">
                                <?php if ($agenda->waktu): ?>
                                <div class="detail-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <span class="meta-label">Waktu</span>
                                        <span class="meta-value"><?= date('H:i', strtotime($agenda->waktu)) ?> WIB</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($agenda->lokasi): ?>
                                <div class="detail-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <span class="meta-label">Lokasi</span>
                                        <span class="meta-value"><?= htmlspecialchars($agenda->lokasi) ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="detail-meta-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div>
                                        <span class="meta-label">Tanggal</span>
                                        <span class="meta-value"><?= date('l, d F Y', strtotime($agenda->tanggal)) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <?php if ($agenda->deskripsi): ?>
                    <div class="agenda-detail-body">
                        <h2><i class="fas fa-info-circle"></i> Deskripsi Kegiatan</h2>
                        <div class="agenda-deskripsi">
                            <?= nl2br(htmlspecialchars($agenda->deskripsi)) ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Share -->
                    <div class="article-share" style="margin-top: 2rem;">
                        <span><i class="fas fa-share-alt"></i> Bagikan:</span>
                        <a href="https://wa.me/?text=<?= urlencode('Agenda: ' . $agenda->judul . ' - ' . current_url()) ?>"
                           target="_blank" class="share-btn whatsapp" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
                           target="_blank" class="share-btn facebook" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>

                    <div class="article-back">
                        <a href="<?= base_url('agenda') ?>" class="btn-outline">
                            <i class="fas fa-arrow-left"></i> Kembali ke Agenda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="article-sidebar">
                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fas fa-info-circle"></i> Ringkasan</h3>
                    <ul class="widget-info">
                        <li>
                            <span>Tanggal</span>
                            <strong><?= date('d M Y', strtotime($agenda->tanggal)) ?></strong>
                        </li>
                        <?php if ($agenda->waktu): ?>
                        <li>
                            <span>Waktu</span>
                            <strong><?= date('H:i', strtotime($agenda->waktu)) ?> WIB</strong>
                        </li>
                        <?php endif; ?>
                        <?php if ($agenda->lokasi): ?>
                        <li>
                            <span>Lokasi</span>
                            <strong><?= htmlspecialchars($agenda->lokasi) ?></strong>
                        </li>
                        <?php endif; ?>
                        <li>
                            <span>Status</span>
                            <strong>
                                <span class="agenda-badge <?= $agenda->status ?>">
                                    <?= $agenda->status == 'upcoming' ? 'Mendatang' : 'Selesai' ?>
                                </span>
                            </strong>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-widget">
                    <h3 class="widget-title"><i class="fas fa-link"></i> Menu Cepat</h3>
                    <ul class="widget-links">
                        <li><a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a></li>
                        <li><a href="<?= base_url('berita') ?>"><i class="fas fa-newspaper"></i> Berita</a></li>
                        <li><a href="<?= base_url('agenda') ?>"><i class="fas fa-calendar-alt"></i> Semua Agenda</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

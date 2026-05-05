<!-- Hero Section -->
<section class="hero" id="beranda">
    <div class="hero-bg"></div>
    <div class="hero-particles" id="heroParticles"></div>
    <div class="hero-content">
        <div class="hero-badge animate-fadeInUp">
            <i class="fas fa-star"></i> Selamat Datang di Website Resmi
        </div>
        <h1 class="hero-title animate-fadeInUp delay-1">
            RT 01 / RW 05 <br>
            <span class="hero-title-accent">Desa Sejahtera</span>
        </h1>
        <p class="hero-subtitle animate-fadeInUp delay-2">
            Portal informasi resmi warga RT 01. Temukan berita terkini, agenda kegiatan, 
            dan informasi penting seputar lingkungan kita.
        </p>
        <div class="hero-buttons animate-fadeInUp delay-3">
            <a href="<?= base_url('berita') ?>" class="btn-primary">
                <i class="fas fa-newspaper"></i> Baca Berita
            </a>
            <a href="<?= base_url('agenda') ?>" class="btn-outline">
                <i class="fas fa-calendar-alt"></i> Lihat Agenda
            </a>
        </div>
    </div>
    <div class="hero-scroll-indicator">
        <div class="scroll-dot"></div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card animate-fadeInUp">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number" data-target="248">0</div>
                <div class="stat-label">Total Warga</div>
            </div>
            <div class="stat-card animate-fadeInUp delay-1">
                <div class="stat-icon"><i class="fas fa-home"></i></div>
                <div class="stat-number" data-target="67">0</div>
                <div class="stat-label">Kepala Keluarga</div>
            </div>
            <div class="stat-card animate-fadeInUp delay-2">
                <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
                <div class="stat-number" data-target="<?= $berita_terbaru ? count($berita_terbaru) : 0 ?>">0</div>
                <div class="stat-label">Berita Terkini</div>
            </div>
            <div class="stat-card animate-fadeInUp delay-3">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="stat-number" data-target="<?= $agenda_upcoming ? count($agenda_upcoming) : 0 ?>">0</div>
                <div class="stat-label">Agenda Mendatang</div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terbaru Section -->
<section class="section" id="berita-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-newspaper"></i> Informasi Terkini</div>
            <h2 class="section-title">Berita Terbaru</h2>
            <p class="section-desc">Ikuti perkembangan informasi dan kegiatan terkini di lingkungan RT 01</p>
        </div>

        <?php if ($berita_terbaru && count($berita_terbaru) > 0): ?>
        <div class="cards-grid">
            <?php foreach ($berita_terbaru as $index => $berita): ?>
            <article class="card animate-fadeInUp delay-<?= $index ?>">
                <div class="card-img-wrap">
                    <?php if ($berita->gambar): ?>
                        <img src="<?= base_url('assets/img/berita/' . $berita->gambar) ?>" 
                             alt="<?= htmlspecialchars($berita->judul) ?>" class="card-img">
                    <?php else: ?>
                        <div class="card-img-placeholder">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($berita->kategori): ?>
                    <span class="card-badge"><?= htmlspecialchars($berita->kategori) ?></span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="card-meta">
                        <span><i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($berita->tanggal)) ?></span>
                    </div>
                    <h3 class="card-title">
                        <a href="<?= base_url('berita/' . $berita->slug) ?>">
                            <?= htmlspecialchars($berita->judul) ?>
                        </a>
                    </h3>
                    <p class="card-excerpt">
                        <?= substr(strip_tags($berita->konten), 0, 120) ?>...
                    </p>
                    <a href="<?= base_url('berita/' . $berita->slug) ?>" class="card-readmore">
                        Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-newspaper"></i>
            <p>Belum ada berita yang dipublikasikan.</p>
        </div>
        <?php endif; ?>

        <div class="section-action">
            <a href="<?= base_url('berita') ?>" class="btn-primary">
                Lihat Semua Berita <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Agenda Section -->
<section class="section section-alt" id="agenda-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-calendar-alt"></i> Jadwal Kegiatan</div>
            <h2 class="section-title">Agenda Mendatang</h2>
            <p class="section-desc">Jangan sampai ketinggalan kegiatan-kegiatan penting di RT 01 kita</p>
        </div>

        <?php if ($agenda_upcoming && count($agenda_upcoming) > 0): ?>
        <div class="agenda-list">
            <?php foreach ($agenda_upcoming as $index => $agenda): ?>
            <div class="agenda-card animate-fadeInUp delay-<?= $index ?>">
                <div class="agenda-date-box">
                    <span class="agenda-day"><?= date('d', strtotime($agenda->tanggal)) ?></span>
                    <span class="agenda-month"><?= date('M', strtotime($agenda->tanggal)) ?></span>
                    <span class="agenda-year"><?= date('Y', strtotime($agenda->tanggal)) ?></span>
                </div>
                <div class="agenda-info">
                    <h3 class="agenda-title"><?= htmlspecialchars($agenda->judul) ?></h3>
                    <div class="agenda-meta">
                        <?php if ($agenda->waktu): ?>
                        <span><i class="fas fa-clock"></i> <?= date('H:i', strtotime($agenda->waktu)) ?> WIB</span>
                        <?php endif; ?>
                        <?php if ($agenda->lokasi): ?>
                        <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($agenda->lokasi) ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($agenda->deskripsi): ?>
                    <p class="agenda-desc"><?= substr(strip_tags($agenda->deskripsi), 0, 100) ?>...</p>
                    <?php endif; ?>
                </div>
                <div class="agenda-action">
                    <a href="<?= base_url('agenda/' . $agenda->id) ?>" class="btn-agenda-detail">
                        Detail <i class="fas fa-chevron-right"></i>
                    </a>
                    <span class="agenda-badge upcoming">Mendatang</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <p>Tidak ada agenda yang mendatang saat ini.</p>
        </div>
        <?php endif; ?>

        <div class="section-action">
            <a href="<?= base_url('agenda') ?>" class="btn-primary">
                Lihat Semua Agenda <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Pengumuman / CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="cta-icon"><i class="fas fa-bullhorn"></i></div>
            <div class="cta-content">
                <h2>Punya informasi untuk warga?</h2>
                <p>Hubungi pengurus RT 01 untuk menyampaikan pengumuman atau informasi penting kepada seluruh warga.</p>
            </div>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn-cta">
                <i class="fab fa-whatsapp"></i> Hubungi RT
            </a>
        </div>
    </div>
</section>

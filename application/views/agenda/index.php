<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg"></div>
    <div class="container">
        <div class="page-header-content">
            <div class="breadcrumb">
                <a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a>
                <span>/</span>
                <span>Agenda Kegiatan</span>
            </div>
            <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Agenda Kegiatan</h1>
            <p class="page-subtitle">Jadwal kegiatan dan acara RT 01 Desa Sejahtera</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">

        <!-- Agenda Mendatang -->
        <div class="agenda-section-header">
            <h2 class="agenda-section-title">
                <span class="agenda-status-dot upcoming"></span>
                Agenda Mendatang
            </h2>
        </div>

        <?php if ($agenda_upcoming && count($agenda_upcoming) > 0): ?>
        <div class="agenda-list">
            <?php foreach ($agenda_upcoming as $index => $agenda): ?>
            <div class="agenda-card animate-fadeInUp delay-<?= $index % 3 ?>">
                <div class="agenda-date-box upcoming">
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
                    <p class="agenda-desc"><?= substr(strip_tags($agenda->deskripsi), 0, 130) ?>...</p>
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
            <p>Tidak ada agenda mendatang saat ini.</p>
        </div>
        <?php endif; ?>

        <!-- Agenda Selesai -->
        <?php if ($agenda_done && count($agenda_done) > 0): ?>
        <div class="agenda-section-header" style="margin-top: 3rem;">
            <h2 class="agenda-section-title">
                <span class="agenda-status-dot done"></span>
                Agenda Selesai
            </h2>
        </div>
        <div class="agenda-list agenda-done-list">
            <?php foreach ($agenda_done as $index => $agenda): ?>
            <div class="agenda-card agenda-card-done animate-fadeInUp delay-<?= $index % 3 ?>">
                <div class="agenda-date-box done">
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
                </div>
                <div class="agenda-action">
                    <a href="<?= base_url('agenda/' . $agenda->id) ?>" class="btn-agenda-detail">
                        Detail <i class="fas fa-chevron-right"></i>
                    </a>
                    <span class="agenda-badge done">Selesai</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

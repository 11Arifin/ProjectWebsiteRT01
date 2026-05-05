<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website resmi RT 01 RW 05 Desa Sejahtera — Pusat informasi berita dan agenda kegiatan warga.">
    <title><?= isset($title) ? $title : 'RT 01 Desa Sejahtera' ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<!-- Navbar -->
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="<?= base_url() ?>" class="nav-logo">
            <div class="nav-logo-icon">🏘️</div>
            <div class="nav-logo-text">
                <span class="nav-logo-rt">RT 01 / RW 05</span>
                <span class="nav-logo-desa">Desa Sejahtera</span>
            </div>
        </a>

        <ul class="nav-menu" id="navMenu">
            <li class="nav-item">
                <a href="<?= base_url() ?>" class="nav-link <?= (isset($page) && $page == 'home') ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Beranda
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('berita') ?>" class="nav-link <?= (isset($page) && $page == 'berita') ? 'active' : '' ?>">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('agenda') ?>" class="nav-link <?= (isset($page) && $page == 'agenda') ? 'active' : '' ?>">
                    <i class="fas fa-calendar-alt"></i> Agenda
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('admin/login') ?>" class="nav-link nav-link-admin">
                    <i class="fas fa-lock"></i> Admin
                </a>
            </li>
        </ul>

        <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

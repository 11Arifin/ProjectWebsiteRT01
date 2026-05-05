<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — RT 01 Desa Sejahtera</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body class="login-page">

<div class="login-wrapper">
    <!-- Left Panel -->
    <div class="login-left">
        <div class="login-left-content">
            <div class="login-brand">
                <span class="login-brand-icon">🏘️</span>
                <div>
                    <div class="login-brand-rt">RT 01 / RW 05</div>
                    <div class="login-brand-desa">Desa Sejahtera</div>
                </div>
            </div>
            <h2 class="login-left-title">Panel Admin</h2>
            <p class="login-left-desc">
                Kelola berita dan agenda kegiatan warga RT 01 dengan mudah dan aman.
            </p>
            <div class="login-features">
                <div class="login-feature">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Berita</span>
                </div>
                <div class="login-feature">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Kelola Agenda</span>
                </div>
                <div class="login-feature">
                    <i class="fas fa-shield-alt"></i>
                    <span>Akses Aman</span>
                </div>
            </div>
        </div>
        <div class="login-left-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="login-right">
        <div class="login-form-wrap">
            <div class="login-header">
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Masuk ke panel admin RT 01</p>
            </div>

            <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <?= $error ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/login') ?>" method="post" class="login-form">

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fas fa-user"></i> Username
                    </label>
                    <div class="input-group">
                        <input type="text" id="username" name="username"
                               class="form-input" placeholder="Masukkan username"
                               value="<?= set_value('username') ?>" required autocomplete="username">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-group input-password">
                        <input type="password" id="password" name="password"
                               class="form-input" placeholder="Masukkan password"
                               required autocomplete="current-password">
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="pwEyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="login" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <div class="login-back">
                <a href="<?= base_url() ?>">
                    <i class="fas fa-arrow-left"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('pwEyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
</body>
</html>

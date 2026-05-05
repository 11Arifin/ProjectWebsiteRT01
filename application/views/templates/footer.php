<!-- Footer -->
<footer class="footer">
    <div class="footer-main">
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="footer-logo-icon">🏘️</span>
                    <div>
                        <div class="footer-logo-rt">RT 01 / RW 05</div>
                        <div class="footer-logo-desa">Desa Sejahtera</div>
                    </div>
                </div>
                <p class="footer-desc">
                    Website resmi RT 01 sebagai pusat informasi dan komunikasi warga. 
                    Bersama membangun lingkungan yang sehat, aman, dan sejahtera.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Menu -->
            <div class="footer-col">
                <h4 class="footer-title">Menu Utama</h4>
                <ul class="footer-links">
                    <li><a href="<?= base_url() ?>"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="<?= base_url('berita') ?>"><i class="fas fa-chevron-right"></i> Berita</a></li>
                    <li><a href="<?= base_url('agenda') ?>"><i class="fas fa-chevron-right"></i> Agenda Kegiatan</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="footer-col">
                <h4 class="footer-title">Kontak</h4>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Kerukunan No. 1, RT 01 RW 05<br>Desa Sejahtera, Kec. Makmur</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>+62 812-3456-7890 (Pak RT)</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>rt01.desasejahtera@gmail.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Pelayanan: Senin – Sabtu<br>08.00 – 16.00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <p>&copy; <?= date('Y') ?> RT 01 RW 05 Desa Sejahtera. Hak cipta dilindungi.</p>
            <p>Dibuat dengan <i class="fas fa-heart" style="color:#f4a261"></i> menggunakan CodeIgniter 3</p>
        </div>
    </div>
</footer>

<!-- Scroll to Top -->
<button class="scroll-top" id="scrollTop" title="Kembali ke atas">
    <i class="fas fa-chevron-up"></i>
</button>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>

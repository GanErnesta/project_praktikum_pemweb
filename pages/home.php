<?php
session_start();

// Data contoh untuk tampilan Home (belum menggunakan database).
$namaPengguna = $_SESSION['user_nama'] ?? 'Mahasiswa FINS';

$kompetisi = [
    [
        'title' => 'Business Plan Competition 2025',
        'short' => 'Business Plan',
        'description' => 'Bergabung dengan teman yang punya visi dan semangat untuk membangun solusi nyata bagi masyarakat.',
        'category' => 'Business Plan',
        'image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=900&q=80'
    ],
    [
        'title' => 'Multimedia in Action 2026',
        'short' => 'Multimedia in Action 2026',
        'description' => 'Berkolaborasi membuat karya multimedia kreatif bersama tim dengan minat yang sama.',
        'category' => 'Hackathon',
        'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80'
    ],
    [
        'title' => 'Robotics 2026',
        'short' => 'Robotics 2026',
        'description' => 'Temukan partner yang tertarik pada teknologi, inovasi, dan pengembangan robotika.',
        'category' => 'Robotics',
        'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=900&q=80'
    ],
    [
        'title' => 'UI/UX Design Challenge',
        'short' => 'UI/UX Design Challenge',
        'description' => 'Wujudkan ide produk digital dengan partner yang memahami desain dan kebutuhan pengguna.',
        'category' => 'UI/UX',
        'image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=900&q=80'
    ],
    [
        'title' => 'Data Science Challenge',
        'short' => 'Data Science Challenge',
        'description' => 'Bangun solusi berbasis data dan AI bersama mahasiswa dengan keahlian yang saling melengkapi.',
        'category' => 'Data Science',
        'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80'
    ],
    [
        'title' => 'Karya Tulis Ilmiah',
        'short' => 'Karya Tulis Ilmiah',
        'description' => 'Cari rekan untuk berdiskusi, melakukan riset, dan menyusun karya ilmiah bersama.',
        'category' => 'KTI',
        'image' => 'https://images.unsplash.com/photo-1455390582262-044c599f4a82?auto=format&fit=crop&w=900&q=80'
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | FINS</title>
    <link rel="stylesheet" href="../css/home.css">
    <script src="../js/home.js" defer></script>
</head>
<body>
<header class="fins-navbar">
    <a class="fins-brand" href="home.php" aria-label="FINS Beranda">
        <span class="fins-brand-mark">F<span>UB</span></span>
    </a>

    <nav class="fins-nav-links" aria-label="Navigasi utama">
        <a class="active" href="home.php">Beranda</a>
        <a href="cari_lomba.php">Lomba</a>
        <a href="cari_partner.php">Cari Partner</a>
        <a href="lomba_saya.php">Lomba Saya</a>
        <a href="#">Tim Saya</a>
    </nav>

    <div class="fins-nav-actions">
        <a class="fins-nav-icon" href="chat.php" aria-label="Chat">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 8.7 3.9a8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z"/><path d="M8 10h8M8 14h5"/></svg>
        </a>
        <a class="fins-nav-icon notification-icon" href="#" aria-label="Notifikasi">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/></svg><i></i>
        </a>
        <a class="fins-nav-avatar" href="profile.php" aria-label="Buka profil">
            <img src="../assets/images/Group4.png" alt="Foto profil">
        </a>
    </div>
</header>

<main>
    <section class="home-hero">
        <div class="hero-shade"></div>
        <div class="hero-content">
            <span class="hero-badge"><span class="people-icon">♟♟</span> Kolaborasi Dimulai di sini</span>
            <h1>Temukan Partner, Bangun<br class="desktop-break"> Tim, Raih Prestasi.</h1>
            <p>Cari rekan satu tim yang memiliki minat, skill, dan tujuan yang sama!</p>
        </div>
    </section>

    <form class="team-search" id="teamSearchForm">
        <label class="search-select">
            <span class="select-symbol">✿</span>
            <select id="competitionSelect" aria-label="Cari bidang lomba">
                <option value="">Cari Bidang Lomba</option>
                <option value="Business Plan">Business Plan</option>
                <option value="Hackathon">Hackathon</option>
                <option value="Robotics">Robotics</option>
                <option value="UI/UX">UI/UX Design</option>
                <option value="Data Science">Data Science / AI</option>
                <option value="KTI">Karya Tulis Ilmiah</option>
            </select>
        </label>
        <label class="search-select">
            <span class="select-symbol">♟</span>
            <select id="skillSelect" aria-label="Skill yang dibutuhkan">
                <option value="">Skill yang dibutuhkan</option>
                <option value="UI/UX">UI/UX Design</option>
                <option value="Web Development">Web Development</option>
                <option value="Programming">Programming</option>
                <option value="Data Science">Data Science / AI</option>
                <option value="Public Speaking">Public Speaking</option>
            </select>
        </label>
        <label class="search-select">
            <span class="select-symbol">⌖</span>
            <select id="locationSelect" aria-label="Lokasi">
                <option value="">Lokasi / online</option>
                <option value="Malang">Malang</option>
                <option value="Online">Online</option>
                <option value="Hybrid">Hybrid</option>
            </select>
        </label>
        <button type="submit" class="find-team-button"><span>⌕</span> Temukan Tim</button>
    </form>

    <section class="home-intro">
        <div class="intro-image">
            <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=1100&q=85" alt="Mahasiswa berdiskusi dan bekerja sama">
        </div>
        <div class="intro-copy">
            <h2>Capai Tujuan Bersama dengan Rekan dan Tim yang Tepat</h2>
            <p>FINS memberikan kesempatan untuk kamu bisa menemukan partner sesuai dengan bidang, skill serta tujuan yang kamu dan timmu butuhkan.</p>
            <a class="primary-link" href="cari_partner.php">Pelajari cara kerja <span>→</span></a>
        </div>
    </section>

    <section class="competition-section" id="kompetisi">
        <h2>Gabung Sebagai Partner Lomba</h2>
        <div class="competition-track" id="competitionTrack">
            <?php foreach ($kompetisi as $item): ?>
                <article class="competition-card"
                    data-category="<?= htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8') ?>"
                    data-search="<?= htmlspecialchars(strtolower($item['title'] . ' ' . $item['description'] . ' ' . $item['category']), ENT_QUOTES, 'UTF-8') ?>">
                    <img src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>"
                         alt="<?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?>"
                         loading="lazy">
                    <h3><?= htmlspecialchars($item['short'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($item['description'], ENT_QUOTES, 'UTF-8') ?></p>
                    <a href="cari_partner.php" class="competition-link">Lihat Partner <span>→</span></a>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="carousel-controls">
            <button type="button" id="previousCards" aria-label="Kompetisi sebelumnya">‹</button>
            <div class="carousel-dots" id="carouselDots" aria-label="Pilih halaman kompetisi"></div>
            <button type="button" id="nextCards" aria-label="Kompetisi berikutnya">›</button>
        </div>
        <p class="search-feedback" id="searchFeedback" aria-live="polite"></p>
    </section>
</main>

<footer class="home-footer">
    <div class="footer-main">
        <div class="footer-about">
            <div class="footer-logo">F<span>UB</span></div>
            <p>Find Your Skills Partner — Ekosistem kolaborasi mahasiswa Universitas Brawijaya untuk menemukan tim lomba lintas fakultas dan berprestasi di kancah nasional maupun internasional.</p>
            <small>Kampus Utama Universitas Brawijaya,<br>Malang, Jawa Timur</small>
        </div>
        <div class="footer-column">
            <h3>Eksplorasi Platform</h3>
            <a href="cari_lomba.php">Daftar Kompetisi Mahasiswa</a>
            <a href="cari_partner.php">Cari Rekan &amp; Partner Tim</a>
            <a href="posting_lomba.php">Publikasi Kebutuhan Tim</a>
            <a href="home.php">Dashboard Lomba Saya</a>
            <a href="#">Manajemen Tim Saya</a>
            <a href="#">Pusat Notifikasi &amp; Aktivitas</a>
        </div>
        <div class="footer-column">
            <h3>Kategori Kompetisi</h3>
            <a href="#kompetisi">GEMASTIK &amp; Satria Data</a>
            <a href="#kompetisi">Program Kreativitas Mahasiswa (PKM)</a>
            <a href="#kompetisi">Business Plan &amp; Case Competition</a>
            <a href="#kompetisi">Lomba Karya Tulis Ilmiah (LKTI)</a>
            <a href="#kompetisi">UI/UX Design &amp; Software Development</a>
        </div>
        <div class="footer-column faculty-column">
            <h3>Rumpun Fakultas UB</h3>
            <p>Menghubungkan mahasiswa FILKOM, FEB, FT, FIA, FK, FPIK, FISIP, FMIPA, dan fakultas lainnya dalam satu sinergi juara.</p>
            <div class="footer-tip"><strong>Tips Juara:</strong> Tim multidisiplin (Teknologi + Bisnis + Desain) memiliki tingkat lolos 3,2× lebih tinggi di ajang bergengsi.</div>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© 2026 FINS — Find Your Skills Partner. Universitas Brawijaya.</span>
        <div><a href="#">Pedoman Etika Kolaborasi</a><a href="#">Panduan Verifikasi UB SSO</a><a href="#">Pusat Bantuan</a></div>
    </div>
</footer>
</body>
</html>

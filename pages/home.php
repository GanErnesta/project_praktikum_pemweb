<?php
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$halamanAktif = 'beranda';

$menu = [
    'beranda'     => ['Beranda',     'home.php'],
    'lomba'       => ['Lomba',       'lomba.php'],
    'cari'        => ['Cari Partner','cari-partner.php'],
    'lomba-saya'  => ['Lomba Saya',  'lomba-saya.php'],
    'tim-saya'    => ['Tim Saya',    'tim-saya.php'],
];

$bidangLomba = ['Business Plan', 'Hackathon', 'Robotika', 'UI/UX Design', 'Karya Tulis Ilmiah', 'PKM'];
$skillList   = ['Programming', 'UI/UX Design', 'Riset & Analisis', 'Penulisan', 'Presentasi', 'Manajemen Proyek'];
$lokasiList  = ['Online', 'Malang', 'Surabaya', 'Jakarta', 'Bandung', 'Yogyakarta'];

$partnerLomba = [
    [
        'judul' => 'Bussines Plan',
        'gambar' => 'assets/img/business-plan.jpg',
        'url' => 'partner.php?lomba=business-plan',
    ],
    [
        'judul' => 'Multimedia in Action 2026',
        'gambar' => 'assets/img/multimedia.jpg',
        'url' => 'partner.php?lomba=multimedia-in-action-2026',
    ],
    [
        'judul' => 'Robotics 2026',
        'gambar' => 'assets/img/robotics.jpg',
        'url' => 'partner.php?lomba=robotics-2026',
    ],
];
$deskripsiKartu = 'Bergabung dengan teman yang punya visi dan semangat untuk membangun solusi nyata bagi masyarakat.';

$kolomFooter = [
    'Eksplorasi Platform' => [
        ['Daftar Kompetisi Mahasiswa', 'lomba.php'],
        ['Cari Rekan & Partner Tim', 'cari-partner.php'],
        ['Publikasi Kebutuhan Tim', 'publikasi.php'],
        ['Dashboard Lomba Saya', 'lomba-saya.php'],
        ['Manajemen Tim Saya', 'tim-saya.php'],
        ['Pusat Notifikasi & Aktivitas', 'notifikasi.php'],
    ],
    'Kategori Kompetisi' => [
        ['Puspresnas Gemastik & Satria Data', 'lomba.php?kategori=puspresnas'],
        ['Program Kreativitas Mahasiswa (PKM)', 'lomba.php?kategori=pkm'],
        ['Business Plan & Case Competition', 'lomba.php?kategori=bisnis'],
        ['Lomba Karya Tulis Ilmiah (LKTI)', 'lomba.php?kategori=lkti'],
        ['UI/UX Design & Software Development', 'lomba.php?kategori=teknologi'],
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FINS - Find Your Skills Partner | Universitas Brawijaya</title>
    <meta name="description" content="Temukan partner, bangun tim, dan raih prestasi bersama mahasiswa Universitas Brawijaya.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>

<!-- ============ NAVBAR ============ -->
<header class="navbar">
    <a href="index.php" class="logo" aria-label="FINS UB">
        <span class="logo__mark">F<small>UB</small></span>
    </a>

    <button class="navbar__toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="navMenu">
        <span></span><span></span><span></span>
    </button>

    <nav class="navbar__menu" id="navMenu" aria-label="Navigasi utama">
        <?php foreach ($menu as $key => [$label, $href]): ?>
            <a href="<?= e($href) ?>" class="<?= $key === $halamanAktif ? 'is-active' : '' ?>"
               <?= $key === $halamanAktif ? 'aria-current="page"' : '' ?>><?= e($label) ?></a>
        <?php endforeach; ?>
    </nav>

    <div class="navbar__actions">
        <a href="pesan.php" class="icon-btn" aria-label="Pesan">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a8.5 8.5 0 0 1-12.4 7.5L3 21l1.6-5.2A8.5 8.5 0 1 1 21 12z"/><path d="M8.5 11.5h.01M12 11.5h.01M15.5 11.5h.01" stroke-width="2.4"/></svg>
        </a>
        <a href="notifikasi.php" class="icon-btn" aria-label="Notifikasi">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 8 3 8H3s3-1 3-8z"/><path d="M10.3 20a1.9 1.9 0 0 0 3.4 0"/></svg>
            <span class="icon-btn__dot"></span>
        </a>
        <a href="profil.php" class="avatar" aria-label="Profil saya">
            <img src="assets/img/avatar.png" alt="" onerror="this.style.display='none'">
        </a>
    </div>
</header>

<main>
    <!-- ============ HERO ============ -->
    <section class="hero">
        <div class="hero__inner">
            <span class="badge">
                <svg viewBox="0 0 24 24" width="30" height="30" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="3.2"/><circle cx="4.5" cy="10" r="2.2"/><circle cx="19.5" cy="10" r="2.2"/><path d="M12 13c-3.3 0-6 1.7-6 4v2h12v-2c0-2.3-2.7-4-6-4zM3 14c-1.2.4-2 1.3-2 2.500V19h3.500v-2c0-1.2.4-2.2 1.2-3H3zm18 0h-1.700c.8.8 1.2 1.8 1.2 3v2H24v-2.500c0-1.2-.8-2.1-2-2.500z"/></svg>
                Kolaborasi Dimulai di sini
            </span>

            <div class="hero__copy">
                <h1>Temukan Partner, Bangun Tim, Raih Prestasi.</h1>
                <p>Cari rekan satu tim yang memiliki minat, skill, dan tujuan yang sama!</p>
            </div>
        </div>

        <!-- Form pencarian -->
        <form class="search" action="cari-partner.php" method="get" role="search">
            <div class="search__fields">
                <label class="field">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" aria-hidden="true"><path d="M12 3 1 9l11 6 9-4.9V17h2V9L12 3zM5 13.2v3.6c0 1.7 3.1 3.2 7 3.200s7-1.5 7-3.200v-3.600l-7 3.8-7-3.800z"/></svg>
                    <select name="bidang" aria-label="Bidang lomba">
                        <option value="">Cari Bidang Lomba</option>
                        <?php foreach ($bidangLomba as $b): ?>
                            <option value="<?= e($b) ?>"><?= e($b) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="field">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" aria-hidden="true"><circle cx="9" cy="8" r="3.2"/><circle cx="17" cy="9" r="2.6"/><path d="M9 13c-3.5 0-7 1.8-7 4.300V20h14v-2.700C16 14.8 12.5 13 9 13zm8 .5c-.6 0-1.2.1-1.8.2 1.2 1 1.8 2.3 1.8 3.600V20h5v-2.400c0-2-2.5-4.1-5-4.100z"/></svg>
                    <select name="skill" aria-label="Skill yang dibutuhkan">
                        <option value="">Skill yang dibutuhkan</option>
                        <?php foreach ($skillList as $s): ?>
                            <option value="<?= e($s) ?>"><?= e($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="field">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.500A2.5 2.5 0 1 1 12 6.500a2.5 2.5 0 0 1 0 5z"/></svg>
                    <select name="lokasi" aria-label="Lokasi atau online">
                        <option value="">Lokasi / online</option>
                        <?php foreach ($lokasiList as $l): ?>
                            <option value="<?= e($l) ?>"><?= e($l) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <button type="submit" class="search__btn">
                <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7.5"/><path d="m20.5 20.5-4.8-4.8"/></svg>
                Temukan Tim
            </button>
        </form>
    </section>

    <!-- ============ TENTANG ============ -->
    <section class="about">
        <figure class="about__photo">
            <img src="assets/img/team-hands.jpg" alt="Sekelompok mahasiswa menumpukkan tangan sebagai tanda kerja sama tim">
        </figure>
        <div class="about__text">
            <h2>Capai Tujuan Bersama dengan Rekan dan Tim yang Tepat</h2>
            <p>Fins memberikan kesempatan untuk kamu bisa menemukan partner sesuai dengan bidang, skill serta tujuan yang kamu dan tim mu butuhkan.</p>
            <a href="cara-kerja.php" class="btn">
                Pelajari cara kerja
                <?php include __DIR__ . '/partials/arrow.php'; ?>
            </a>
        </div>
    </section>

    <!-- ============ PARTNER LOMBA ============ -->
    <section class="partners" aria-labelledby="partnersTitle">
        <h2 id="partnersTitle" class="partners__title">Gabung Sebagai Partner Lomba</h2>

        <div class="partners__band">
            <div class="carousel" id="carousel" tabindex="0" aria-label="Daftar lomba">
                <?php foreach ($partnerLomba as $i => $item): ?>
                    <article class="card">
                        <img class="card__img" src="<?= e($item['gambar']) ?>" alt="Poster <?= e($item['judul']) ?>" loading="lazy">
                        <h3><?= e($item['judul']) ?></h3>
                        <p><?= e($deskripsiKartu) ?></p>
                        <a href="<?= e($item['url']) ?>" class="btn btn--block">
                            Lihat Partner
                            <?php include __DIR__ . '/partials/arrow.php'; ?>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="dots" id="dots" role="tablist" aria-label="Halaman carousel"></div>
        </div>
    </section>
</main>

<!-- ============ FOOTER ============ -->
<footer class="footer">
    <div class="footer__grid">
        <div class="footer__brand">
            <span class="logo__mark logo__mark--light">F<small>UB</small></span>
            <p>Find Your Skills Partner — Ekosistem kolaborasi mahasiswa Universitas Brawijaya untuk menemukan tim lomba lintas fakultas dan berprestasi di kancah nasional maupun internasional.</p>
            <small>Kampus Utama Universitas Brawijaya, Malang, Jawa Timur</small>
        </div>

        <?php foreach ($kolomFooter as $judul => $links): ?>
            <div class="footer__col">
                <h4><?= e($judul) ?></h4>
                <ul>
                    <?php foreach ($links as [$label, $href]): ?>
                        <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>

        <div class="footer__col">
            <h4>Rumpun Fakultas UB</h4>
            <p>Menghubungkan mahasiswa FILKOM, FEB, FT, FIA, FK, FTP, FISIP, FMIPA, dan fakultas lainnya dalam satu sinergi juara.</p>
            <div class="tip">
                <strong>Tips Juara:</strong> Tim multidisiplin (Teknologi + Bisnis + Riset) memiliki tingkat lolos 3.2x lebih tinggi di ajang bergengsi.
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <span>© <?= date('Y') ?> FINS — Find Your Skills Partner. Universitas Brawijaya.</span>
        <nav aria-label="Tautan bantuan">
            <a href="etika.php">Pedoman Etika Kolaborasi</a>
            <a href="verifikasi.php">Panduan Verifikasi UB SSO</a>
            <a href="bantuan.php">Pusat Bantuan</a>
        </nav>
    </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
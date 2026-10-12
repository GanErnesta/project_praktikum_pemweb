<?php
require __DIR__ . '/includes/data.php';
$active = 'beranda';
require __DIR__ . '/includes/header.php';
?>

<!-- ================= HERO ================= -->
<section class="hero" style="--hero-img:url('assets/img/hero.jpg')">
    <div class="hero__overlay"></div>
    <div class="container hero__content">
        <span class="badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/></svg>
            Kolaborasi Dimulai di Sini
        </span>

        <h1 class="hero__title">Temukan Partner, Bangun<br>Tim, Raih Prestasi.</h1>
        <p class="hero__sub">Cari rekan satu tim yang memiliki minat, skill, dan tujuan yang sama!</p>
    </div>

    <!-- Search bar -->
    <form class="search container" id="searchForm" action="cari-partner.php" method="get">
        <div class="search__bar">
            <?php
            $fields = [
                ['name' => 'bidang', 'label' => 'Cari Bidang Lomba',     'opts' => $bidangLomba, 'icon' => 'trophy'],
                ['name' => 'skill',  'label' => 'Skill yang dibutuhkan',  'opts' => $skillList,   'icon' => 'bulb'],
                ['name' => 'lokasi', 'label' => 'Lokasi / online',        'opts' => $lokasiList,  'icon' => 'pin'],
            ];
            $icons = [
                'trophy' => '<path d="M8 21h8M12 17v4M7 4h10v5a5 5 0 0 1-10 0V4z"/><path d="M17 5h3v2a3 3 0 0 1-3 3M7 5H4v2a3 3 0 0 0 3 3"/>',
                'bulb'   => '<path d="M9 18h6M10 22h4M12 2a7 7 0 0 0-4 12.7c.6.5 1 1.3 1 2.3h6c0-1 .4-1.8 1-2.3A7 7 0 0 0 12 2z"/>',
                'pin'    => '<path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
            ];
            foreach ($fields as $f): ?>
                <div class="select" data-select>
                    <input type="hidden" name="<?= $f['name'] ?>" value="">
                    <button type="button" class="select__btn" aria-haspopup="listbox" aria-expanded="false">
                        <svg class="select__icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?= $icons[$f['icon']] ?></svg>
                        <span class="select__label" data-default="<?= $f['label'] ?>"><?= $f['label'] ?></span>
                        <svg class="select__chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <ul class="select__menu" role="listbox">
                        <?php foreach ($f['opts'] as $o): ?>
                            <li role="option" data-value="<?= htmlspecialchars($o) ?>"><?= htmlspecialchars($o) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="search__submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Temukan Tim
            </button>
        </div>
    </form>
</section>

<!-- ================= TUJUAN ================= -->
<section class="about">
    <div class="container about__inner">
        <div class="about__media">
            <img src="assets/img/teamwork.jpg" alt="Kerja sama tim" onerror="this.style.display='none'">
        </div>
        <div class="about__text">
            <h2>Capai Tujuan Bersama dengan<br>Rekan dan Tim yang Tepat</h2>
            <p>
                Kami membantu kamu menemukan partner sesuai dengan bidang, skill
                serta tujuan yang kamu dan timmu butuhkan.
            </p>
            <a href="#cara-kerja" class="btn btn--primary">
                Pelajari cara kerja
                <svg width="18" height="12" viewBox="0 0 24 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="1" y1="8" x2="21" y2="8"/><polyline points="15 2 21 8 15 14"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ================= PARTNER LOMBA ================= -->
<section class="partner" id="cara-kerja">
    <div class="container">
        <h2 class="partner__title">Gabung Sebagai Partner Lomba</h2>

        <div class="carousel" id="carousel">
            <div class="carousel__track" id="track">
                <?php foreach ($lombaCards as $c): ?>
                    <article class="card">
                        <div class="card__img card__img--<?= $c['tema'] ?>">
                            <img src="<?= $c['img'] ?>" alt="<?= htmlspecialchars($c['judul']) ?>" onerror="this.style.display='none'">
                            <span class="card__img-text"><?= htmlspecialchars($c['judul']) ?></span>
                        </div>
                        <h3 class="card__title"><?= htmlspecialchars($c['judul']) ?></h3>
                        <p class="card__desc"><?= htmlspecialchars($c['desc']) ?></p>
                        <a href="<?= $c['href'] ?>" class="btn btn--primary btn--sm">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                            Lihat Partner
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="dots" id="dots" role="tablist" aria-label="Slide lomba">
            <?php foreach ($lombaCards as $i => $c): ?>
                <button class="dots__item<?= $i === 0 ? ' is-active' : '' ?>" data-index="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

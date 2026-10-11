
<?php
$halamanAktif = basename($_GET['page'] ?? 'beranda');

$menu = [
    'beranda'      => 'Beranda',
    'lomba'        => 'Lomba',
    'cari-partner' => 'Cari Partner',
    'lomba-saya'   => 'Lomba Saya',
    'tim-saya'     => 'Tim Saya',
];

$hero = [
    'badge'      => 'Kolaborasi Dimulai di sini',
    'judul'      => 'Temukan Partner, Bangun Tim, Raih Prestasi.',
    'deskripsi'  => 'Cari rekan satu tim yang memiliki minat, skill, dan tujuan yang sama!',
    'gambar'     => 'home.png',
];

$user = [
    'avatar'     => 'profilHome.png',
    'notifikasi' => true,
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FINS - Beranda</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
    <a href="index.php?page=beranda" class="logo" aria-label="FINS">
        F<small>INS</small>
    </a>

    <nav aria-label="Menu utama">
        <ul class="nav-menu">
            <?php foreach ($menu as $slug => $label): ?>
                <li>
                    <a
                        href="index.php?page=<?= htmlspecialchars($slug) ?>"
                        class="<?= $halamanAktif === $slug ? 'active' : '' ?>"
                    >
                        <?= htmlspecialchars($label) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="nav-actions">
        <a class="icon-btn" href="index.php?page=chat" aria-label="Pesan">
            <svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.4 8.4 0 0 1-12.3 7.4L3 20.5l1.7-5.2A8.5 8.5 0 1 1 21 11.5z"/>
                <path d="M8.5 10h7M8.5 13.5h4"/>
            </svg>
        </a>

        <button class="icon-btn" type="button"
            aria-label="Notifikasi" id="notificationButton">
            <svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.8"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.7 21a2 2 0 0 1-3.4 0"/>
            </svg>

            <?php if ($user['notifikasi']): ?>
                <span class="dot"></span>
            <?php endif; ?>
        </button>

        <a href="index.php?page=profil" aria-label="Profil">
            <img
                class="avatar"
                src="<?= htmlspecialchars($user['avatar']) ?>"
                alt="Foto profil"
            >
        </a>
    </div>
</header>

<main class="hero"
    style="--hero-image: url('<?= htmlspecialchars($hero['gambar']) ?>')">

    <div class="hero-content">
        <span class="badge">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="7" r="3"/>
                <circle cx="4.5" cy="9" r="2.2"/>
                <circle cx="19.5" cy="9" r="2.2"/>
                <path d="M12 12c-3.3 0-6 1.8-6 4v2h12v-2c0-2.2-2.7-4-6-4zM4.5 12.5C2.6 12.5 1 13.6 1 15v2.5h3.5V16c0-1.3.6-2.5 1.6-3.4-.5-.1-1-.1-1.6-.1zm15 0c-.6 0-1.1 0-1.6.1 1 .9 1.6 2.1 1.6 3.4v1.5H23V15c0-1.4-1.6-2.5-3.5-2.5z"/>
            </svg>
            <?= htmlspecialchars($hero['badge']) ?>
        </span>

        <div class="hero-box">
            <h1><?= htmlspecialchars($hero['judul']) ?></h1>
            <p><?= htmlspecialchars($hero['deskripsi']) ?></p>
        </div>
    </div>
</main>

<script src="js/home.js"></script>
</body>
</html>
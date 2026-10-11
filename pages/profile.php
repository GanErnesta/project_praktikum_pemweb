<?php
session_start();

/*
 * Penyimpanan foto lokal untuk prototipe FINS.
 * Foto disimpan di /uploads/profile_photos dan nama file dicatat di profile-photo.json.
 * Untuk aplikasi multi-user, simpan path foto per user di database.
 */
$photoDirectory = dirname(__DIR__) . '/uploads/profile_photos';
$photoMetadata = $photoDirectory . '/profile-photo.json';
$photoWebPath = '';

if (!is_dir($photoDirectory)) {
    mkdir($photoDirectory, 0775, true);
}

$photoData = [];
if (is_file($photoMetadata)) {
    $decodedPhotoData = json_decode((string) file_get_contents($photoMetadata), true);
    if (is_array($decodedPhotoData)) {
        $photoData = $decodedPhotoData;
    }
}

if (!empty($photoData['filename'])) {
    $candidate = basename($photoData['filename']);
    if (is_file($photoDirectory . '/' . $candidate)) {
        $photoWebPath = '../uploads/profile_photos/' . rawurlencode($candidate);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profile_photo_action'])) {
    header('Content-Type: application/json; charset=utf-8');

    $action = $_POST['profile_photo_action'];

    if ($action === 'upload') {
        if (!isset($_FILES['profile_photo']) || $_FILES['profile_photo']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Foto gagal diunggah. Coba pilih foto lagi.']);
            exit;
        }

        $file = $_FILES['profile_photo'];
        if ($file['size'] > 5 * 1024 * 1024) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Ukuran foto maksimal 5 MB.']);
            exit;
        }

        $imageInfo = @getimagesize($file['tmp_name']);
        $allowedMimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];
        $mimeType = $imageInfo['mime'] ?? '';

        if (!$imageInfo || !isset($allowedMimeTypes[$mimeType])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Format foto harus JPG, PNG, atau WEBP.']);
            exit;
        }

        $extension = $allowedMimeTypes[$mimeType];
        $newFilename = 'profile_' . bin2hex(random_bytes(12)) . '.' . $extension;
        $destination = $photoDirectory . '/' . $newFilename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Foto tidak bisa disimpan. Periksa izin folder uploads.']);
            exit;
        }

        // Hapus foto lama setelah foto baru berhasil tersimpan.
        if (!empty($photoData['filename'])) {
            $oldFilename = basename($photoData['filename']);
            $oldPath = $photoDirectory . '/' . $oldFilename;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        $photoData = ['filename' => $newFilename];
        file_put_contents($photoMetadata, json_encode($photoData, JSON_PRETTY_PRINT), LOCK_EX);
        $photoWebPath = '../uploads/profile_photos/' . rawurlencode($newFilename);

        echo json_encode(['success' => true, 'photoUrl' => $photoWebPath, 'message' => 'Foto profil berhasil disimpan.']);
        exit;
    }

    if ($action === 'remove') {
        if (!empty($photoData['filename'])) {
            $oldFilename = basename($photoData['filename']);
            $oldPath = $photoDirectory . '/' . $oldFilename;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        @unlink($photoMetadata);
        echo json_encode(['success' => true, 'photoUrl' => null, 'message' => 'Foto profil berhasil dihapus.']);
        exit;
    }

    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Aksi foto tidak dikenali.']);
    exit;
}

$profile = [

    'fullname' => 'Sauka Gana Dzikri',

    'username' => '@sauka',

    'faculty' => 'Ilmu Komputer',

    'study_program' => 'Pendidikan Teknologi Informasi',

    'bio' => 'Make this life for have fun...',

    'skills' => [

        'UI/UX',

        'Web Development',

        'Prompt Engineer',

        'Jurnal Research'

    ],

    'instagram' => '@gan_wthu',

    'github' => '@gan_wthu',

    'linkedin' => '@gan_wthu',

];

$activities = [

    ['title' => 'GEMASTIK XVII 2025', 'category' => 'UI/UX Design', 'role' => 'Lead UI Designer', 'team' => 'Tim Alpha UB', 'status' => 'Selesai', 'class' => 'done', 'icon' => '▣'],

    ['title' => 'IT Fest 2026', 'category' => 'UI/UX Design', 'role' => 'Lead UI Designer', 'team' => 'Tim Alpha UB', 'status' => 'Finalis', 'class' => 'final', 'icon' => '⌘'],

    ['title' => 'Hology 9.0 2026', 'category' => 'UI/UX Design', 'role' => 'Lead UI Designer', 'team' => 'Tim Alpha UB', 'status' => 'Finalis', 'class' => 'final', 'icon' => '▤'],

    ['title' => 'Binus Hackathon 2026', 'category' => 'UI/UX Design', 'role' => 'Lead UI Designer', 'team' => 'Tim Alpha UB', 'status' => 'Sedang Berjalan', 'class' => 'ongoing', 'icon' => '♧'],

];

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile Mahasiswa | FINS</title>

    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/profile-photo.css">

    <link rel="stylesheet" href="../css/profile-navbar.css">

    <script src="../js/profile.js" defer></script>
    <script src="../js/profile-photo.js" defer></script>

</head>

<body>

    <div class="fins-profile-page">

        <header class="fins-navbar">

            <a class="fins-brand" href="home.php" aria-label="FINS Beranda">

                <span class="fins-brand-mark">F<span>UB</span></span>

            </a>

            <nav class="fins-nav-links" aria-label="Navigasi utama">

                <a href="home.php">Beranda</a>

                <a href="cari_lomba.php">Lomba</a>

                <a href="cari_partner.php">Cari Partner</a>

                <a href="lomba_saya.php">Lomba Saya</a>

                <a href="#">Tim Saya</a>

            </nav>

            <div class="fins-nav-actions">

                <a class="fins-nav-icon" href="chat.php" aria-label="Chat">

                    <svg viewBox="0 0 24 24" aria-hidden="true">

                        <path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7a8.4 8.4 0 0 1-.9-3.8A8.5 8.5 0 0 1 8.7 3.9a8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8v.5Z" />

                        <path d="M8 10h8M8 14h5" />

                    </svg>

                </a>

                <a class="fins-nav-icon notification-icon" href="#" aria-label="Notifikasi">

                    <svg viewBox="0 0 24 24" aria-hidden="true">

                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4" />

                    </svg>

                    <i></i>

                </a>

                <a class="fins-nav-avatar" href="profile.php" aria-label="Buka profil">

                    <?php if ($photoWebPath !== ''): ?>
                        <img src="<?= htmlspecialchars($photoWebPath, ENT_QUOTES, 'UTF-8') ?>" alt="Foto profil">
                    <?php else: ?>
                        <img src="../assets/images/Group4.png" alt="Foto profil">
                    <?php endif; ?>

                </a>

            </div>

        </header>

        <main class="fins-profile-main">

            <div class="fins-breadcrumb">PROFIL MAHASISWA <span>›</span></div>

            <div class="fins-profile-grid">

                <section class="fins-profile-left">

                    <article class="fins-card fins-user-card">

                        <div class="fins-avatar fins-avatar-large" id="profileAvatar">
                            <?php if ($photoWebPath !== ''): ?>
                                <img
                                    class="profile-photo-image"
                                    src="<?= htmlspecialchars($photoWebPath, ENT_QUOTES, 'UTF-8') ?>"
                                    alt="Foto profil">
                            <?php else: ?>
                                <span>SG</span>
                            <?php endif; ?>
                        </div>

                        <h1 id="profileName"><?= htmlspecialchars($profile['fullname']) ?></h1>

                        <p class="fins-study-program" id="profileStudyProgram"><?= htmlspecialchars($profile['study_program']) ?></p>

                        <p class="fins-bio-quote" id="profileBio">“<?= htmlspecialchars($profile['bio']) ?>”</p>

                        <button class="fins-button fins-button-primary fins-edit-profile" id="openEditProfile" type="button">

                            Edit Profil <span aria-hidden="true">✎</span>

                        </button>

                    </article>

                    <article class="fins-card fins-skills-card">

                        <div class="fins-section-heading">

                            <h2>Skills</h2>

                            <span id="skillsCount"><?= count($profile['skills']) ?> Terpasang</span>

                        </div>

                        <div class="fins-skill-list" id="profileSkills">

                            <?php foreach ($profile['skills'] as $skill): ?>

                                <span class="fins-skill-chip">• <?= htmlspecialchars($skill) ?></span>

                            <?php endforeach; ?>

                        </div>

                    </article>

                    <article class="fins-card fins-contact-card">

                        <h2>Contact</h2>

                        <div class="fins-contact-row">

                            <span class="fins-contact-logo instagram-logo">◎</span>

                            <div><small>Instagram</small><a href="#" id="profileInstagram"><?= htmlspecialchars($profile['instagram']) ?></a></div>

                        </div>

                        <div class="fins-contact-row">

                            <span class="fins-contact-logo github-logo">●</span>

                            <div><small>GitHub</small><a href="#" id="profileGithub"><?= htmlspecialchars($profile['github']) ?></a></div>

                        </div>

                        <div class="fins-contact-row">

                            <span class="fins-contact-logo linkedin-logo">in</span>

                            <div><small>LinkedIn</small><a href="#" id="profileLinkedin"><?= htmlspecialchars($profile['linkedin']) ?></a></div>

                        </div>

                    </article>

                </section>

                <section class="fins-profile-right">

                    <article class="fins-card fins-stats-card">

                        <div class="fins-stat">

                            <strong>8</strong><span>Lomba Diikuti</span><small>Tingkat Nasional &amp; Regional</small>

                        </div>

                        <div class="fins-stat">

                            <strong id="statSkills"><?= count($profile['skills']) ?></strong><span>Keahlian</span><small>Desain grafis, kode, analisis</small>

                        </div>

                        <div class="fins-stat">

                            <strong>3</strong><span>Kolaborasi Tim</span><small>Tim fakultas UB</small>

                        </div>

                    </article>

                    <article class="fins-card fins-interest-card">

                        <h2>Minat Kompetisi <span aria-hidden="true">▥</span></h2>

                        <div class="fins-interest-list">

                            <div class="fins-interest-item"><span class="fins-interest-icon">&lt;/&gt;</span><b>Hackathon</b><small>Rapid Build</small></div>

                            <div class="fins-interest-item"><span class="fins-interest-icon">＄</span><b>Business Plan</b><small>Product Idea</small></div>

                            <div class="fins-interest-item"><span class="fins-interest-icon">▤</span><b>Essay Competition</b><small>Science Problem</small></div>

                            <div class="fins-interest-item"><span class="fins-interest-icon">☷</span><b>UI/UX</b><small>Design System</small></div>

                        </div>

                    </article>

                    <article class="fins-card fins-activity-card">

                        <h2>Riwayat Aktivitas <span aria-hidden="true">◴</span></h2>

                        <div class="fins-activity-list">

                            <?php foreach ($activities as $activity): ?>

                                <div class="fins-activity-row">

                                    <span class="fins-activity-icon"><?= htmlspecialchars($activity['icon']) ?></span>

                                    <div class="fins-activity-details">

                                        <div class="fins-activity-title"><?= htmlspecialchars($activity['title']) ?> <span>•</span> <small><?= htmlspecialchars($activity['category']) ?></small></div>

                                        <p>Peran: <?= htmlspecialchars($activity['role']) ?> • <?= htmlspecialchars($activity['team']) ?></p>

                                    </div>

                                    <span class="fins-status <?= htmlspecialchars($activity['class']) ?>"><?= htmlspecialchars($activity['status']) ?></span>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </article>

                </section>

            </div>

        </main>

    </div>

    <!-- Modal Edit Profil -->

    <div class="fins-modal-backdrop" id="editProfileModal" aria-hidden="true">

        <section class="fins-edit-modal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">

            <div class="fins-modal-banner">

                <h2 id="editModalTitle">Edit Profil Mahasiswa</h2>

                <p>Perbarui informasi profil kamu Finsbe!</p>

            </div>

            <form id="editProfileForm">

                <div class="fins-modal-content">

                    <div class="fins-photo-section">

                        <div class="fins-avatar fins-avatar-modal" id="modalAvatar">
                            <?php if ($photoWebPath !== ''): ?>
                                <img class="profile-photo-image" src="<?= htmlspecialchars($photoWebPath, ENT_QUOTES, 'UTF-8') ?>" alt="Foto profil">
                            <?php else: ?>
                                SG
                            <?php endif; ?>
                        </div>

                        <div class="fins-photo-actions">

                            <label class="fins-button fins-button-primary fins-upload-button" for="profilePhotoInput">♧ &nbsp; Unggah Foto Baru</label>

                            <input type="file" id="profilePhotoInput" accept="image/\*" hidden>

                            <button class="fins-remove-photo" id="removePhotoButton" type="button">▤ &nbsp; Hapus Foto</button>

                        </div>

                    </div>

                    <div class="fins-form-grid">

                        <label class="fins-field">

                            <span>Fullname</span>

                            <input type="text" name="fullname" id="editFullname" value="<?= htmlspecialchars($profile['fullname']) ?>" required maxlength="100">

                        </label>

                        <label class="fins-field">

                            <span>Username</span>

                            <input type="text" name="username" id="editUsername" value="<?= htmlspecialchars($profile['username']) ?>" required maxlength="30">

                        </label>

                        <label class="fins-field">

                            <span>Fakultas</span>

                            <select name="faculty" id="editFaculty" required>

                                <?php foreach (['Ilmu Komputer', 'Teknik', 'Ekonomi dan Bisnis', 'Ilmu Sosial dan Ilmu Politik', 'Vokasi', 'Fakultas lainnya'] as $faculty): ?>

                                    <option value="<?= htmlspecialchars($faculty) ?>" <?= $profile['faculty'] === $faculty ? 'selected' : '' ?>><?= htmlspecialchars($faculty) ?></option>

                                <?php endforeach; ?>

                            </select>

                        </label>

                        <label class="fins-field">

                            <span>Program Studi</span>

                            <select name="study_program" id="editStudyProgram" required>

                                <?php foreach (['Pendidikan Teknologi Informasi', 'Teknik Informatika', 'Sistem Informasi', 'Teknologi Informasi', 'Ilmu Komputer', 'Program studi lainnya'] as $program): ?>

                                    <option value="<?= htmlspecialchars($program) ?>" <?= $profile['study_program'] === $program ? 'selected' : '' ?>><?= htmlspecialchars($program) ?></option>

                                <?php endforeach; ?>

                            </select>

                        </label>

                        <label class="fins-field fins-field-full">

                            <span>Bio / Motto singkat</span>

                            <textarea name="bio" id="editBio" maxlength="180" placeholder="Tulis bio atau motto singkat..."><?= htmlspecialchars($profile['bio']) ?></textarea>

                        </label>

                    </div>

                    <div class="fins-skills-editor">

                        <div class="fins-skills-editor-heading">

                            <label for="skillInput">Keahlian Utama (Skills)</label>

                            <span>Pilih 3–6 keahlian</span>

                        </div>

                        <div class="fins-skill-input-box">

                            <div class="fins-selected-skills" id="selectedSkills">

                                <?php foreach ($profile['skills'] as $skill): ?>

                                    <span class="fins-edit-skill-chip" data-skill="<?= htmlspecialchars($skill) ?>">

                                        • <?= htmlspecialchars($skill) ?>

                                        <button type="button" aria-label="Hapus <?= htmlspecialchars($skill) ?>" data-remove-skill="<?= htmlspecialchars($skill) ?>">×</button>

                                    </span>

                                <?php endforeach; ?>

                            </div>

                        </div>

                        <button class="fins-add-skill-trigger" id="addSkillButton" type="button" aria-expanded="false" aria-controls="skillDropdown">

                            <span aria-hidden="true">＋</span> Add Skill

                        </button>

                        <div class="fins-skill-dropdown" id="skillDropdown" hidden>

                            <label class="fins-skill-search">

                                <span aria-hidden="true">⌕</span>

                                <input type="search" id="skillSearchInput" placeholder="Cari Keahlian, cth: React, Python, Machine Learning">

                            </label>

                            <div class="fins-skill-dropdown-heading">

                                <span>Rekomendasi Prestasi Mahasiswa UB</span>

                                <span id="dropdownSkillCount">4 Dipilih</span>

                            </div>

                            <div class="fins-skill-options" id="skillOptions">

                                <button type="button" class="fins-skill-option" data-skill-option="Machine Learning / AI"><span>Machine Learning / AI</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Python"><span>Python</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Pitching Spesialist"><span>Pitching Spesialist</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Data Science"><span>Data Science</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Cyber Security"><span>Cyber Security</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Public Speaking"><span>Public Speaking</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="UI/UX Research"><span>UI/UX Research</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="React JS"><span>React JS</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Product Manager"><span>Product Manager</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Web Development"><span>Web Development</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Prompt Engineer"><span>Prompt Engineer</span><i>＋</i></button>

                                <button type="button" class="fins-skill-option" data-skill-option="Jurnal Research"><span>Jurnal Research</span><i>＋</i></button>

                            </div>

                            <p class="fins-skill-empty" id="skillEmptyState" hidden>Keahlian tidak ditemukan.</p>

                        </div>

                        <p class="fins-skill-hint" id="skillHint">Kamu dapat memilih 3 sampai 6 skill.</p>

                    </div>

                </div>

                <div class="fins-modal-footer">

                    <p class="fins-form-message" id="profileFormMessage" role="status"></p>

                    <div class="fins-modal-footer-actions">

                        <button class="fins-button fins-button-light" id="cancelEditProfile" type="button">Batal</button>

                        <button class="fins-button fins-button-primary" type="submit">Simpan Perubahan</button>

                    </div>

                </div>

            </form>

        </section>

    </div>

</body>

</html>
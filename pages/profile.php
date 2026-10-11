<?php
// FINS - Halaman Profile Mahasiswa
// File ini mengikuti struktur: pages/profile.php, css/profile.css, js/profile.js
// Versi frontend: perubahan profil diperbarui di tampilan browser.
// Untuk menyimpan permanen ke database, sambungkan form ke controller/backend dan database FINS.

$profile = [
    'fullname' => 'Sauka Gana Dzikri',
    'username' => '@sauka',
    'faculty' => 'Ilmu Komputer',
    'study_program' => 'Pendidikan Teknologi Informasi',
    'bio' => 'Make this life for have fun...',
    'skills' => ['UI/UX', 'Web Development', 'Prompt Engineer', 'Jurnal Research'],
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
    <script src="../js/profile.js" defer></script>
</head>
<body>
    <div class="fins-profile-page">
        <header class="fins-navbar">
            <a class="fins-brand" href="home.php" aria-label="FINS Beranda">
                <span class="fins-brand-mark">F<span>UB</span></span>
            </a>
            <nav class="fins-nav-links" aria-label="Navigasi utama">
                <a href="home.php">Beranda</a>
                <a href="cari_lomba.php">Cari Lomba</a>
                <a href="cari_partner.php">Cari Partner</a>
                <a href="lomba_saya.php">Lomba Saya</a>
                <a href="#">Tim Saya</a>
            </nav>
            <div class="fins-nav-actions">
                <a class="fins-nav-icon" href="chat.php" aria-label="Chat">☷</a>
                <a class="fins-nav-icon notification-icon" href="#" aria-label="Notifikasi">♧<i></i></a>
                <button class="fins-nav-avatar" type="button" aria-label="Buka profil">SG</button>
            </div>
        </header>

        <main class="fins-profile-main">
            <div class="fins-breadcrumb">PROFIL MAHASISWA <span>›</span></div>

            <div class="fins-profile-grid">
                <section class="fins-profile-left">
                    <article class="fins-card fins-user-card">
                        <div class="fins-avatar fins-avatar-large" id="profileAvatar">
                            <span>SG</span>
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
                        <div class="fins-avatar fins-avatar-modal" id="modalAvatar">SG</div>
                        <div class="fins-photo-actions">
                            <label class="fins-button fins-button-primary fins-upload-button" for="profilePhotoInput">♧ &nbsp; Unggah Foto Baru</label>
                            <input type="file" id="profilePhotoInput" accept="image/*" hidden>
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
                                <?php foreach (['Ilmu Komputer','Teknik','Ekonomi dan Bisnis','Ilmu Sosial dan Ilmu Politik','Vokasi','Fakultas lainnya'] as $faculty): ?>
                                    <option value="<?= htmlspecialchars($faculty) ?>" <?= $profile['faculty'] === $faculty ? 'selected' : '' ?>><?= htmlspecialchars($faculty) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="fins-field">
                            <span>Program Studi</span>
                            <select name="study_program" id="editStudyProgram" required>
                                <?php foreach (['Pendidikan Teknologi Informasi','Teknik Informatika','Sistem Informasi','Teknologi Informasi','Ilmu Komputer','Program studi lainnya'] as $program): ?>
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

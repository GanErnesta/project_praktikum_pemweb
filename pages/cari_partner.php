<?php
$partners = [
    ['id' => 1, 'name' => 'Aditya Pratama', 'study' => 'Teknik Informatika', 'semester' => 4, 'initials' => 'AP', 'bio' => 'Tertarik membangun produk digital scalable dan mengembangkan arsitektur teknologi.', 'skills' => ['React JS', 'JavaScript', 'Tailwind CSS'], 'interests' => ['Hackathon', 'Web Dev Competition'], 'match' => 96, 'tag' => 'Skill Melengkapi', 'kind' => 'complement', 'category' => 'Hackathon · Web Dev Competition', 'online' => true],
    ['id' => 2, 'name' => 'Nadia Putri', 'study' => 'Sistem Informasi', 'semester' => 4, 'initials' => 'NP', 'bio' => 'Fokus pada user research mendalam, wireframing interaktif, dan prototyping.', 'skills' => ['UI/UX Research', 'Figma', 'Design Thinking'], 'interests' => ['UI/UX Design Competition', 'Product Design'], 'match' => 98, 'tag' => 'Minat Lomba Sama', 'kind' => 'same', 'category' => 'UI/UX Competition · Product Design', 'online' => true],
    ['id' => 3, 'name' => 'Rizky Mahendra', 'study' => 'Pendidikan Tek. Informasi', 'semester' => 2, 'initials' => 'RM', 'bio' => 'Passionate tentang machine learning modern, data visualisation, dan AI.', 'skills' => ['Python', 'Data Analysis', 'Scikit-Learn'], 'interests' => ['Data Science / AI', 'Hackathon'], 'match' => 91, 'tag' => 'Skill Melengkapi', 'kind' => 'complement', 'category' => 'Data Science Competition · AI Challenge', 'online' => true],
    ['id' => 4, 'name' => 'Farhan Ramadhan', 'study' => 'Teknik Informatika', 'semester' => 6, 'initials' => 'FR', 'bio' => 'Fokus pengembangan aplikasi Android dan iOS lintas platform.', 'skills' => ['Flutter', 'REST API', 'Kotlin'], 'interests' => ['Mobile App Competition', 'Hackathon'], 'match' => 89, 'tag' => 'Skill Melengkapi', 'kind' => 'complement', 'category' => 'Mobile App Competition · Hackathon', 'online' => false],
    ['id' => 5, 'name' => 'Sarah Annisa', 'study' => 'Ilmu Komunikasi', 'semester' => 4, 'initials' => 'SA', 'bio' => 'Mahir merangkai narasi investor pitch dan storytelling.', 'skills' => ['Public Speaking', 'Pitch Deck', 'Storytelling'], 'interests' => ['Business Plan (BPC)', 'Pitching'], 'match' => 95, 'tag' => 'Minat Lomba Sama', 'kind' => 'same', 'category' => 'Business Plan Competition · Pitching', 'online' => true],
    ['id' => 6, 'name' => 'Bima Arya Putra', 'study' => 'Manajemen Bisnis', 'semester' => 6, 'initials' => 'BA', 'bio' => 'Menguasai Business Model Canvas, validasi pasar, dan unit economics.', 'skills' => ['BMC Strategy', 'Market Research', 'Financial Model'], 'interests' => ['Hackathon', 'Business Innovation'], 'match' => 92, 'tag' => 'Skill Melengkapi', 'kind' => 'complement', 'category' => 'Hackathon · Business Innovation', 'online' => true],
    ['id' => 7, 'name' => 'Dinda Maharani', 'study' => 'Sistem Informasi', 'semester' => 3, 'initials' => 'DM', 'bio' => 'Senang mengubah kebutuhan pengguna menjadi pengalaman produk yang sederhana.', 'skills' => ['Figma', 'UI Design', 'Prototyping'], 'interests' => ['UI/UX Design Competition', 'Hackathon'], 'match' => 90, 'tag' => 'Minat Lomba Sama', 'kind' => 'same', 'category' => 'UI/UX Competition · Hackathon', 'online' => false],
    ['id' => 8, 'name' => 'Rafi Kurniawan', 'study' => 'Teknik Informatika', 'semester' => 5, 'initials' => 'RK', 'bio' => 'Tertarik pada backend, API, dan keamanan aplikasi web.', 'skills' => ['PHP', 'Laravel', 'Database'], 'interests' => ['Programming Competition', 'Hackathon'], 'match' => 88, 'tag' => 'Skill Melengkapi', 'kind' => 'complement', 'category' => 'Programming Competition · Hackathon', 'online' => true],
    ['id' => 9, 'name' => 'Nabila Putri', 'study' => 'Ilmu Komunikasi', 'semester' => 2, 'initials' => 'NB', 'bio' => 'Memiliki minat pada komunikasi publik dan proposal kompetisi.', 'skills' => ['Public Speaking', 'Copywriting', 'Presentation'], 'interests' => ['Business Plan (BPC)', 'Karya Tulis Ilmiah (KTI)'], 'match' => 87, 'tag' => 'Minat Lomba Sama', 'kind' => 'same', 'category' => 'Business Plan · KTI', 'online' => true]
];
$skillOptions = ['UI/UX Research' => 48, 'Figma' => 62, 'Web Development' => 54, 'React JS' => 31, 'Python' => 39, 'Machine Learning / AI' => 22, 'Data Science' => 18, 'Public Speaking' => 35, 'Business Development' => 27, 'Graphic Design' => 41];
$studyOptions = ['Teknik Informatika', 'Sistem Informasi', 'Pendidikan Tek. Informasi', 'Ilmu Komunikasi', 'Manajemen Bisnis'];
$interestOptions = ['Hackathon', 'UI/UX Design Competition', 'Business Plan (BPC)', 'Data Science / AI', 'Karya Tulis Ilmiah (KTI)'];
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Partner | FINS</title>
    <link rel="stylesheet" href="../css/cari_partner.css">
    <script src="../js/cari_partner.js" defer></script>
</head>

<body>
    <header class="fins-navbar"><a class="fins-brand" href="home.php"><b>FINS</b><small>Universitas Brawijaya</small></a>
        <nav class="fins-nav-links"><a href="home.php">Home</a><a href="cari_lomba.php">Cari Lomba</a><a class="active" href="cari_partner.php">Cari Partner</a><a href="posting_lomba.php">Posting Lomba</a><a href="lomba_saya.php">Lomba Saya</a><a href="#">Notifikasi</a><a href="chat.php">Chat</a><a href="profile.php">Profile</a></nav>
        <div class="fins-nav-actions"><a href="#" aria-label="Notifikasi">♧</a><a href="chat.php" aria-label="Chat">▱</a><a class="fins-nav-avatar" href="profile.php">SG</a></div>
    </header>
    <main class="cp-main">
        <section class="cp-hero">
            <div><span class="cp-eyebrow">♟ Talent Discovery Brawijaya</span>
                <h1>Cari Partner</h1>
                <p>Temukan rekan mahasiswa lintas fakultas dengan keahlian dan minat yang saling melengkapi untuk<br class="desktop-break"> membentuk tim lomba kebanggaan Universitas Brawijaya.</p>
            </div>
            <div class="cp-active-pill"><i></i><strong>184</strong> Mahasiswa Aktif Siap Kolaborasi</div>
        </section>
        <form class="cp-search" id="partnerSearchForm"><span class="search-icon">⌕</span><input id="partnerSearchInput" type="search" placeholder="Cari nama mahasiswa, skill (Figma, React, AI), atau minat lomba (Hackathon, GEMASTIK)..."><button type="button" id="clearPartnerSearch" class="clear-search">×</button><button class="cp-search-button">Cari</button></form>
        <div class="cp-active-filters" id="activeFiltersBar"><b>FILTER AKTIF:</b>
            <div id="activeFilterChips"></div><button type="button" id="clearAllFilters">Hapus Semua</button>
        </div>
        <div class="cp-layout">
            <aside class="cp-filter-panel">
                <div class="cp-filter-title">
                    <h2>☷ Filter Pencarian</h2><span id="activeFilterCount">0 Aktif</span>
                </div>
                <section class="filter-section">
                    <div class="section-heading">
                        <h3>Keahlian / Skill</h3><small>Multi-pilih</small>
                    </div><label class="skill-search"><input id="skillFilterSearch" placeholder="Cari skill..."><span>⌕</span></label>
                    <div class="check-list" id="skillFilterList"><?php foreach ($skillOptions as $s => $n): ?><label class="check-option"><input type="checkbox" data-filter="skill" value="<?= htmlspecialchars($s) ?>"><i></i><span class="option-text"><?= htmlspecialchars($s) ?></span><small><?= $n ?></small></label><?php endforeach; ?></div>
                </section>
                <section class="filter-section">
                    <div class="section-heading">
                        <h3>Program Studi</h3>
                    </div>
                    <div class="check-list"><?php foreach ($studyOptions as $s): ?><label class="check-option"><input type="checkbox" data-filter="study" value="<?= htmlspecialchars($s) ?>"><i></i><span class="option-text"><?= htmlspecialchars($s) ?></span></label><?php endforeach; ?></div>
                </section>
                <section class="filter-section">
                    <div class="section-heading">
                        <h3>Semester</h3>
                    </div>
                    <div class="semester-grid"><?php for ($i = 1; $i <= 8; $i++): ?><label><input type="checkbox" data-filter="semester" value="<?= $i ?>"><span>S<?= $i ?></span></label><?php endfor; ?></div>
                </section>
                <section class="filter-section">
                    <div class="section-heading">
                        <h3>Minat Kompetisi</h3>
                    </div>
                    <div class="check-list"><?php foreach ($interestOptions as $s): ?><label class="check-option"><input type="checkbox" data-filter="interest" value="<?= htmlspecialchars($s) ?>"><i></i><span class="option-text"><?= htmlspecialchars($s) ?></span></label><?php endforeach; ?></div>
                </section>
                <button class="apply-filters" id="applyFilters" type="button">Terapkan Filter</button><button class="reset-filters" id="resetFilters" type="button">Reset Filter</button>
            </aside>
            <section class="cp-results">
                <div class="results-header">
                    <div>
                        <h2>Partner yang Cocok untukmu <span id="resultCount">9 Mahasiswa</span></h2>
                        <p>Rekomendasi berdasarkan kecocokan bidang lomba dan sinergi kompetensi tim.</p>
                    </div><label class="sort-label">Urutkan: <select id="partnerSort">
                            <option value="relevance">Paling Relevan (Skill Match)</option>
                            <option value="name">Nama A–Z</option>
                            <option value="semester">Semester</option>
                        </select></label>
                </div>
                <div class="card-grid" id="partnerCardGrid"><?php foreach ($partners as $p): ?><article class="partner-card" data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars(strtolower($p['name'])) ?>" data-study="<?= htmlspecialchars($p['study']) ?>" data-semester="<?= $p['semester'] ?>" data-skills="<?= htmlspecialchars(implode('|', $p['skills'])) ?>" data-interests="<?= htmlspecialchars(implode('|', $p['interests'])) ?>" data-match="<?= $p['match'] ?>" data-search="<?= htmlspecialchars(strtolower($p['name'] . ' ' . $p['study'] . ' ' . implode(' ', $p['skills']) . ' ' . implode(' ', $p['interests']) . ' ' . $p['bio'])) ?>">
                            <div class="person-row">
                                <div class="avatar"><?= $p['initials'] ?></div>
                                <div class="person-info">
                                    <h3><?= htmlspecialchars($p['name']) ?></h3>
                                    <p><?= htmlspecialchars($p['study']) ?> · S<?= $p['semester'] ?></p><span class="match-tag <?= $p['kind'] ?>"><?= $p['kind'] === 'same' ? '◎' : '✣' ?> <?= htmlspecialchars($p['tag']) ?></span>
                                </div><i class="online <?= $p['online'] ? 'yes' : '' ?>"></i>
                            </div>
                            <p class="bio">"<?= htmlspecialchars($p['bio']) ?>"</p>
                            <div class="match-score"><span>Kecocokan Kebutuhan:</span><strong><?= $p['match'] ?>% Match</strong></div>
                            <div class="card-skills"><small>Keahlian:</small>
                                <div><?php foreach ($p['skills'] as $s): ?><span><?= htmlspecialchars($s) ?></span><?php endforeach; ?></div>
                            </div>
                            <div class="card-interest"><b>♧</b><?= htmlspecialchars($p['category']) ?></div>
                            <div class="card-actions"><button type="button" class="profile-button" data-profile="<?= $p['id'] ?>">Lihat Profil</button><button type="button" class="invite-button" data-invite="<?= $p['id'] ?>">Ajak Kolaborasi</button></div>
                        </article><?php endforeach; ?></div>
                <div class="empty-state" id="emptyPartnerState" hidden>
                    <h3>Partner belum ditemukan</h3>
                    <p>Coba ubah kata kunci atau sesuaikan filter pencarianmu.</p><button type="button" id="emptyResetFilters">Reset Filter</button>
                </div>
                <div class="pagination"><span id="paginationInfo"></span>
                    <div id="pageButtons"></div>
                </div>
            </section>
        </div>
    </main>
    <footer class="cp-footer"><span>© 2024 FINS • Universitas Brawijaya. Kolaborasi Karya &amp; Prestasi Mahasiswa.</span>
        <div><a href="#">Pusat Bantuan</a><a href="#">Pedoman Komunitas</a><a href="#">Kebijakan Privasi</a></div>
    </footer>
    <div class="modal-backdrop" id="inviteModal" aria-hidden="true">
        <section class="invite-modal" role="dialog" aria-modal="true"><button type="button" class="modal-close" id="closeInviteModal">×</button><span class="modal-eyebrow">FINS COLLABORATION</span>
            <h2>Ajak Kolaborasi</h2>
            <p class="modal-desc">Kirim undangan kepada calon partner untuk bergabung dalam tim lombamu.</p>
            <form id="inviteForm"><label>Calon Partner<input id="invitePartnerName" readonly></label><label>Lomba / Proyek<input id="inviteCompetition" placeholder="Contoh: GEMASTIK UI/UX" required></label><label>Peran yang dibutuhkan<select id="inviteRole" required>
                        <option value="">Pilih peran</option>
                        <option>UI/UX Designer</option>
                        <option>Frontend Developer</option>
                        <option>Backend Developer</option>
                        <option>Data Scientist / AI</option>
                        <option>Business / Pitching</option>
                        <option>Anggota Tim</option>
                    </select></label><label>Pesan undangan<textarea id="inviteMessage" rows="3" required></textarea></label>
                <p id="inviteFeedback" class="invite-feedback"></p>
                <div class="modal-actions"><button type="button" class="profile-button" id="cancelInvite">Batal</button><button type="submit" class="invite-button">Kirim Undangan</button></div>
            </form>
        </section>
    </div>
</body>

</html>
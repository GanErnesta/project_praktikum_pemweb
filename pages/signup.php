<?php
session_start();

$errors = [];
$step = isset($_POST['step']) ? (int) $_POST['step'] : 1;
$step = ($step === 2) ? 2 : 1;

$old = $_SESSION['signup_form'] ?? [
    'nama' => '',
    'nim' => '',
    'fakultas' => '',
    'prodi' => '',
    'email' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 1) {
        $nama = trim($_POST['nama'] ?? '');
        $nim = trim($_POST['nim'] ?? '');
        $fakultas = trim($_POST['fakultas'] ?? '');
        $prodi = trim($_POST['prodi'] ?? '');

        if ($nama === '') $errors[] = 'Nama lengkap wajib diisi.';
        if (!preg_match('/^[0-9]{10,15}$/', $nim)) {
            $errors[] = 'NIM harus terdiri dari 10–15 angka.';
        }
        if ($fakultas === '') $errors[] = 'Silakan pilih fakultas.';
        if ($prodi === '') $errors[] = 'Silakan pilih program studi.';

        if (!$errors) {
            $_SESSION['signup_form'] = array_merge($old, [
                'nama' => $nama,
                'nim' => $nim,
                'fakultas' => $fakultas,
                'prodi' => $prodi,
            ]);
            header('Location: signup.php?step=2');
            exit;
        }

        $old = array_merge($old, compact('nama', 'nim'), [
            'fakultas' => $fakultas,
            'prodi' => $prodi,
        ]);
    } else {
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Masukkan alamat email yang valid.';
        } elseif (!str_ends_with($email, '@student.ub.ac.id')) {
            $errors[] = 'Gunakan email mahasiswa UB (@student.ub.ac.id).';
        }
        if (strlen($password) < 8) $errors[] = 'Password minimal 8 karakter.';
        if ($password !== $confirmPassword) $errors[] = 'Konfirmasi password tidak sesuai.';

        if (!$errors) {
            // Frontend demo: data disimpan sementara di session, tanpa database.
            $_SESSION['signup_form'] = array_merge($old, [
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            // OTP demo tetap 123456 sampai backend email diintegrasikan.
            $_SESSION['verification_code'] = '123456';
            $_SESSION['verification_expires'] = time() + 300;
            $_SESSION['verification_attempts'] = 0;

            header('Location: verification.php');
            exit;
        }

        $old['email'] = $email;
    }
}

if (isset($_GET['step']) && (int) $_GET['step'] === 2) {
    $step = 2;
}

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | FINS</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
<main class="auth-layout signup-layout">
    <section class="brand-panel">
        <a class="brand-logo" href="home.php" aria-label="FINS">
            <span class="brand-f">F</span><small>UB</small>
        </a>

        <div class="brand-copy">
            <p class="eyebrow">TEMUKAN PELUANGMU</p>
            <h2>Cari lomba. Temukan partner. Bangun koneksi.</h2>
            <p>Satu tempat untuk menemukan peluang kompetisi dan mahasiswa dengan skill yang sesuai.</p>
        </div>

        <img class="brand-illustration" src="../assets/images/fins-login.png" alt="Ilustrasi mahasiswa FINS">
        <p class="brand-footer">FINS Universitas Brawijaya</p>
    </section>

    <section class="form-panel">
        <div class="form-content">
            <p class="mobile-eyebrow">FINS · Universitas Brawijaya</p>
            <h1>Mari mulai perjalananmu<br>FINSBE!!</h1>
            <p class="intro">Bergabung dengan FINS dan temukan koneksi yang bisa berkembang bersamamu.</p>

            <h2><?= $step === 1 ? 'Lengkapi data kamu!!' : 'Buat akun yaa!!' ?></h2>

            <?php if ($errors): ?>
                <div class="form-alert" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <p><?= e($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($step === 1): ?>
            <form id="signupForm" method="POST" action="signup.php" novalidate>
                <input type="hidden" name="step" value="1">

                <label for="nama">Nama Lengkap</label>
                <input id="nama" name="nama" type="text" placeholder="Nama Lengkap" value="<?= e($old['nama']) ?>" autocomplete="name" required>

                <label for="nim">NIM</label>
                <input id="nim" name="nim" type="text" placeholder="NIM sesuai KTM" value="<?= e($old['nim']) ?>" inputmode="numeric" maxlength="15" autocomplete="off" required>

                <div class="field-row">
                    <div class="field-group">
                        <label for="fakultas">Fakultas</label>
                        <select id="fakultas" name="fakultas" required>
                            <option value="">Fakultas...</option>
                            <?php
                            $faculties = ['Ilmu Komputer', 'Teknik', 'Ekonomi dan Bisnis', 'Ilmu Administrasi', 'Ilmu Sosial dan Ilmu Politik', 'Pertanian', 'Kedokteran', 'Ilmu Budaya', 'Hukum', 'MIPA'];
                            foreach ($faculties as $faculty):
                            ?>
                            <option value="<?= e($faculty) ?>" <?= $old['fakultas'] === $faculty ? 'selected' : '' ?>><?= e($faculty) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="prodi">Program Studi</label>
                        <select id="prodi" name="prodi" required>
                            <option value="">Program studi...</option>
                            <?php
                            $programs = ['Pendidikan Teknologi Informasi', 'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer', 'Desain Komunikasi Visual', 'Manajemen', 'Ilmu Komunikasi', 'Akuntansi', 'Psikologi', 'Ilmu Hukum'];
                            foreach ($programs as $program):
                            ?>
                            <option value="<?= e($program) ?>" <?= $old['prodi'] === $program ? 'selected' : '' ?>><?= e($program) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button class="primary-button" type="submit">Next <span aria-hidden="true">➜</span></button>
            </form>
            <?php else: ?>
            <form id="signupForm" method="POST" action="signup.php" novalidate>
                <input type="hidden" name="step" value="2">

                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Email UB kamu" value="<?= e($old['email']) ?>" autocomplete="email" required>

                <label for="password">Create Password</label>
                <div class="password-field">
                    <input id="password" name="password" type="password" placeholder="Buat password kamu minimal 8 karakter" minlength="8" autocomplete="new-password" required>
                    <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">◉</button>
                </div>

                <label for="confirmPassword">Confirm Password</label>
                <div class="password-field">
                    <input id="confirmPassword" name="confirm_password" type="password" placeholder="Ulangi password kamu" minlength="8" autocomplete="new-password" required>
                    <button type="button" class="toggle-password" data-target="confirmPassword" aria-label="Tampilkan konfirmasi password">◉</button>
                </div>

                <div class="password-meter" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span></div>
                <p class="helper-text">Gunakan simbol, angka, dan karakter unik.</p>

                <button class="primary-button" type="submit">Sign Up</button>
                <p class="signin-link">Have an account? <a href="login.php">Sign in</a></p>
                <a class="back-link" href="signup.php">← Kembali ke data diri</a>
            </form>
            <?php endif; ?>
        </div>
    </section>
</main>
<script src="../js/signup.js"></script>
</body>
</html>

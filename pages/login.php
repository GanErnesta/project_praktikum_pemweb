<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nim === '' || $password === '') {
        $error = 'NIM dan password wajib diisi.';
    } else {
        $error = 'Login gagal. Periksa NIM dan password Anda.';
    }
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = trim($_POST['nim'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nim === '' || $password === '') {
        $error = 'NIM dan password wajib diisi.';
    } elseif (!ctype_digit($nim)) {
        $error = 'NIM hanya boleh berisi angka.';
    } else {
        $error = 'Login gagal. Periksa NIM dan password Anda.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login FINS</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="login-container">
    <section class="login-form">
        <h1>Selamat Datang Kembali<br>FINS!!</h1>
        <p class="subtitle">
            Silakan masuk menggunakan NIM dan kata sandi Anda
        </p>

        <?php if ($error !== ''): ?>
            <p class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <form action="../php/auth/login.php" method="POST">
            <label for="nim">NIM</label>
            <input
                type="text"
                id="nim"
                name="nim"
                placeholder="NIM sesuai KTM"
                inputmode="numeric"
                pattern="[0-9]+"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                required
            >

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan Password"
                    required
                >
            <button
                type="button"
                id="togglePassword"
                aria-label="Tampilkan password"
            >
                <svg viewBox="0 0 24 24" width="20" height="20"
                    fill="none" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </button>
            </div>

            <div class="forgot">
                <a href="forgot-password.php">Forgot Password?</a>
            </div>

            <button type="submit" class="login-button">Login</button>

            <p class="signup">
                Don't have an account?
                <a href="register.php">Sign Up</a>
            </p>
        </form>
    </section>

    <section class="login-banner">
        <div class="logo">
            <img src="../assets/images/Group4.png" alt="Logo F UB">
        </div>

        <div class="banner-text">
            <p>TEMUKAN KONEKSI YANG TEPAT</p>
            <h2>Skill berbeda, tujuan yang sama.</h2>
            <p>
                Hubungkan skill dan minatmu dengan mahasiswa lain
                untuk menemukan kesempatan yang sesuai.
            </p>
        </div>

        <div class="illustration">
            <img src="../assets/images/fins-login.png" alt="Ilustrasi mahasiswa">
        </div>

        <footer>FINS Universitas Brawijaya</footer>
    </section>
</div>

<script src="../js/login.js"></script>
</body>
</html>
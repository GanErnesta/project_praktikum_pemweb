<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Gagal | FINS</title>
    <link rel="stylesheet" href="../css/verification.css">
</head>
<body>
<main class="verification-layout result-layout">
    <section class="result-panel">
        <a class="brand-logo" href="signup.php" aria-label="FINS"><span>F</span><small>UB</small></a>
        <div class="result-content">
            <div class="result-icon failed-icon" aria-hidden="true">×</div>
            <h1>Verifikasi Gagal</h1>
            <p>Akun kamu belum berhasil diverifikasi.<br>Silakan untuk melakukan kirim ulang kode</p>
            <a class="primary-button button-link" href="verification.php">Back to Verification Code</a>
        </div>
    </section>
    <section class="verification-brand-panel result-brand-panel">
        <div class="brand-copy">
            <p class="eyebrow">SELAMAT, KAMU SIAP!</p>
            <h2>Verifikasi Berhasil!</h2>
            <p>Akunmu sudah siap digunakan. Yuk, mulai temukan peluang dan koneksi baru di FINS.</p>
        </div>
        <img src="../assets/images/fins-login.png" alt="Ilustrasi verifikasi akun" class="brand-illustration">
        <p class="brand-footer">FINS Universitas Brawijaya</p>
    </section>
</main>
</body>
</html>

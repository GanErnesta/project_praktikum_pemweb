<?php
session_start();

if (empty($_SESSION['signup_form']['email'])) {
    header('Location: signup.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = preg_replace('/\D/', '', $_POST['otp'] ?? '');

    if (isset($_POST['resend'])) {
        // Mode demo: OTP diset ulang, belum mengirim email sungguhan.
        $_SESSION['verification_code'] = '123456';
        $_SESSION['verification_expires'] = time() + 300;
        $_SESSION['verification_attempts'] = 0;
        header('Location: verification.php?resent=1');
        exit;
    }

    if (strlen($otp) !== 6) {
        $error = 'Masukkan kode verifikasi 6 digit.';
    } elseif (time() > ($_SESSION['verification_expires'] ?? 0)) {
        $error = 'Kode verifikasi sudah kedaluwarsa. Kirim ulang kode.';
    } else {
        $_SESSION['verification_attempts'] = ($_SESSION['verification_attempts'] ?? 0) + 1;

        if (hash_equals($_SESSION['verification_code'] ?? '', $otp)) {
            $_SESSION['account_verified'] = true;
            header('Location: verification-success.php');
            exit;
        }

        $error = 'Kode verifikasi salah. Silakan coba lagi.';
        if ($_SESSION['verification_attempts'] >= 5) {
            header('Location: verification-failed.php');
            exit;
        }
    }
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
    <title>Verifikasi Akun | FINS</title>
    <link rel="stylesheet" href="../css/verification.css">
</head>
<body>
<main class="verification-layout">
    <section class="verification-form-panel">
        <a class="brand-logo" href="signup.php" aria-label="FINS"><span>F</span><small>UB</small></a>

        <div class="verification-content">
            <h1>Masukkan kode<br>verifikasi</h1>
            <p class="verification-subtitle">Kami telah mengirimkan kode verifikasi ke email anda.</p>

            <?php if (isset($_GET['resent'])): ?>
                <p class="notice">Kode demo berhasil diperbarui. Gunakan kode <strong>123456</strong>.</p>
            <?php endif; ?>
            <?php if ($error !== ''): ?>
                <p class="error-message" role="alert"><?= e($error) ?></p>
            <?php endif; ?>

            <form id="verificationForm" method="POST" action="verification.php">
                <div class="otp-inputs" aria-label="Kode OTP 6 digit">
                    <?php for ($i = 0; $i < 6; $i++): ?>
                    <input type="text" class="otp-digit" inputmode="numeric" pattern="[0-9]*" maxlength="1" aria-label="Digit <?= $i + 1 ?>" <?= $i === 0 ? 'autofocus' : '' ?> required>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="otp" id="otpValue">

                <p class="resend-line">Tidak menerima kode? <button type="submit" name="resend" value="1" id="resendButton" disabled>Kirim ulang (<span id="countdown">00:58</span>)</button></p>
                <button class="primary-button" type="submit" id="verifyButton">Verification Account</button>
            </form>
            <a class="back-link" href="login.php">← Kembali ke sign in</a>
            <p class="demo-hint">Mode demo: gunakan kode <strong>123456</strong>.</p>
        </div>
    </section>

    <section class="verification-brand-panel">
        <div class="brand-copy">
            <p class="eyebrow">PASTIKAN AKUNMU AMAN</p>
            <h2>Satu langkah lagi untuk terhubung.</h2>
            <p>Verifikasi akunmu dan lanjutkan perjalananmu bersama FINS.</p>
        </div>
        <img src="../assets/images/fins-login.png" alt="Ilustrasi verifikasi akun" class="brand-illustration">
        <p class="brand-footer">FINS Universitas Brawijaya</p>
    </section>
</main>
<script src="../js/verification.js"></script>
</body>
</html>

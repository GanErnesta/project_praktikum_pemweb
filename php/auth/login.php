
<?php
session_start();

// Pastikan form dikirim menggunakan POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../pages/login.php");
    exit;
}

// Ambil input dari form
$nim = trim($_POST["nim"] ?? "");
$password = $_POST["password"] ?? "";

// Validasi input
if ($nim === "" || $password === "") {
    header("Location: ../../pages/login.php?error=empty");
    exit;
}

// Akun dummy untuk pengujian sementara
$dummyNim = "255150600111045";
$dummyPassword = "123456";

// Periksa kecocokan akun
if ($nim === $dummyNim && $password === $dummyPassword) {
    session_regenerate_id(true);

    $_SESSION["user_id"] = $nim;
    $_SESSION["user_nama"] = "Muhammad Daffa Wijaya";
    $_SESSION["user_nim"] = $nim;

    // Arahkan ke halaman Home
    header("Location: ../../pages/home.php");
    exit;
}

// Jika akun tidak cocok
header("Location: ../../pages/login.php?error=credentials");
exit;

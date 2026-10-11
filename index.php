
<?php
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah login, masuk ke halaman Home
    header('Location: pages/home.php');
    exit;
}

// Jika belum login, arahkan ke halaman Login
header('Location: pages/login.php');
exit;
?>

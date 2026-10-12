<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host   = "localhost";
$user   = "Zainiatur";
$pass   = "Zayazntr07."; // Pass yang kamu set di MariaDB tadi
$dbname = "fins_ub";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => false, "message" => "Koneksi database gagal: " . $e->getMessage()]);
    exit();
}
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.php");
    exit;
}

if (
    !isset($_SESSION["csrf_token"]) ||
    !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"] ?? "")
) {
    header("Location: ../login.php?error=request");
    exit;
}

require_once __DIR__ . "/../config/database.php";

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === "") {
    header("Location: ../login.php?error=invalid");
    exit;
}

$stmt = $pdo->prepare(
    "SELECT id, nama, email, password FROM users WHERE email = :email LIMIT 1"
);
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user["password"])) {
    header("Location: ../login.php?error=credentials");
    exit;
}

session_regenerate_id(true);

$_SESSION["user_id"] = $user["id"];
$_SESSION["user_nama"] = $user["nama"];
$_SESSION["user_email"] = $user["email"];

unset($_SESSION["csrf_token"]);

header("Location: ../dashboard.php");
exit;
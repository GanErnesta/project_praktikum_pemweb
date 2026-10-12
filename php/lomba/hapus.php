<?php
<?php
require_once '../../config/database.php';

try {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $sql = "DELETE FROM lomba WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    echo json_encode(['status' => true, 'message' => 'Lomba berhasil dihapus!']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}

$input = json_decode(file_get_contents('php://input'), true);

$id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($input['id']) ? (int)$input['id'] : 0);

if ($id <= 0) {
    echo json_encode(["status" => false, "message" => "ID lomba tidak valid"]);
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM lomba WHERE id = :id");
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => true, "message" => "Lomba berhasil dihapus"]);
    } else {
        echo json_encode(["status" => false, "message" => "Data lomba tidak ditemukan"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => "Gagal menghapus lomba: " . $e->getMessage()]);
}
?>
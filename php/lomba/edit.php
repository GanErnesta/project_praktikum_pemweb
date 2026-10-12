<?php
require_once '../../config/database.php';

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $input = $_POST;
}

$id                = isset($input['id']) ? (int)$input['id'] : 0;
$judul_lomba       = isset($input['judul_lomba']) ? trim($input['judul_lomba']) : '';
$penyelenggara     = isset($input['penyelenggara']) ? trim($input['penyelenggara']) : '';
$nama_penyelenggara= isset($input['nama_penyelenggara']) ? trim($input['nama_penyelenggara']) : '';
$kategori_id       = isset($input['kategori_id']) ? (int)$input['kategori_id'] : 0;
$status            = isset($input['status']) ? trim($input['status']) : '';
$deadline          = isset($input['deadline']) ? trim($input['deadline']) : '';
$deskripsi         = isset($input['deskripsi']) ? trim($input['deskripsi']) : '';
$ukuran_tim        = isset($input['ukuran_tim']) ? (int)$input['ukuran_tim'] : 1;
$skills            = isset($input['skills']) ? $input['skills'] : [];

if ($id <= 0) {
    echo json_encode(["status" => false, "message" => "ID lomba tidak valid"]);
    exit();
}

try {
    $pdo->beginTransaction();

    $sql = "UPDATE lomba SET 
                judul_lomba = :judul, 
                penyelenggara = :penyelenggara, 
                nama_penyelenggara = :nama_penyelenggara, 
                kategori_id = :kategori_id, 
                status = :status, 
                deadline = :deadline, 
                deskripsi = :deskripsi, 
                ukuran_tim = :ukuran_tim 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':judul'              => $judul_lomba,
        ':penyelenggara'      => $penyelenggara,
        ':nama_penyelenggara' => $nama_penyelenggara,
        ':kategori_id'        => $kategori_id,
        ':status'             => $status,
        ':deadline'           => $deadline,
        ':deskripsi'          => $deskripsi,
        ':ukuran_tim'         => $ukuran_tim,
        ':id'                 => $id
    ]);

    // Update relasi skill (Hapus yang lama, masukkan yang baru)
    if (is_array($skills)) {
        $pdo->prepare("DELETE FROM lomba_skill WHERE lomba_id = :id")->execute([':id' => $id]);

        $sqlSkill = "INSERT INTO lomba_skill (lomba_id, skill_id) VALUES (:lomba_id, :skill_id)";
        $stmtSkill = $pdo->prepare($sqlSkill);
        foreach ($skills as $skill_id) {
            $stmtSkill->execute([':lomba_id' => $id, ':skill_id' => $skill_id]);
        }
    }

    $pdo->commit();
    echo json_encode(["status" => true, "message" => "Berhasil mengupdate data lomba"]);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(["status" => false, "message" => "Gagal mengupdate lomba: " . $e->getMessage()]);
}
?>
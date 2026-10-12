<?php
<?php
require_once '../../config/database.php';

try {
    $data = json_decode(file_get_contents("php://input"), true) ?? $_POST;

    $sql = "INSERT INTO lomba (judul_lomba, penyelenggara, nama_penyelenggara, kategori_id, status, deadline, deskripsi, ukuran_tim) 
            VALUES (:judul, :penyelenggara, :nama_penyelenggara, :kategori_id, :status, :deadline, :deskripsi, :ukuran_tim)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':judul' => $data['judul_lomba'],
        ':penyelenggara' => $data['penyelenggara'],
        ':nama_penyelenggara' => $data['nama_penyelenggara'],
        ':kategori_id' => $data['kategori_id'],
        ':status' => $data['status'] ?? 'Pendaftaran Buka',
        ':deadline' => $data['deadline'],
        ':deskripsi' => $data['deskripsi'] ?? null,
        ':ukuran_tim' => $data['ukuran_tim'] ?? 3
    ]);

    echo json_encode(['status' => true, 'message' => 'Lomba berhasil ditambahkan!']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => false, 'message' => $e->getMessage()]);
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $input = $_POST;
}

$judul_lomba       = isset($input['judul_lomba']) ? trim($input['judul_lomba']) : '';
$penyelenggara     = isset($input['penyelenggara']) ? trim($input['penyelenggara']) : 'Universitas';
$nama_penyelenggara= isset($input['nama_penyelenggara']) ? trim($input['nama_penyelenggara']) : '';
$kategori_id       = isset($input['kategori_id']) ? (int)$input['kategori_id'] : 0;
$status            = isset($input['status']) ? trim($input['status']) : 'Pendaftaran Buka';
$deadline          = isset($input['deadline']) ? trim($input['deadline']) : '';
$deskripsi         = isset($input['deskripsi']) ? trim($input['deskripsi']) : '';
$ukuran_tim        = isset($input['ukuran_tim']) ? (int)$input['ukuran_tim'] : 1;
$skills            = isset($input['skills']) ? $input['skills'] : []; // Array ID skill [1, 2, 3]

if (empty($judul_lomba) || empty($nama_penyelenggara) || $kategori_id <= 0 || empty($deadline)) {
    echo json_encode(["status" => false, "message" => "Field wajib harus diisi lengkap!"]);
    exit();
}

try {
    $pdo->beginTransaction();

    $sql = "INSERT INTO lomba (judul_lomba, penyelenggara, nama_penyelenggara, kategori_id, status, deadline, deskripsi, ukuran_tim) 
            VALUES (:judul, :penyelenggara, :nama_penyelenggara, :kategori_id, :status, :deadline, :deskripsi, :ukuran_tim)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':judul'              => $judul_lomba,
        ':penyelenggara'      => $penyelenggara,
        ':nama_penyelenggara' => $nama_penyelenggara,
        ':kategori_id'        => $kategori_id,
        ':status'             => $status,
        ':deadline'           => $deadline,
        ':deskripsi'          => $deskripsi,
        ':ukuran_tim'         => $ukuran_tim
    ]);

    $lomba_id = $pdo->lastInsertId();

    // Insert relasi skill jika ada
    if (!empty($skills) && is_array($skills)) {
        $sqlSkill = "INSERT INTO lomba_skill (lomba_id, skill_id) VALUES (:lomba_id, :skill_id)";
        $stmtSkill = $pdo->prepare($sqlSkill);
        foreach ($skills as $skill_id) {
            $stmtSkill->execute([':lomba_id' => $lomba_id, ':skill_id' => $skill_id]);
        }
    }

    $pdo->commit();
    echo json_encode(["status" => true, "message" => "Berhasil menambah lomba baru", "id" => $lomba_id]);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(["status" => false, "message" => "Gagal menambah lomba: " . $e->getMessage()]);
}
?>
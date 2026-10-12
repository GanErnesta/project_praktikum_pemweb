<?php
// Load koneksi database & header CORS
require_once '../../config/database.php';

// Ambil ID dari parameter URL (?id=...)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Validasi jika ID tidak dikirim atau tidak valid
if ($id <= 0) {
    http_response_code(400);
    echo json_encode([
        "status" => false, 
        "message" => "Parameter ID lomba tidak valid atau tidak ditemukan."
    ]);
    exit();
}

try {
    // Query mengambil detail lomba beserta kategori dan daftar skill terkait
    $sql = "
        SELECT 
            l.id,
            l.judul_lomba,
            l.nama_penyelenggara,
            l.penyelenggara,
            l.kategori_id,
            k.nama_kategori AS kategori,
            l.status,
            l.deadline,
            l.deskripsi,
            l.ukuran_tim,
            l.banner_img,
            l.created_at,
            GROUP_CONCAT(s.nama_skill SEPARATOR ', ') AS skills
        FROM lomba l
        JOIN kategori k ON l.kategori_id = k.id
        LEFT JOIN lomba_skill ls ON l.id = ls.lomba_id
        LEFT JOIN skill s ON ls.skill_id = s.id
        WHERE l.id = :id
        GROUP BY l.id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $lomba = $stmt->fetch();

    if ($lomba) {
        // Format string skills menjadi array JSON
        $lomba['skills'] = $lomba['skills'] ? explode(', ', $lomba['skills']) : [];
        
        // Tentukan warna status badge
        $lomba['status_class'] = ($lomba['status'] === 'Segera Tutup') ? 'status-warning' : 'status-success';

        http_response_code(200);
        echo json_encode([
            "status" => true,
            "data" => $lomba
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            "status" => false, 
            "message" => "Data lomba dengan ID $id tidak ditemukan."
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => false, 
        "message" => "Terjadi kesalahan pada server: " . $e->getMessage()
    ]);
}
?>
<?php
require_once '../../config/database.php';

try {
    // Ambil parameter dari JS (jika ada)
    $kategori     = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';
    $keyword      = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

    $sql = "SELECT l.*, k.nama_kategori, 
            GROUP_CONCAT(s.nama_skill SEPARATOR ', ') AS list_skill
            FROM lomba l
            LEFT JOIN kategori k ON l.kategori_id = k.id
            LEFT JOIN lomba_skill ls ON l.id = ls.lomba_id
            LEFT JOIN skill s ON ls.skill_id = s.id
            WHERE 1=1";

    $params = [];

    if ($kategori !== 'Semua' && !empty($kategori)) {
        $sql .= " AND k.nama_kategori = :kategori";
        $params[':kategori'] = $kategori;
    }

    if (!empty($keyword)) {
        $sql .= " AND (l.judul_lomba LIKE :kw OR l.nama_penyelenggara LIKE :kw OR s.nama_skill LIKE :kw)";
        $params[':kw'] = '%' . $keyword . '%';
    }

    $sql .= " GROUP BY l.id ORDER BY l.id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $lomba = $stmt->fetchAll();

    echo json_encode([
        'status' => true,
        'data' => $lomba
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ]);
}
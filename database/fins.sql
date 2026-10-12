-- Database Schema & Initial Data for FINS UB
CREATE DATABASE IF NOT EXISTS fins_ub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fins_ub;

-- 1. Tabel Kategori
CREATE TABLE IF NOT EXISTS kategori (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Perlombaan
CREATE TABLE IF NOT EXISTS lomba (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul_lomba VARCHAR(255) NOT NULL,
    penyelenggara ENUM('Universitas', 'Kementerian', 'Perusahaan Swasta', 'BUMN', 'Himpunan Mahasiswa', 'UKM Kampus', 'Lembaga Internasional') NOT NULL DEFAULT 'Universitas',
    nama_penyelenggara VARCHAR(255) NOT NULL,
    kategori_id INT UNSIGNED NOT NULL,
    status ENUM('Pendaftaran Buka', 'Segera Tutup', 'Pendaftaran Ditutup') NOT NULL DEFAULT 'Pendaftaran Buka',
    deadline DATE NOT NULL,
    deskripsi TEXT DEFAULT NULL,
    ukuran_tim TINYINT UNSIGNED DEFAULT 3,
    banner_img VARCHAR(255) DEFAULT 'default_banner.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE,
    INDEX idx_deadline (deadline),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Skill
CREATE TABLE IF NOT EXISTS skill (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_skill VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Pivot Lomba-Skill
CREATE TABLE IF NOT EXISTS lomba_skill (
    lomba_id INT UNSIGNED NOT NULL,
    skill_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (lomba_id, skill_id),
    FOREIGN KEY (lomba_id) REFERENCES lomba(id) ON DELETE CASCADE,
    FOREIGN KEY (skill_id) REFERENCES skill(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Dummy Initial
INSERT INTO kategori (id, nama_kategori) VALUES
(1, 'Robotic Cup'), (2, 'Hackathon'), (3, 'Essay'), (4, 'Business Plan'), 
(5, 'Teknologi dan AI'), (6, 'UI/UX & Desain'), (7, 'PKM Kemendikbud'), 
(8, 'Poster'), (9, 'Capture The Flag'), (10, 'Machine Learning');

INSERT INTO skill (id, nama_skill) VALUES
(1, 'Figma Mastery'), (2, 'Usability Testing'), (3, 'Design Thinking'), (4, 'Interactive Prototyping');

INSERT INTO lomba (id, judul_lomba, penyelenggara, nama_penyelenggara, kategori_id, status, deadline, deskripsi, ukuran_tim) VALUES
(1, 'Multimedia In Action 2026', 'Universitas', 'Universitas Pembangunan Veteran Jatim', 1, 'Segera Tutup', '2026-10-16', 'Perancangan pengalaman pengguna untuk memecahkan masalah digital lansia dan penyandang disabilitas...', 3),
(2, 'Multimedia In Action 2026', 'Universitas', 'Universitas Pembangunan Veteran Jatim', 1, 'Pendaftaran Buka', '2026-10-16', 'Perancangan pengalaman pengguna untuk memecahkan masalah digital lansia dan penyandang disabilitas...', 3),
(3, 'Multimedia In Action 2026', 'Universitas', 'Universitas Pembangunan Veteran Jatim', 2, 'Pendaftaran Buka', '2026-10-16', 'Perancangan pengalaman pengguna untuk memecahkan masalah digital lansia dan penyandang disabilitas...', 4),
(4, 'Multimedia In Action 2026', 'Universitas', 'Universitas Pembangunan Veteran Jatim', 3, 'Pendaftaran Buka', '2026-10-16', 'Perancangan pengalaman pengguna untuk memecahkan masalah digital lansia dan penyandang disabilitas...', 2),
(5, 'Multimedia In Action 2026', 'Universitas', 'Universitas Pembangunan Veteran Jatim', 4, 'Pendaftaran Buka', '2026-10-16', 'Perancangan pengalaman pengguna untuk memecahkan masalah digital lansia dan penyandang disabilitas...', 3),
(6, 'Multimedia In Action 2026', 'Universitas', 'Universitas Pembangunan Veteran Jatim', 5, 'Pendaftaran Buka', '2026-10-16', 'Perancangan pengalaman pengguna untuk memecahkan masalah digital lansia dan penyandang disabilitas...', 5);

INSERT INTO lomba_skill (lomba_id, skill_id) VALUES
(1,1),(1,2),(1,3),(1,4),
(2,1),(2,2),(2,3),(2,4),
(3,1),(3,2),(3,3),(3,4),
(4,1),(4,2),(4,3),(4,4),
(5,1),(5,2),(5,3),(5,4),
(6,1),(6,2),(6,3),(6,4);
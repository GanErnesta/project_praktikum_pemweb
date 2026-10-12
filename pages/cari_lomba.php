<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cari Lomba - FINS UB</title>
  <link rel="stylesheet" href="../css/cari_lomba.css">
</head>
<body>

  <!-- Topbar / Navbar -->
  <header class="topbar">
    <div class="brand">
      <img src="../assets/images/Group4.png" alt="Logo FINS" class="logo">
    </div>
    
    <nav class="nav-links">
      <a href="#">Beranda</a>
      <a href="#" class="active">Lomba</a>
      <a href="#">Cari Partner</a>
      <a href="#">Lomba Saya</a>
      <a href="#">Tim Saya</a>
    </nav>

    <div class="user-menu">
      <button class="btn-icon">💬</button>
      <button class="btn-icon">🔔</button>
      <div class="foto-profil">
        <img src="../assets/images/avatar.png" alt="User">
      </div>
    </div>
  </header>

  <div class="wrapper">
    <!-- Header Konten -->
    <div class="heading-box">
      <div class="heading-text">
        <span class="tagline">DIREKTORI KOMPETISI MAHASISWA</span>
        <h1>EKSPLORASI DAN TEMUKAN PERLOMBAAN</h1>
        <p class="subtext">
          Kumpulan ajang kompetisi resmi tingkat regional, nasional, dan internasional yang relevan bagi mahasiswa Universitas Brawijaya
        </p>
      </div>
  
  <div class="info-total">
    Menampilkan <span id="totalTampil">0</span> dari <span id="totalData">0</span> ajang lomba
  </div>
</div>

    <!-- Filter & Cari -->
    <div class="filter-box">
      <div class="row-utama">
        <div class="search-box">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="cariKeyword" placeholder="Cari nama lomba, topik riset, atau skil yang dibutuhkan...">
        </div>

        <select id="optDeadline" class="drop-filter">
          <option value="">Semua Deadline</option>
          <option value="7">7 Hari</option>
          <option value="14">14 Hari</option>
          <option value="30">30 Hari</option>
        </select>

        <select id="optPenyelenggara" class="drop-filter">
            <option value="">Semua Penyelenggara</option>
            <option value="Universitas">Universitas</option>
            <option value="Kementerian">Kementerian</option>
            <option value="Perusahaan Swasta">Perusahaan Swasta</option>
            <option value="BUMN">BUMN</option>
            <option value="Himpunan Mahasiswa">Himpunan Mahasiswa</option>
            <option value="UKM Kampus">UKM Kampus</option>
            <option value="Lembaga Internasional">Lembaga Internasional</option>
        </select>

        <select id="optTim" class="drop-filter">
            <option value="">Semua Ukuran Tim</option>
            <option value="1">1 Orang (Individu)</option>
            <option value="2">2 Orang</option>
            <option value="3">3 Orang</option>
            <option value="4">4 Orang</option>
            <option value="5">5 Orang</option>
            <option value="6">6 Orang</option>
            <option value="7">7 Orang</option>
            <option value="8">8 Orang</option>
            <option value="9">9 Orang</option>
            <option value="10">10 Orang</option>
        </select>
      </div>

      <div class="row-urutan">
        <select id="optUrutan" class="drop-filter drop-urut">
          <option value="terdekat">Urut : Deadline Terdekat</option>
          <option value="terbaru">Urut : Terbaru</option>
        </select>
      </div>

      <div class="kategori-container">
        <span class="label-kat">Kategori :</span>
        <div class="list-kat" id="listKategori">
          <button class="btn-kat active" data-kat="Semua">Semua</button>
          <button class="btn-kat" data-kat="Teknologi dan AI">Teknologi dan AI</button>
          <button class="btn-kat" data-kat="PKM Kemendikbud">PKM Kemendikbud</button>
          <button class="btn-kat" data-kat="Business Plan">Business Plan & Case</button>
          <button class="btn-kat" data-kat="UI/UX & Desain">UI/UX & Desain</button>
          <button class="btn-kat" data-kat="Essay">Essay</button>
          <button class="btn-kat" data-kat="Hackathon">Hackathon</button>
          <button class="btn-kat" data-kat="Poster">Poster</button>
          <button class="btn-kat" data-kat="Capture The Flag">Capture The Flag</button>
          <button class="btn-kat" data-kat="Machine Learning">Machine Learning</button>
        </div>
      </div>
    </div>

    <!-- Container Grid Tempat Menampilkan Cards Lomba (ID disamakan dengan JS: kontenLomba) -->
    <div id="kontenLomba" class="grid-lomba">
        <!-- Card lomba akan dimuat otomatis via JS -->
    </div>

  </div> <!-- Penutup .wrapper -->

  <script src="../js/cari_lomba.js"></script>
</body>
</html>
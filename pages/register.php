<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign Up - FINSBE</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --maroon:#8B0000;
  --cream:#FFF9F2;
  --field:#FFF1E0;
  --border:#A3162A;
  --ink:#111;
  --muted:#8a8a8a;
}
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--cream);color:var(--ink);min-height:832px}
.page{display:flex;min-height:100vh}

/* ===== PANEL KIRI ===== */
.left{position:relative;width:50.3%;min-height:832px;background:var(--maroon);color:#fff;overflow:hidden;flex-shrink:0}
.left::before{content:"";position:absolute;top:-60px;right:-150px;width:300px;height:176px;background:rgba(255,255,255,.35);border-radius:0 0 150px 150px;transform:rotate(-24deg)}
.logo{position:absolute;top:43px;left:40px;width:48px;height:47px;border-radius:10px;background:#FFF1E0;color:var(--maroon);display:grid;place-items:center;font-weight:700;font-size:30px;line-height:1}
.logo small{position:absolute;right:7px;bottom:5px;font-size:8px;font-weight:700}
.left-copy{position:absolute;left:40px;top:228px;width:540px}
.left-copy .eyebrow{font-size:15px;font-weight:400;margin-bottom:14px}
.left-copy h2{font-size:26px;line-height:1.2;font-weight:700;margin-bottom:12px}
.left-copy p{font-size:15px;line-height:1.3;font-weight:400}
.illus{position:absolute;left:28px;top:405px;width:420px;height:345px}
.left-foot{position:absolute;left:60px;bottom:38px;font-size:13px}
.left::after{content:"";position:absolute;left:-60px;bottom:-60px;width:213px;height:170px;border-radius:50%;background:rgba(255,255,255,.12)}

/* ===== PANEL KANAN ===== */
.right{flex:1;padding:70px 52px 40px 43px;background:var(--cream)}
.form-wrap{max-width:541px}
.right h1{font-size:36px;line-height:1.2;font-weight:700;color:var(--maroon);margin-bottom:12px}
.lead{font-size:20px;line-height:1.25;font-weight:400;margin-bottom:40px}
.step{display:none}
.step.active{display:block}
.step h3{font-size:24px;font-weight:700;color:var(--maroon);margin-bottom:8px}
label{display:block;font-size:18px;font-weight:400;margin-bottom:6px;color:var(--ink)}
.field{margin-bottom:20px}
input,select{
  width:100%;height:48px;border:1px solid var(--border);border-radius:10px;
  background:var(--field);padding:0 25px;font-family:inherit;font-size:14px;color:var(--ink);outline:none;
}
input::placeholder{color:#8c8c8c}
input:focus,select:focus{box-shadow:0 0 0 3px rgba(139,0,0,.18)}
select{appearance:none;-webkit-appearance:none;padding:0 40px 0 25px;color:#8c8c8c;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23111' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
  background-repeat:no-repeat;background-position:right 18px center}
select.filled{color:var(--ink)}
.row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.strength{display:grid;grid-template-columns:repeat(8,1fr);gap:4px;margin-top:6px}
.strength i{height:3px;border-radius:2px;background:#ddd;display:block}
.strength i.on{background:var(--maroon)}
.hint{font-size:14px;color:var(--muted);margin-top:6px}
.btn{
  width:100%;height:48px;border:0;border-radius:10px;background:var(--maroon);color:#fff;
  font-family:inherit;font-size:18px;font-weight:400;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:12px;
}
.btn:hover{background:#740000}
.btn:focus-visible{outline:3px solid rgba(139,0,0,.35);outline-offset:2px}
#s1 .btn{margin-top:38px}
#s2 .btn{margin-top:40px}
.signin{text-align:center;font-size:14px;color:#777;margin-top:8px}
.signin a{color:var(--maroon);text-decoration:none}
.error{color:#b00020;font-size:13px;margin-top:6px;display:none}
.error.show{display:block}

/* ===== RESPONSIF ===== */
@media (max-width:900px){
  .page{flex-direction:column}
  .left{width:100%;min-height:auto;padding:100px 24px 28px}
  .left-copy{position:static;width:auto}
  .illus,.left-foot,.left::after{display:none}
  .right{padding:32px 24px}
  .right h1{font-size:30px}
  .row{grid-template-columns:1fr}
}
</style>
</head>
<body>
<div class="page">

  <!-- KIRI -->
  <aside class="left">
    <div class="logo">F<small>UB</small></div>

    <div class="left-copy">
      <div class="eyebrow">TEMUKAN PELUANGMU</div>
      <h2>Cari lomba. Temukan partner. Bangun koneksi.</h2>
      <p>Satu tempat untuk menemukan peluang kompetisi dan mahasiswa dengan skill yang sesuai.</p>
    </div>

    <!-- Ilustrasi: ganti dengan <img src="ilustrasi.png"> bila punya aset aslinya -->
    <svg class="illus" viewBox="0 0 420 345" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <defs>
        <radialGradient id="glow" cx="50%" cy="50%" r="50%"><stop offset="0" stop-color="#fff" stop-opacity=".55"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></radialGradient>
      </defs>
      <circle cx="215" cy="150" r="140" fill="#F3E2DE"/>
      <g fill="#C98A8A" opacity=".85">
        <rect x="120" y="70" width="110" height="10"/><rect x="130" y="55" width="90" height="15"/><rect x="150" y="35" width="50" height="20"/>
        <rect x="95" y="95" width="160" height="50"/>
        <circle cx="250" cy="120" r="30"/><circle cx="85" cy="120" r="28"/><circle cx="285" cy="140" r="26"/>
      </g>
      <circle cx="60" cy="150" r="30" fill="#A94B4B" opacity=".7"/>
      <g stroke="#B26060" fill="none" stroke-width="1"><path d="M60 80 Q40 120 90 130"/><path d="M300 150 Q340 100 330 70"/></g>
      <circle cx="58" cy="82" r="7" fill="#fff" stroke="#B26060"/><circle cx="378" cy="85" r="7" fill="#C27A7A"/><circle cx="268" cy="262" r="6" fill="#8B0000"/>
      <!-- kartu piala -->
      <g transform="rotate(4 285 50)"><rect x="240" y="15" width="90" height="70" rx="10" fill="#FFF3E6"/>
        <path d="M262 30h24v14a12 12 0 0 1-24 0z" fill="#8B0000"/><rect x="270" y="56" width="8" height="8" fill="#8B0000"/><rect x="262" y="64" width="24" height="5" fill="#8B0000"/>
        <rect x="296" y="32" width="26" height="5" rx="2" fill="#D7A5A5"/><rect x="296" y="44" width="26" height="5" rx="2" fill="#D7A5A5"/><rect x="296" y="56" width="20" height="5" rx="2" fill="#D7A5A5"/></g>
      <!-- kartu tim -->
      <g transform="rotate(-4 65 270)"><rect x="18" y="238" width="80" height="66" rx="10" fill="#FFF3E6"/>
        <circle cx="58" cy="258" r="7" fill="#8B0000"/><circle cx="40" cy="262" r="6" fill="#8B0000"/><circle cx="76" cy="262" r="6" fill="#8B0000"/>
        <path d="M30 284a10 10 0 0 1 20-2a14 14 0 0 1 16 0a10 10 0 0 1 20 2z" fill="#8B0000"/>
        <rect x="30" y="290" width="48" height="4" rx="2" fill="#D7A5A5"/></g>
      <!-- kartu ide -->
      <g transform="rotate(4 360 270)"><rect x="330" y="215" width="62" height="85" rx="10" fill="#FFF3E6"/>
        <circle cx="361" cy="243" r="12" fill="#8B0000"/><rect x="356" y="255" width="10" height="6" fill="#8B0000"/>
        <rect x="342" y="272" width="38" height="5" rx="2" fill="#D7A5A5"/><rect x="342" y="284" width="30" height="5" rx="2" fill="#D7A5A5"/></g>
      <!-- tokoh -->
      <path d="M85 340 Q90 220 140 205 L220 205 Q270 225 280 340 Z" fill="#8B1A1F"/>
      <path d="M135 215 Q215 190 255 230 L250 300 L130 300 Z" fill="#A5232A"/>
      <path d="M165 205 L215 205 L225 250 L160 250 Z" fill="#FCEBE3"/>
      <circle cx="195" cy="170" r="30" fill="#F6D9C6"/>
      <path d="M163 165 Q165 125 205 128 Q235 132 228 160 Q215 140 190 150 Q175 155 168 175 Z" fill="#2B1A16"/>
      <path d="M118 225 L90 300 L130 300 Z" fill="#6E1218"/>
      <path d="M110 300 L255 275 L290 320 L135 345 Z" fill="#CDB8B8"/>
      <path d="M135 345 L255 330 L240 345 Z" fill="#3A2A2A"/>
    </svg>

    <div class="left-foot">FINS Universitas Brawijaya</div>
  </aside>

  <!-- KANAN -->
  <main class="right">
    <div class="form-wrap">
      <h1>Mari mulai perjalananmu FINSBE!!</h1>
      <p class="lead">Bergabung dengan FINS dan temukan koneksi yang bisa berkembang bersamamu.</p>

      <!-- LANGKAH 1 -->
      <form class="step active" id="s1" novalidate>
        <h3>Buat akun yaa!!</h3>

        <div class="field">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email UB kamu" autocomplete="email">
        </div>

        <div class="field">
          <label for="pw">Create Password</label>
          <input type="password" id="pw" placeholder="Buat password kamu minimal 8 karakter" autocomplete="new-password">
        </div>

        <div class="field" style="margin-bottom:0">
          <label for="pw2">Confirm Password</label>
          <input type="password" id="pw2" placeholder="Ulangi password kamu" autocomplete="new-password">
          <div class="strength" id="strength"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
          <p class="hint">Gunakan simbol, angka, dan karakter unik</p>
          <p class="error" id="err1"></p>
        </div>

        <button type="submit" class="btn">Sign Up</button>
        <p class="signin">Have an account? <a href="#">Sign in</a></p>
      </form>

      <!-- LANGKAH 2 -->
      <form class="step" id="s2" novalidate>
        <h3>Lengkapi data kamu!!</h3>

        <div class="field">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" placeholder="Nama Lengkap" autocomplete="name">
        </div>

        <div class="field">
          <label for="nim">NIM</label>
          <input type="text" id="nim" placeholder="NIM sesuai KTM" inputmode="numeric">
        </div>

        <div class="row">
          <div>
            <label for="fak">Fakultas</label>
            <select id="fak"><option value="" selected disabled hidden>Fakultas...</option></select>
          </div>
          <div>
            <label for="prodi">Program Studi</label>
            <select id="prodi"><option value="" selected disabled hidden>Program studi...</option></select>
          </div>
        </div>
        <p class="error" id="err2"></p>

        <button type="submit" class="btn">
          Next
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/></svg>
        </button>
      </form>
    </div>
  </main>
</div>

<script>
const $ = id => document.getElementById(id);

/* ---- Kekuatan password (8 segmen) ---- */
$('pw').addEventListener('input', e => {
  const v = e.target.value;
  let score = 0;
  if (v.length >= 8) score += 2;
  if (v.length >= 12) score += 1;
  if (/[a-z]/.test(v) && /[A-Z]/.test(v)) score += 2;
  if (/\d/.test(v)) score += 1;
  if (/[^A-Za-z0-9]/.test(v)) score += 2;
  [...$('strength').children].forEach((b, i) => b.classList.toggle('on', i < Math.min(score, 8)));
});

/* ---- Langkah 1 ---- */
$('s1').addEventListener('submit', e => {
  e.preventDefault();
  const err = $('err1'); let msg = '';
  if (!/^[^\s@]+@([a-z0-9-]+\.)*ub\.ac\.id$/i.test($('email').value.trim())) msg = 'Gunakan email UB kamu (@student.ub.ac.id).';
  else if ($('pw').value.length < 8) msg = 'Password minimal 8 karakter.';
  else if ($('pw').value !== $('pw2').value) msg = 'Konfirmasi password belum sama.';
  err.textContent = msg; err.classList.toggle('show', !!msg);
  if (msg) return;
  $('s1').classList.remove('active'); $('s2').classList.add('active');
});

/* ---- Data fakultas & prodi (sesuaikan) ---- */
const DATA = {
  'Ilmu Komputer (FILKOM)': ['Teknik Informatika','Sistem Informasi','Teknik Komputer','Teknologi Informasi','Pendidikan Teknologi Informasi'],
  'Teknik': ['Teknik Mesin','Teknik Elektro','Teknik Sipil','Arsitektur'],
  'Ekonomi dan Bisnis': ['Manajemen','Akuntansi','Ilmu Ekonomi'],
  'MIPA': ['Matematika','Fisika','Kimia','Biologi']
};
const fak = $('fak'), prodi = $('prodi');
Object.keys(DATA).forEach(k => fak.add(new Option(k, k)));
fak.addEventListener('change', () => {
  fak.classList.add('filled');
  prodi.length = 1; prodi.value = ''; prodi.classList.remove('filled');
  DATA[fak.value].forEach(p => prodi.add(new Option(p, p)));
});
prodi.addEventListener('change', () => prodi.classList.add('filled'));

/* ---- Langkah 2 ---- */
$('s2').addEventListener('submit', e => {
  e.preventDefault();
  const err = $('err2');
  const ok = $('nama').value.trim() && /^\d{10,15}$/.test($('nim').value.trim()) && fak.value && prodi.value;
  err.textContent = ok ? '' : 'Lengkapi nama, NIM sesuai KTM, fakultas, dan program studi.';
  err.classList.toggle('show', !ok);
  if (!ok) return;
  console.log({ email: $('email').value, nama: $('nama').value, nim: $('nim').value, fakultas: fak.value, prodi: prodi.value });
  // TODO: kirim ke backend
});
</script>
</body>
</html>
document.addEventListener('DOMContentLoaded', () => {
    let selectedKategori = 'Semua';

    // Elemen DOM Input & Filter
    const cariKeyword      = document.getElementById('cariKeyword');
    const optDeadline      = document.getElementById('optDeadline');
    const optPenyelenggara = document.getElementById('optPenyelenggara');
    const optTim           = document.getElementById('optTim');
    const optUrutan        = document.getElementById('optUrutan');
    const listKategori     = document.getElementById('listKategori');
    
    // Elemen DOM Status & Container
    const totalTampil = document.getElementById('totalTampil');
    const totalData   = document.getElementById('totalData');
    const kontenLomba = document.getElementById('kontenLomba');

    async function fetchLomba() {
        const keywordVal      = encodeURIComponent(cariKeyword ? cariKeyword.value : '');
        const deadlineVal     = encodeURIComponent(optDeadline ? optDeadline.value : '');
        const penyelenggaraVal = encodeURIComponent(optPenyelenggara ? optPenyelenggara.value : '');
        const timVal           = encodeURIComponent(optTim ? optTim.value : '');
        const urutanVal        = encodeURIComponent(optUrutan ? optUrutan.value : '');
        const kategoriVal      = encodeURIComponent(selectedKategori);

        if (kontenLomba) {
            kontenLomba.innerHTML = `<div class="loading-state py-8 text-center text-gray-500">Memuat data perlombaan...</div>`;
        }

        try {
            const url = `../php/lomba/cari.php?keyword=${keywordVal}&deadline=${deadlineVal}&penyelenggara=${penyelenggaraVal}&tim=${timVal}&urutan=${urutanVal}&kategori=${kategoriVal}`;  
            const response = await fetch(url);
            const res = await response.json();

            if (res.status && res.data) {
                // Update counter total jika elemennya ada di HTML
                if (totalTampil) totalTampil.textContent = res.data.length;
                if (totalData) totalData.textContent = res.total_data || res.data.length;

                renderCards(res.data);
            } else {
                if (kontenLomba) {
                    kontenLomba.innerHTML = `<div class="empty-state py-8 text-center text-gray-500">Perlombaan tidak ditemukan.</div>`;
                }
            }

        } catch (error) {
            console.error('Error fetching data:', error);
            if (kontenLomba) {
                kontenLomba.innerHTML = `<div class="empty-state py-8 text-center text-red-500">Gagal memuat data dari server.</div>`;
            }
        }
    }

    function renderCards(lombaList) {
        if (!kontenLomba) return;
        kontenLomba.innerHTML = '';

        if (!lombaList || lombaList.length === 0) {
            kontenLomba.innerHTML = `<div class="empty-state py-8 text-center text-gray-500">Perlombaan tidak ditemukan.</div>`;
            return;
        }

        lombaList.forEach(item => {
            // Processing skill (Ubah dari string 'Figma, Design Thinking' menjadi Array Badges)
            const skillArray = item.list_skill ? item.list_skill.split(', ') : [];
            const skillChips = skillArray.map(s => `<span class="chip-skill">${s}</span>`).join('');

            // Tentukan style badge status
            const statusClass = item.status === 'Pendaftaran Buka' ? 'badge-buka' : 'badge-tutup';

            const cardHTML = `
                <div class="card-lomba">
                    <div class="card-banner">
                        <img src="../assets/images/${item.banner_img || 'default_banner.jpg'}" alt="${item.judul_lomba}">
                        <div class="badge-container">
                            <span class="badge badge-kat">${item.nama_kategori || 'Umum'}</span>
                            <span class="badge ${statusClass}">${item.status}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="univ-tag">${item.nama_penyelenggara}</span>
                        <h3 class="judul-lomba">${item.judul_lomba}</h3>
                        <div class="info-deadline">
                            📅 Deadline : ${item.deadline}
                        </div>
                        <p class="deskripsi-lomba">${item.deskripsi || ''}</p>
                        
                        <div class="section-skill-title">SKILL YANG RELEVAN :</div>
                        <div class="list-skills">
                            ${skillChips}
                        </div>
                        
                        <a href="detail_lomba.php?id=${item.id}" class="btn-detail">Lihat Detail</a>
                    </div>
                </div>
            `;
            kontenLomba.insertAdjacentHTML('beforeend', cardHTML);
        });
    }

    // Event Listener Search (Debounce)
    if (cariKeyword) {
        let debounceTimer;
        cariKeyword.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(fetchLomba, 300);
        });
    }

    // Event Listener Select Filter Dropdowns
    [optDeadline, optPenyelenggara, optTim, optUrutan].forEach(filterSelect => {
        if (filterSelect) {
            filterSelect.addEventListener('change', fetchLomba);
        }
    });

    // Event Listener Filter Kategori Buttons
    if (listKategori) {
        listKategori.addEventListener('click', (e) => {
            const targetBtn = e.target.closest('.btn-kat');
            if (targetBtn) {
                const allBtns = listKategori.querySelectorAll('.btn-kat');
                allBtns.forEach(btn => btn.classList.remove('active'));

                targetBtn.classList.add('active');
                selectedKategori = targetBtn.getAttribute('data-kat') || targetBtn.innerText.trim();

                fetchLomba();
            }
        });
    }

    // Load Data Pertama Kali
    fetchLomba();
});
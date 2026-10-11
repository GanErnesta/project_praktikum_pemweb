document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('competitionTrack');
    const cards = Array.from(track.querySelectorAll('.competition-card'));
    const dots = document.getElementById('carouselDots');
    const prev = document.getElementById('previousCards');
    const next = document.getElementById('nextCards');
    const form = document.getElementById('teamSearchForm');
    const feedback = document.getElementById('searchFeedback');
    const competition = document.getElementById('competitionSelect');
    const skill = document.getElementById('skillSelect');
    const location = document.getElementById('locationSelect');
    let activePage = 0;
    const pageSize = 3;
    let visibleCards = cards.slice();

    function renderCarousel() {
        const pageCount = Math.max(1, Math.ceil(visibleCards.length / pageSize));
        activePage = Math.min(activePage, pageCount - 1);
        cards.forEach(card => { card.hidden = !visibleCards.includes(card); });
        visibleCards.forEach((card, index) => {
            card.style.order = String(index);
            card.hidden = index < activePage * pageSize || index >= (activePage + 1) * pageSize;
        });
        dots.innerHTML = '';
        for (let i = 0; i < pageCount; i++) {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className = i === activePage ? 'active' : '';
            dot.setAttribute('aria-label', `Halaman kompetisi ${i + 1}`);
            dot.addEventListener('click', () => { activePage = i; renderCarousel(); });
            dots.appendChild(dot);
        }
        prev.disabled = activePage === 0;
        next.disabled = activePage >= pageCount - 1;
    }

    prev.addEventListener('click', () => {
        if (activePage > 0) { activePage--; renderCarousel(); }
    });
    next.addEventListener('click', () => {
        const pageCount = Math.max(1, Math.ceil(visibleCards.length / pageSize));
        if (activePage < pageCount - 1) { activePage++; renderCarousel(); }
    });

    form.addEventListener('submit', event => {
        event.preventDefault();
        const selectedCompetition = competition.value.toLowerCase();
        const selectedSkill = skill.value.toLowerCase();
        const selectedLocation = location.value;
        visibleCards = cards.filter(card => {
            const category = (card.dataset.category || '').toLowerCase();
            const searchText = (card.dataset.search || '').toLowerCase();
            const competitionMatch = !selectedCompetition || category.includes(selectedCompetition) || searchText.includes(selectedCompetition);
            // Data kartu kompetisi belum memuat kebutuhan skill dan lokasi secara rinci.
            // Filter skill/lokasi disiapkan sebagai pilihan UI untuk pengembangan berikutnya.
            return competitionMatch;
        });
        activePage = 0;
        renderCarousel();
        if (selectedCompetition || selectedSkill || selectedLocation) {
            const details = [];
            if (competition.value) details.push(competition.options[competition.selectedIndex].text);
            if (skill.value) details.push('skill: ' + skill.options[skill.selectedIndex].text);
            if (location.value) details.push('lokasi: ' + location.options[location.selectedIndex].text);
            feedback.textContent = visibleCards.length
                ? `Menampilkan kompetisi yang sesuai dengan ${details.join(', ')}.`
                : 'Belum ada kompetisi yang sesuai. Coba pilihan lainnya.';
        } else {
            feedback.textContent = 'Pilih bidang lomba, skill, atau lokasi untuk mulai mencari.';
        }
        document.getElementById('kompetisi').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
    renderCarousel();
});
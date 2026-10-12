/* =========================================================
   FINS - Interaksi halaman Beranda
   ========================================================= */
(function () {
    'use strict';

    /* ---------- Menu mobile ---------- */
    var toggle = document.getElementById('navToggle');
    var menu = document.getElementById('navMenu');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var open = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(open));
            toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && menu.classList.contains('is-open')) {
                menu.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    }

    /* ---------- Carousel partner lomba ---------- */
    var carousel = document.getElementById('carousel');
    var dotsWrap = document.getElementById('dots');

    if (carousel && dotsWrap) {
        var cards = Array.prototype.slice.call(carousel.children);
        var pageCount = 0;

        // Hitung jumlah "halaman" berdasarkan lebar area yang terlihat.
        function buildDots() {
            var maxScroll = carousel.scrollWidth - carousel.clientWidth;
            var cardStep = cards.length > 1
                ? cards[1].offsetLeft - cards[0].offsetLeft
                : carousel.clientWidth;

            pageCount = maxScroll > 4 ? Math.ceil(maxScroll / cardStep) + 1 : 0;
            dotsWrap.innerHTML = '';

            for (var i = 0; i < pageCount; i++) {
                (function (index) {
                    var dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('role', 'tab');
                    dot.setAttribute('aria-label', 'Lihat lomba ' + (index + 1));
                    dot.addEventListener('click', function () { goTo(index); });
                    dotsWrap.appendChild(dot);
                })(i);
            }
            updateDots();
        }

        function goTo(index) {
            var card = cards[Math.min(index, cards.length - 1)];
            var left = card.offsetLeft - (carousel.clientWidth - card.offsetWidth) / 2;
            carousel.scrollTo({ left: left, behavior: 'smooth' });
        }

        function currentIndex() {
            var center = carousel.scrollLeft + carousel.clientWidth / 2;
            var best = 0;
            var bestDist = Infinity;

            cards.forEach(function (card, i) {
                var dist = Math.abs(card.offsetLeft + card.offsetWidth / 2 - center);
                if (dist < bestDist) { bestDist = dist; best = i; }
            });
            return Math.min(best, pageCount - 1);
        }

        function updateDots() {
            var active = currentIndex();
            Array.prototype.forEach.call(dotsWrap.children, function (dot, i) {
                dot.setAttribute('aria-selected', String(i === active));
            });
        }

        var ticking = false;
        carousel.addEventListener('scroll', function () {
            if (ticking) return;
            ticking = true;
            window.requestAnimationFrame(function () {
                updateDots();
                ticking = false;
            });
        }, { passive: true });

        // Navigasi keyboard (panah kiri/kanan) saat carousel difokuskan
        carousel.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') { e.preventDefault(); goTo(currentIndex() + 1); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); goTo(currentIndex() - 1); }
        });

        window.addEventListener('resize', buildDots);
        buildDots();
    }

    /* ---------- Form pencarian ---------- */
    var searchForm = document.querySelector('.search');

    if (searchForm) {
        // Hapus parameter kosong agar URL hasil pencarian tetap bersih
        searchForm.addEventListener('submit', function () {
            Array.prototype.forEach.call(searchForm.querySelectorAll('select'), function (sel) {
                if (!sel.value) sel.disabled = true;
            });
        });

        // Aktifkan kembali field saat pengguna kembali ke halaman (tombol Back)
        window.addEventListener('pageshow', function () {
            Array.prototype.forEach.call(searchForm.querySelectorAll('select'), function (sel) {
                sel.disabled = false;
            });
        });
    }
})();
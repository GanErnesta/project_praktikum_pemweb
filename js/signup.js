document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#signupForm');
    const nimInput = document.querySelector('#nim');
    const passwordInput = document.querySelector('#password');
    const meter = document.querySelector('.password-meter');

    if (nimInput) {
        nimInput.addEventListener('input', () => {
            nimInput.value = nimInput.value.replace(/\D/g, '').slice(0, 15);
        });
    }

    document.querySelectorAll('.toggle-password').forEach((button) => {
        button.addEventListener('click', () => {
            const target = document.getElementById(button.dataset.target);
            if (!target) return;
            const show = target.type === 'password';
            target.type = show ? 'text' : 'password';
            button.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });

    if (passwordInput && meter) {
        passwordInput.addEventListener('input', () => {
            const value = passwordInput.value;
            let score = 0;
            if (value.length >= 8) score++;
            if (/[A-Z]/.test(value)) score++;
            if (/[a-z]/.test(value)) score++;
            if (/\d/.test(value)) score++;
            if (/[^A-Za-z0-9]/.test(value)) score++;
            if (value.length >= 12) score++;
            meter.querySelectorAll('span').forEach((segment, index) => {
                segment.classList.toggle('active', index < score);
            });
        });
    }

    if (form) {
        form.addEventListener('submit', (event) => {
            const step = form.querySelector('input[name="step"]')?.value;

            if (step === '1') {
                const nama = form.querySelector('#nama')?.value.trim() ?? '';
                const nim = form.querySelector('#nim')?.value.trim() ?? '';
                const fakultas = form.querySelector('#fakultas')?.value ?? '';
                const prodi = form.querySelector('#prodi')?.value ?? '';

                if (!nama || !nim || !fakultas || !prodi) {
                    event.preventDefault();
                    alert('Lengkapi semua data diri terlebih dahulu.');
                    return;
                }
                if (!/^\d{10,15}$/.test(nim)) {
                    event.preventDefault();
                    alert('NIM harus terdiri dari 10–15 angka.');
                }
            }

            if (step === '2') {
                const email = form.querySelector('#email')?.value.trim() ?? '';
                const password = form.querySelector('#password')?.value ?? '';
                const confirm = form.querySelector('#confirmPassword')?.value ?? '';

                if (!email.endsWith('@student.ub.ac.id')) {
                    event.preventDefault();
                    alert('Gunakan email mahasiswa UB (@student.ub.ac.id).');
                    return;
                }
                if (password.length < 8) {
                    event.preventDefault();
                    alert('Password minimal 8 karakter.');
                    return;
                }
                if (password !== confirm) {
                    event.preventDefault();
                    alert('Konfirmasi password tidak sesuai.');
                }
            }
        });
    }
});

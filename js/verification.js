document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#verificationForm');
    const digits = Array.from(document.querySelectorAll('.otp-digit'));
    const hiddenOtp = document.querySelector('#otpValue');
    const verifyButton = document.querySelector('#verifyButton');
    const resendButton = document.querySelector('#resendButton');
    const countdown = document.querySelector('#countdown');

    const syncOtp = () => {
        if (hiddenOtp) hiddenOtp.value = digits.map((input) => input.value).join('');
    };

    digits.forEach((input, index) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '').slice(-1);
            syncOtp();
            if (input.value && index < digits.length - 1) digits[index + 1].focus();
        });

        input.addEventListener('keydown', (event) => {
            if (event.key === 'Backspace' && !input.value && index > 0) {
                digits[index - 1].focus();
            }
            if (event.key === 'ArrowLeft' && index > 0) digits[index - 1].focus();
            if (event.key === 'ArrowRight' && index < digits.length - 1) digits[index + 1].focus();
        });

        input.addEventListener('paste', (event) => {
            const pasted = (event.clipboardData || window.clipboardData).getData('text');
            const numbers = pasted.replace(/\D/g, '').slice(0, 6).split('');
            if (!numbers.length) return;
            event.preventDefault();
            digits.forEach((digit, i) => digit.value = numbers[i] || '');
            syncOtp();
            digits[Math.min(numbers.length, digits.length) - 1]?.focus();
        });
    });

    if (form) {
        form.addEventListener('submit', (event) => {
            const submitter = event.submitter;
            if (submitter && submitter.name === 'resend') return;

            syncOtp();
            if (!hiddenOtp.value || hiddenOtp.value.length !== 6) {
                event.preventDefault();
                alert('Masukkan semua 6 digit kode verifikasi.');
                digits.find((input) => !input.value)?.focus();
                return;
            }
            if (verifyButton) {
                verifyButton.disabled = true;
                verifyButton.textContent = 'Memeriksa kode...';
            }
        });
    }

    if (resendButton && countdown) {
        let remaining = 58;
        const updateCountdown = () => {
            const minutes = String(Math.floor(remaining / 60)).padStart(2, '0');
            const seconds = String(remaining % 60).padStart(2, '0');
            countdown.textContent = `${minutes}:${seconds}`;

            if (remaining <= 0) {
                resendButton.disabled = false;
                resendButton.textContent = 'Kirim ulang kode';
                return;
            }
            remaining -= 1;
            window.setTimeout(updateCountdown, 1000);
        };
        updateCountdown();
    }
});

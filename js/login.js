
const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

const nimInput = document.getElementById("nim");

if (nimInput) {
    nimInput.addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
    });
}

if (passwordInput && togglePassword) {
    togglePassword.addEventListener("click", function () {
        const isHidden = passwordInput.type === "password";

        passwordInput.type = isHidden ? "text" : "password";

        togglePassword.innerHTML = isHidden
            ? `<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                 <path d="M3 3l18 18"/>
                 <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                 <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c5 0 8.5 4.5 9 7-.2 1.2-1.1 2.7-2.5 4"/>
                 <path d="M6.2 6.2C3.8 7.8 2.3 10.2 2 12c.5 2.5 4 7 10 7 1 0 2-.2 2.9-.5"/>
               </svg>`
            : `<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                 <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/>
                 <circle cx="12" cy="12" r="3"/>
               </svg>`;

        togglePassword.setAttribute(
            "aria-label",
            isHidden ? "Sembunyikan password" : "Tampilkan password"
        );
    });
}
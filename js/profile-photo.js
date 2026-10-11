document.addEventListener('DOMContentLoaded', () => {
    const photoInput = document.getElementById('profilePhotoInput');
    const removeButton = document.getElementById('removePhotoButton');
    const profileAvatar = document.getElementById('profileAvatar');
    const modalAvatar = document.getElementById('modalAvatar');
    const navbarAvatar = document.querySelector('.fins-nav-avatar img');
    const formMessage = document.getElementById('profileFormMessage');

    const setMessage = (message, isError = false) => {
        if (!formMessage) return;
        formMessage.textContent = message;
        formMessage.style.color = isError ? '#b00020' : '#287a42';
    };

    const renderPhoto = (photoUrl) => {
        const versionedUrl = photoUrl ? `${photoUrl}${photoUrl.includes('?') ? '&' : '?'}t=${Date.now()}` : null;

        if (profileAvatar) {
            profileAvatar.innerHTML = versionedUrl
                ? `<img class="profile-photo-image" src="${versionedUrl}" alt="Foto profil">`
                : '<span>SG</span>';
        }

        if (modalAvatar) {
            modalAvatar.innerHTML = versionedUrl
                ? `<img class="profile-photo-image" src="${versionedUrl}" alt="Foto profil">`
                : 'SG';
        }

        if (navbarAvatar) {
            navbarAvatar.src = versionedUrl || '../assets/images/Group4.png';
            navbarAvatar.alt = versionedUrl ? 'Foto profil' : 'Logo FINS';
        }
    };

    const sendPhotoAction = async (action, file = null) => {
        const data = new FormData();
        data.append('profile_photo_action', action);
        if (file) data.append('profile_photo', file);

        const response = await fetch(window.location.href, {
            method: 'POST',
            body: data,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        let result;
        try {
            result = await response.json();
        } catch {
            throw new Error('Respons server tidak valid. Pastikan PHP berjalan melalui XAMPP.');
        }

        if (!response.ok || !result.success) {
            throw new Error(result.message || 'Terjadi kesalahan saat memproses foto.');
        }
        return result;
    };

    if (photoInput) {
        photoInput.addEventListener('change', async () => {
            const file = photoInput.files && photoInput.files[0];
            if (!file) return;

            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                setMessage('Pilih foto JPG, PNG, atau WEBP.', true);
                photoInput.value = '';
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                setMessage('Ukuran foto maksimal 5 MB.', true);
                photoInput.value = '';
                return;
            }

            const previousLabel = document.querySelector('.fins-upload-button')?.textContent;
            const uploadLabel = document.querySelector('.fins-upload-button');
            if (uploadLabel) uploadLabel.textContent = 'Mengunggah foto...';
            if (removeButton) removeButton.disabled = true;
            setMessage('Sedang menyimpan foto ke folder lokal...');

            try {
                const result = await sendPhotoAction('upload', file);
                renderPhoto(result.photoUrl);
                setMessage(result.message);
            } catch (error) {
                setMessage(error.message || 'Foto gagal diunggah.', true);
            } finally {
                if (uploadLabel) uploadLabel.textContent = previousLabel || '♧ Unggah Foto Baru';
                if (removeButton) removeButton.disabled = false;
                photoInput.value = '';
            }
        });
    }

    if (removeButton) {
        removeButton.addEventListener('click', async () => {
            if (!window.confirm('Yakin ingin menghapus foto profil?')) return;

            removeButton.disabled = true;
            setMessage('Menghapus foto...');
            try {
                const result = await sendPhotoAction('remove');
                renderPhoto(null);
                setMessage(result.message);
            } catch (error) {
                setMessage(error.message || 'Foto gagal dihapus.', true);
            } finally {
                removeButton.disabled = false;
            }
        });
    }
});

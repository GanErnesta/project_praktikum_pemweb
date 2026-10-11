document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('editProfileModal');
  const openButton = document.getElementById('openEditProfile');
  const cancelButton = document.getElementById('cancelEditProfile');
  const form = document.getElementById('editProfileForm');
  const message = document.getElementById('profileFormMessage');
  const photoInput = document.getElementById('profilePhotoInput');
  const removePhotoButton = document.getElementById('removePhotoButton');
  const selectedSkills = document.getElementById('selectedSkills');
  const addSkillButton = document.getElementById('addSkillButton');
  const skillDropdown = document.getElementById('skillDropdown');
  const skillSearchInput = document.getElementById('skillSearchInput');
  const skillOptions = document.getElementById('skillOptions');
  const dropdownSkillCount = document.getElementById('dropdownSkillCount');
  const skillEmptyState = document.getElementById('skillEmptyState');
  const skillHint = document.getElementById('skillHint');

  let skills = Array.from(selectedSkills.querySelectorAll('[data-skill]')).map(el => el.dataset.skill);
  let photoDataUrl = '';
  const defaultSkills = [...skills];

  const openModal = () => {
    message.textContent = '';
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('fins-modal-open');
    setTimeout(() => document.getElementById('editFullname').focus(), 40);
  };

  const closeModal = () => {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('fins-modal-open');
    openButton.focus();
  };

  openButton.addEventListener('click', openModal);
  cancelButton.addEventListener('click', closeModal);

  modal.addEventListener('click', event => {
    if (event.target === modal) closeModal();
  });

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
  });

  function updateAvatarMarkup(target, initials) {
    target.innerHTML = '';
    if (photoDataUrl) {
      const img = document.createElement('img');
      img.src = photoDataUrl;
      img.alt = 'Foto profil';
      target.appendChild(img);
    } else {
      target.textContent = initials;
    }
  }

  function initialsFromName(name) {
    return name.trim().split(/\s+/).slice(0, 2).map(part => part.charAt(0).toUpperCase()).join('') || 'SG';
  }

  photoInput.addEventListener('change', () => {
    const file = photoInput.files && photoInput.files[0];
    if (!file) return;
    if (!file.type.startsWith('image/')) {
      message.textContent = 'Pilih file gambar yang valid.';
      return;
    }
    if (file.size > 3 * 1024 * 1024) {
      message.textContent = 'Ukuran foto maksimal 3 MB.';
      photoInput.value = '';
      return;
    }
    const reader = new FileReader();
    reader.onload = () => {
      photoDataUrl = reader.result;
      updateAvatarMarkup(document.getElementById('modalAvatar'), initialsFromName(document.getElementById('editFullname').value));
      message.textContent = '';
    };
    reader.readAsDataURL(file);
  });

  removePhotoButton.addEventListener('click', () => {
    photoDataUrl = '';
    photoInput.value = '';
    updateAvatarMarkup(document.getElementById('modalAvatar'), initialsFromName(document.getElementById('editFullname').value));
  });

  function renderSkills() {
    selectedSkills.innerHTML = '';
    skills.forEach(skill => {
      const chip = document.createElement('span');
      chip.className = 'fins-edit-skill-chip';
      chip.dataset.skill = skill;
      chip.append(document.createTextNode('• ' + skill + ' '));
      const remove = document.createElement('button');
      remove.type = 'button';
      remove.textContent = '×';
      remove.setAttribute('aria-label', 'Hapus ' + skill);
      remove.dataset.removeSkill = skill;
      chip.appendChild(remove);
      selectedSkills.appendChild(chip);
    });

    document.getElementById('skillsCount').textContent = skills.length + ' Terpasang';
    document.getElementById('statSkills').textContent = skills.length;
    dropdownSkillCount.textContent = skills.length + ' Dipilih';
    skillHint.textContent = `Skill terpilih: ${skills.length}. Pilih 3 sampai 6 keahlian.`;
    skillHint.classList.toggle('is-error', skills.length < 3 || skills.length > 6);

    skillOptions.querySelectorAll('[data-skill-option]').forEach(option => {
      const skill = option.dataset.skillOption;
      const selected = skills.some(item => item.toLowerCase() === skill.toLowerCase());
      option.classList.toggle('is-selected', selected);
      option.setAttribute('aria-pressed', selected ? 'true' : 'false');
      option.querySelector('i').textContent = selected ? '✓' : '＋';
      option.disabled = !selected && skills.length >= 6;
    });
  }

  function filterSkillOptions() {
    const query = skillSearchInput.value.trim().toLowerCase();
    let visibleCount = 0;
    skillOptions.querySelectorAll('[data-skill-option]').forEach(option => {
      const matches = option.dataset.skillOption.toLowerCase().includes(query);
      option.hidden = !matches;
      if (matches) visibleCount++;
    });
    skillEmptyState.hidden = visibleCount > 0;
  }

  addSkillButton.addEventListener('click', () => {
    const willOpen = skillDropdown.hidden;
    skillDropdown.hidden = !willOpen;
    addSkillButton.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
    if (willOpen) {
      renderSkills();
      filterSkillOptions();
      skillSearchInput.focus();
    }
  });

  skillSearchInput.addEventListener('input', filterSkillOptions);

  skillOptions.addEventListener('click', event => {
    const option = event.target.closest('[data-skill-option]');
    if (!option) return;
    const skill = option.dataset.skillOption;
    const existingIndex = skills.findIndex(item => item.toLowerCase() === skill.toLowerCase());

    if (existingIndex >= 0) {
      skills.splice(existingIndex, 1);
    } else {
      if (skills.length >= 6) {
        skillHint.textContent = 'Maksimal 6 skill. Hapus salah satu skill terlebih dahulu.';
        skillHint.classList.add('is-error');
        return;
      }
      skills.push(skill);
    }
    renderSkills();
  });

  selectedSkills.addEventListener('click', event => {
    const button = event.target.closest('[data-remove-skill]');
    if (!button) return;
    skills = skills.filter(skill => skill !== button.dataset.removeSkill);
    renderSkills();
  });

  form.addEventListener('submit', event => {
    event.preventDefault();
    const fullname = document.getElementById('editFullname').value.trim();
    const username = document.getElementById('editUsername').value.trim();
    const faculty = document.getElementById('editFaculty').value;
    const studyProgram = document.getElementById('editStudyProgram').value;
    const bio = document.getElementById('editBio').value.trim();

    if (!fullname || !username || !faculty || !studyProgram) {
      message.style.color = '#b00020';
      message.textContent = 'Mohon lengkapi semua data wajib.';
      return;
    }
    if (skills.length < 3 || skills.length > 6) {
      skillHint.textContent = 'Profil harus memiliki 3 sampai 6 skill.';
      skillHint.classList.add('is-error');
      return;
    }

    document.getElementById('profileName').textContent = fullname;
    document.getElementById('profileStudyProgram').textContent = studyProgram;
    document.getElementById('profileBio').textContent = '“' + (bio || 'Belum ada bio.') + '”';
    document.getElementById('profileInstagram').textContent = document.getElementById('profileInstagram').textContent || '@instagram';
    document.getElementById('profileSkills').innerHTML = '';
    skills.forEach(skill => {
      const chip = document.createElement('span');
      chip.className = 'fins-skill-chip';
      chip.textContent = '• ' + skill;
      document.getElementById('profileSkills').appendChild(chip);
    });
    updateAvatarMarkup(document.getElementById('profileAvatar'), initialsFromName(fullname));
    updateAvatarMarkup(document.getElementById('modalAvatar'), initialsFromName(fullname));

    message.style.color = '#237b37';
    message.textContent = 'Perubahan berhasil diterapkan pada tampilan.';
    setTimeout(closeModal, 800);
  });

  renderSkills();
});

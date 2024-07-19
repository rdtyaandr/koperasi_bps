function showPasswordFields() {
    const passwordLabel = document.querySelector('label[for="password"]');
    const passwordInput = document.getElementById('password');
    const newPasswordFields = document.getElementById('newPasswordFields');

    passwordLabel.innerText = 'Masukkan password lama';
    passwordInput.placeholder = 'Ketik password lama anda disini';
    newPasswordFields.style.display = 'block';
    setTimeout(() => {
        newPasswordFields.style.opacity = 1;
    }, 10);
}

function resetPasswordFields() {
    if (isFormInvalid()) {
        showPasswordFields();
        return; // Jangan menyembunyikan jika ada error pada form
    }
    
    const passwordLabel = document.querySelector('label[for="password"]');
    const passwordInput = document.getElementById('password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmNewPasswordInput = document.getElementById('confirm_password');
    const newPasswordFields = document.getElementById('newPasswordFields');

    // Cek apakah salah satu dari input password sedang dalam fokus
    if (document.activeElement === passwordInput || 
        document.activeElement === newPasswordInput ||
        document.activeElement === confirmNewPasswordInput) {
        return; // Jangan menyembunyikan jika salah satu input password sedang dalam fokus
    }

    // Cek apakah ada nilai yang sudah diisi di input password baru atau konfirmasi password baru
    if (passwordInput.value.trim() !== '' || 
        newPasswordInput.value.trim() !== '' || 
        confirmNewPasswordInput.value.trim() !== '') {
        return; // Jangan menyembunyikan jika ada nilai yang sudah diisi
    }

    passwordLabel.innerText = 'Password';
    passwordInput.placeholder = 'Kosongkan jika tidak ingin mengubah password';
    newPasswordFields.style.opacity = 0;
    setTimeout(() => {
        newPasswordFields.style.display = 'none';
    }, 300);
}

function isFormInvalid() {
    return document.querySelector('.is-invalid') !== null;
}

document.addEventListener('click', function(event) {
    const form = document.querySelector('.card-body');

    // Jika yang diklik bukan bagian dari form atau input password, reset fields
    if (!form.contains(event.target) && event.target.id !== 'password') {
        resetPasswordFields();
    }
});

document.getElementById('password').addEventListener('focus', showPasswordFields);
document.getElementById('new_password').addEventListener('focus', showPasswordFields);
document.getElementById('confirm_password').addEventListener('focus', showPasswordFields);

// Panggil fungsi untuk menampilkan password fields jika ada form error
if (isFormInvalid()) {
    showPasswordFields();
}
if (!isFormInvalid()) {
    resetPasswordFields();
}

// function updateFileName(input) {
//     var fileName = input.files[0].name;
//     var label = document.getElementById('customFileLabel');
//     label.textContent = fileName;
// }
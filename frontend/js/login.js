function isValidPhone(phone) {
    return /^\d{10}$/.test(phone);
}

function checkLogin() {
    const countryCode = document.getElementById('countryCode').value;
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const errorMessage = document.getElementById('errorMessage');

    const fullPhone = countryCode + phone.value;

    [phone, password].forEach(input => input.style.border = '1px solid white');
    errorMessage.style.display = 'none';

    if (!isValidPhone(phone.value)) {
        phone.style.border = '2px solid red';
        errorMessage.innerText = 'Enter a valid 10-digit phone number.';
        errorMessage.style.display = 'block';
        return;
    }

    if (password.value.length < 6) {
        password.style.border = '2px solid red';
        errorMessage.innerText = 'Password must be at least 6 characters.';
        errorMessage.style.display = 'block';
        return;
    }

    alert('Login successful! Redirecting...');

    phone.value = '';
    password.value = '';
    window.location.href = 'dashboard.html'; 
}

document.addEventListener("DOMContentLoaded", () => {
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', () => {
            phoneInput.value = phoneInput.value.replace(/\D/g, '');
            if (phoneInput.value.length > 10) {
                phoneInput.value = phoneInput.value.slice(0, 10);
            }
        });
    }
});
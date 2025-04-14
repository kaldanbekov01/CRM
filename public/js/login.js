async function checkLogin() {
    const countryCode = document.getElementById('countryCode').value;
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const errorMessage = document.getElementById('errorMessage');

    const fullPhone = countryCode + phone.value;

    phone.style.border = '1px solid white';
    errorMessage.style.display = 'none';

    try {
        const response = await fetch('/api/check-login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ phone: fullPhone, password: password.value })
        });

        const result = await response.json();

        if (result.success) {
            phone.style.border = '2px solid green';
            alert('Login successful!');
        } else {
            phone.style.border = '2px solid red';
            errorMessage.style.display = 'block';
        }
    } catch (error) {
        console.error('Login request failed', error);
        errorMessage.innerText = 'Something went wrong. Try again later.';
        errorMessage.style.display = 'block';
        phone.style.border = '2px solid red';
    }
}
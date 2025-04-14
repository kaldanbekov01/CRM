function validatePasswordRules(password) {
    const rules = {
        lower: /[a-z]/.test(password),
        upper: /[A-Z]/.test(password),
        number: /\d/.test(password),
        special: /[^A-Za-z0-9]/.test(password),
        length: password.length >= 8
    };

    for (const key in rules) {
        const element = document.getElementById(`rule-${key}`);
        if (element) {
            element.style.color = rules[key] ? 'green' : 'gray';
        }
    }

    return Object.values(rules).every(Boolean);
}

function isValidBIN(bin) {
    return /^\d{12}$/.test(bin);
}

function isValidPhone(phone) {
    return /^\d{10}$/.test(phone); 
}

async function submitSignup() {
    const email = document.getElementById('email');
    const bin = document.getElementById('bin');
    const countryCode = document.getElementById('countryCode').value;
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const passwordMatchMessage = document.getElementById('passwordMatchMessage');

    const fullPhone = countryCode.replace('+', '') + phone.value;

    // Reset input borders and messages
    phone.style.border = email.style.border = bin.style.border = password.style.border = confirmPassword.style.border = '1px solid white';
    passwordMatchMessage.style.display = 'none';

    // Basic validation
    if (!email.checkValidity()) {
        email.style.border = '2px solid red';
        alert("Please enter a valid email address.");
        return;
    }

    if (!isValidBIN(bin.value)) {
        bin.style.border = '2px solid red';
        alert("Please enter a valid 12-digit BIN.");
        return;
    }

    if (!isValidPhone(phone.value)) {
        phone.style.border = '2px solid red';
        alert("Please enter a valid 10-digit phone number.");
        return;
    }

    if (password.value !== confirmPassword.value) {
        confirmPassword.style.border = '2px solid red';
        passwordMatchMessage.style.display = 'block';
        return;
    }

    if (!validatePasswordRules(password.value)) {
        alert("Please meet all password rules.");
        return;
    }

    // Submit registration request
    try {
        if (result.success) {
            alert('Registration successful! Redirecting...');

            email.value = '';
            bin.value = '';
            phone.value = '';
            password.value = '';
            confirmPassword.value = '';

            window.location.href = '/dashboard';
        } else {
            if (result.errors) {
                if (result.errors.email) {
                    email.style.border = '2px solid red';
                    alert(result.errors.email[0]);
                }
                if (result.errors.bin) {
                    bin.style.border = '2px solid red';
                    alert(result.errors.bin[0]);
                }
                if (result.errors.phone) {
                    phone.style.border = '2px solid red';
                    alert(result.errors.phone[0]);
                }
                if (result.errors.password) {
                    password.style.border = '2px solid red';
                    alert(result.errors.password[0]);
                }
            } else {
                alert(result.message || "Registration failed. Try again.");
            }
        }
    } catch (error) {
        console.error('Registration request failed:', error);
        alert('Something went wrong. Try again later.');
        phone.style.border = '2px solid red';
    }
}


// Toggle password visibility
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);

    if (input.type === "password") {
        input.type = "text";
        icon.src = "../images/signup/eye-slash.png";
    } else {
        input.type = "password";
        icon.src = "../images/signup/eye.jpeg";
    }
}

// Initialize password rule check on page load
document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', (e) => {
            validatePasswordRules(e.target.value);
        });
    }
});

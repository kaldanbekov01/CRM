const form = document.getElementById('signupForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const firstName = document.getElementById('first-name').value.trim();
        const lastName = document.getElementById('last-name').value.trim();
        const businessName = document.getElementById('business-name').value.trim();

        localStorage.setItem('firstName', firstName);
        localStorage.setItem('lastName', lastName);
        localStorage.setItem('businessName', businessName);

        window.location.href = "signup_info2.html";
    });

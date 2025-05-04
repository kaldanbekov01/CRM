
document.querySelector('.save-btn').addEventListener('click', function (e) {
    e.preventDefault(); 

    const email = document.getElementById('email').value;
    const fullName = document.getElementById('full_name').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').vlaue;

    localStorage.setItem('profile_email', email);
    localStorage.setItem('profile_name', fullName);
    localStorage.setItem('profile_phone', phone);
    localStorage.setItem('profile_password', password);

    window.location.href = 'profile.html';
});

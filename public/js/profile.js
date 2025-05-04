window.addEventListener('DOMContentLoaded', () => {
    const email = localStorage.getItem('profile_email');
    const fullName = localStorage.getItem('profile_name');
    const phone = localStorage.getItem('profile_phone');
    const password = localStorage.getItem('profile_password');

    if (email) document.getElementById('email').value = email;
    if (fullName) document.getElementById('full_name').value = fullName;
    if (phone) document.getElementById('phone').value = phone;
    if (password) document.getElementById('password').value = password;
  });

  function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'flex';
  }

  function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
  }

  function logoutToMain() {
    localStorage.clear();
    window.location.href = "smart_main.html";
  }
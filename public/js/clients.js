document.addEventListener("DOMContentLoaded", function () {
  const phoneInput = document.getElementById("phone");

  document.querySelector('.add-client').addEventListener('click', () => {
    const modal = document.getElementById('clientModal');
    modal.style.display = 'flex';
  });

  document.getElementById('cancelBtn').addEventListener('click', () => {
    document.getElementById('clientModal').style.display = 'none';
    phoneInput.value = ''; 
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const burger = document.querySelector('.burger');
  const sidebar = document.querySelector('.sidebar');
  const overlay = document.querySelector('.overlay');
  const body = document.body;

  function openSidebar() {
      sidebar.classList.add('active');
      overlay.classList.add('active');
      body.classList.add('sidebar-open');
  }

  function closeSidebar() {
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
      body.classList.remove('sidebar-open');
  }

  burger.addEventListener('click', function () {
      openSidebar();
  });

  overlay.addEventListener('click', function () {
      closeSidebar();
  });
});
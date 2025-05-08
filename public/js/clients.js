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
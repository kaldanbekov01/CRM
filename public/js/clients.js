document.addEventListener("DOMContentLoaded", function () {
  const phoneInput = document.getElementById("phone");

  document.querySelector('.add-client').addEventListener('click', () => {
    const modal = document.getElementById('clientModal');
    modal.style.display = 'flex';
    phoneInput.value = '+7 ';
    phoneInput.focus();
  });

  phoneInput.addEventListener("input", function () {
    const cursorPosition = phoneInput.selectionStart;
    phoneInput.value = formatPhone(phoneInput.value);
    phoneInput.setSelectionRange(cursorPosition, cursorPosition); 
  });

  document.getElementById('cancelBtn').addEventListener('click', () => {
    document.getElementById('clientModal').style.display = 'none';
    phoneInput.value = ''; 
  });
});
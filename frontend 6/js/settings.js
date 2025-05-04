document.querySelector('.send-btn').addEventListener('click', () => {
  const addProduct = document.getElementById('addProduct').checked;
  const viewOrders = document.getElementById('viewOrders').checked;
  const financials = document.getElementById('financials').checked;

  const employee = document.getElementById('selectedEmployee').innerText;

  console.log('Access granted to:', employee, {
    addProduct, viewOrders, financials
  });

  alert('Permissions updated!');
});

function toggleEmployeeDropdown() {
  const dropdown = document.getElementById('employee-options');
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

function selectEmployee(name) {
  document.getElementById('selectedEmployee').innerText = name;
  document.getElementById('employee-options').style.display = 'none';
}

function toggleLanguageDropdown() {
  const dropdown = document.getElementById('language-options');
  dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}


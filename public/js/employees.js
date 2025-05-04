document.querySelector('.add-employee').addEventListener('click', () => {
    document.getElementById('employeeModal').style.display = 'flex';
  });
  
  document.getElementById('cancelBtn').addEventListener('click', () => {
    document.getElementById('employeeModal').style.display = 'none';
  });
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

function selectLanguage(language) {
  document.getElementById('selected-language').innerText = language;
  document.getElementById('language-options').style.display = 'none';

  if (language === 'English') changeLang('en');
  else if (language === 'Қазақша') changeLang('kz');
  else if (language === 'Русский') changeLang('ru');
}

function changeLang(lang) {
  fetch('../translation/translation.json') 
    .then(res => res.json())
    .then(data => {
      const translations = data[lang]; 
      if (!translations) {
        console.error("No translations found for:", lang);
        return;
      }

      document.querySelectorAll('[data-i18]').forEach(el => {
        const key = el.getAttribute('data-i18');
        if (translations[key]) el.textContent = translations[key];
      });
    })
    .catch(err => console.error('Translation error:', err));
}


window.onload = () => {
  changeLang('en'); 
};
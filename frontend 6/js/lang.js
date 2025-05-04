function changeLang(lang) {
  fetch(`../translation/${lang}.json`)
    .then(res => res.json())
    .then(data => {
      const translations = data[lang];
      if (!translations) return;

      document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (translations[key]) {
          if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
            el.placeholder = translations[key];
          } else {
            el.textContent = translations[key];
          }
        }
      });
    });
}

function selectLanguage(language) {
  const langCode = language === 'English' ? 'en' : language === 'Қазақша' ? 'kz' : 'ru';
  localStorage.setItem('selectedLang', langCode);
  changeLang(langCode);

  const selectedLangEl = document.getElementById('selected-language');
  if (selectedLangEl) {
    selectedLangEl.innerText = language;
  }

  const langSwitcher = document.getElementById('languageSwitcher');
  if (langSwitcher) {
    const label = langCode === 'en' ? 'EN' : langCode === 'kz' ? 'ҚАЗ' : 'RU';
    langSwitcher.innerText = label + ' ▼';
  }

  const optionsEl = document.getElementById('language-options');
  if (optionsEl) {
    optionsEl.style.display = 'none';
  }
}

function toggleLanguageDropdown() {
  const options = document.getElementById('language-options');
  if (options) {
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
  }
}

window.onload = () => {
  const savedLang = localStorage.getItem('selectedLang') || 'en';
  changeLang(savedLang);

  const langDisplay = savedLang === 'en' ? 'English' : savedLang === 'kz' ? 'Қазақша' : 'Русский';
  const selectedLanguageEl = document.getElementById('selected-language');
  if (selectedLanguageEl) selectedLanguageEl.innerText = langDisplay;

  const langSwitcher = document.getElementById('languageSwitcher');
  if (langSwitcher) {
    const label = savedLang === 'en' ? 'EN' : savedLang === 'kz' ? 'ҚАЗ' : 'RU';
    langSwitcher.innerText = label + ' ▼';
  }
};
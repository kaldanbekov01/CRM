document.addEventListener('DOMContentLoaded', () => {
    const switcher = document.getElementById('languageSwitcher');
    const options = document.getElementById('language-options');
  
    if (switcher && options) {
      switcher.addEventListener('click', (e) => {
        e.preventDefault(); 
        options.style.display = options.style.display === 'block' ? 'none' : 'block';
      });
  
      document.addEventListener('click', function (e) {
        if (!switcher.contains(e.target) && !options.contains(e.target)) {
          options.style.display = 'none';
        }
      });
    }
  });
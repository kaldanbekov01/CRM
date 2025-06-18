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

function toggleMenu() {
  const nav = document.querySelector("nav");
  const burgerElement = document.querySelector(".burger");

  nav.classList.toggle("active");
  burgerElement.classList.toggle("open");
}

document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth <= 768) {
    const grid = document.querySelector('.features-grid');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');

    let scrollAmount = 0;
    const scrollStep = 270; 

    nextBtn.addEventListener('click', () => {
      scrollAmount += scrollStep;
      grid.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });

    prevBtn.addEventListener('click', () => {
      scrollAmount -= scrollStep;
      if (scrollAmount < 0) scrollAmount = 0;
      grid.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });
  }
});
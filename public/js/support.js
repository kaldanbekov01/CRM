document.querySelectorAll('.faq-question').forEach(item => {
    item.addEventListener('click', () => {
        const answer = item.nextElementSibling;
        const isOpen = answer.classList.contains('open');

        // Toggle this one only
        if (isOpen) {
            answer.classList.remove('open');
            item.classList.remove('active');
        } else {
            answer.classList.add('open');
            item.classList.add('active');
        }
    });
});
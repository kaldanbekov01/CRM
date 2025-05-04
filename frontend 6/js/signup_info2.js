let selectedSize = null;

document.addEventListener('DOMContentLoaded', () => {
    const options = document.querySelectorAll('.company-option');
    options.forEach(button => {
        button.addEventListener('click', () => {
            options.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            selectedSize = button.getAttribute('data-size');
            document.getElementById('sizeError').style.display = 'none';
        });
    });
});

function submitCompanySize() {
    if (!selectedSize) {
        document.getElementById('sizeError').style.display = 'block';
        return;
    }

    localStorage.setItem('company_size', selectedSize);

    alert(`Company size selected: ${selectedSize}`);
    window.location.href = "dashboard.html"; 
}
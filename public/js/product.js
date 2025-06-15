function openEditModal(productId) {
    document.getElementById('editProductForm').action = `/product/${productId}`;
    document.getElementById('productModal').style.display = 'flex';
}

document.getElementById('cancelBtn').addEventListener('click', () => {
    document.getElementById('productModal').style.display = 'none';
});


function openDeleteModal(button) {
    const productId = button.getAttribute('data-product-id');
    const productName = button.getAttribute('data-product-name');

    document.getElementById('deleteMessage').innerText = `Are you sure you want to delete "${productName}"?`;
    document.getElementById('deleteForm').action = `/product/${productId}`;

    document.getElementById('deleteModal').style.display = 'flex'; // use flex, not block
}


function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.burger');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.overlay');
    const body = document.body;

    function openSidebar() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        body.classList.remove('sidebar-open');
    }

    burger.addEventListener('click', function () {
        openSidebar();
    });

    overlay.addEventListener('click', function () {
        closeSidebar();
    });
});
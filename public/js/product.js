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
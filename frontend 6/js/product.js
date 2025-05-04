function goToAddProduct() {
    const currentUrl = window.location.href;
    window.location.href = `pos-system3.html?from=${encodeURIComponent(currentUrl)}`;
}
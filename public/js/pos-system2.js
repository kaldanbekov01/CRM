let currentCategory = null;

// Function to display products
function showProducts(category) {
  category = category.toLowerCase().trim(); // normalization for JS

  const filtered = productsByCategory[category] || [];
  const gridArea = document.getElementById("productContainer");
  gridArea.innerHTML = "";  // Clear previous content

  if (filtered.length === 0) {
    const emptyMsg = document.createElement("div");
    emptyMsg.className = "empty-message";
    emptyMsg.innerHTML = `<p>No products available in <b>${category}</b>.</p>`;
    gridArea.appendChild(emptyMsg);
    return;
  }

  // Create product rows in flex
  let productRow;
  filtered.forEach((product, index) => {
    if (index % 3 === 0) {  // Every 3 products, create a new row
      productRow = document.createElement("div");
      productRow.className = "product-row";
      gridArea.appendChild(productRow);
    }

    let cart = JSON.parse(localStorage.getItem("cart") || "[]");
    const cartProduct = cart.find(item => item.id === product.id);
    const cartQuantity = cartProduct ? cartProduct.quantity : 0;
    const availableStock = product.stock_quantity - cartQuantity;

    const div = document.createElement("div");
    div.className = "product-card";
    div.innerHTML = `
      <i class="fas fa-box"></i>
      <div>${product.name}</div>
      <div><b>${product.price.toLocaleString()} KZT</b></div>
      <div>Stock: ${availableStock}</div>
      <button class="add-product-btn" onclick="toggleCartProduct(${product.id}, '${product.name}', ${product.price}, ${product.stock_quantity})">Add</button>
    `;
    productRow.appendChild(div);  // Append the product to the current row
  });

  localStorage.setItem("lastCategory", category);
  gridArea.style.display = "flex";
  gridArea.style.flexWrap = "wrap"; // Enable wrapping of products into rows
}

// Function to add product to the cart
function toggleCartProduct(id, name, price, stock_quantity) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");

  // Check if product already exists in the cart
  const index = cart.findIndex(p => p.id === id);

  if (index === -1) {
    // If the product isn't in the cart yet, add it
    cart.push({ id, name, price, stock_quantity, quantity: 1 });
  } else {
    // If it's already in the cart, increase the quantity
    if (cart[index].quantity < cart[index].stock_quantity) {
      cart[index].quantity += 1;
    }
  }

  // Save the updated cart in localStorage
  localStorage.setItem("cart", JSON.stringify(cart));

  // Render the updated cart immediately after the product is added
  renderCart();
}

// Function to render the cart
function renderCart() {
  const cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const tbody = document.querySelector(".product-table tbody");
  if (!tbody) {
    console.error("Cart table body not found");
    return;
  }

  tbody.innerHTML = "";


  let total = 0;

  // Only render products that are in the cart
  cart.forEach(item => {
    if (item.quantity > 0 && item.price) {
      const itemTotal = item.price * item.quantity;
      total += itemTotal;

      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.name}</td>
        <td>
          <button onclick="updateQty('${item.id}', -1)">-</button>
          ${item.quantity}
          <button onclick="updateQty('${item.id}', 1)">+</button>
        </td>
        <td>${item.price.toLocaleString()} KZT</td>
        <td>${itemTotal.toLocaleString()} KZT</td>
        <td>
          <span onclick="removeFromCart('${item.id}')" style="color: red; cursor: pointer; font-size: 50px;">&times;</span>
        </td>
      `;
      tbody.appendChild(row);
    }
  });

  document.querySelector(".total-amount").innerText = `${total.toLocaleString()} KZT`;
}

// Function to remove item from cart
function removeFromCart(id) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  cart = cart.filter(item => item.id != id);  // Remove by product id
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

// Function to update quantity in cart
function updateQty(id, delta) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const item = cart.find(p => p.id == id);  // Find the item by id
  if (!item) return;

  if (delta > 0) {
    // Increase quantity only if there's enough stock
    if (item.quantity < item.stock_quantity) {
      item.quantity += delta;
    }
  } else {
    item.quantity += delta;
  }
  if (item.quantity <= 0) {
    cart = cart.filter(p => p.id != id);  // Remove item if quantity is 0
  }
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

// On page load, render the cart
document.addEventListener("DOMContentLoaded", () => {
  // Render cart if available
  renderCart();

  // Auto-show the last selected category
  const savedCategory = localStorage.getItem("lastCategory");
  const defaultCategory = Object.keys(productsByCategory)[0];

  if (savedCategory && productsByCategory[savedCategory]) {
    showProducts(savedCategory);
  } else if (defaultCategory) {
    showProducts(defaultCategory);
  }
});




// Handle total on click event
document.querySelector(".next-total").addEventListener("click", function () {
  const totalText = document.querySelector(".total-amount").innerText;
  const total = parseFloat(totalText.replace(/\D/g, ''));
  localStorage.setItem("posTotal", total);
  window.location.href = "/posSystem";
});

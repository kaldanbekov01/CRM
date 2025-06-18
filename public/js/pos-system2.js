let currentCategory = null;

function showProducts(category) {
  category = category.toLowerCase().trim(); 

  const filtered = productsByCategory[category] || [];
  const gridArea = document.getElementById("productContainer");
  gridArea.innerHTML = ""; 

  if (filtered.length === 0) {
    const emptyMsg = document.createElement("div");
    emptyMsg.className = "empty-message";
    emptyMsg.innerHTML = `<p>No products available in <b>${category}</b>.</p>`;
    gridArea.appendChild(emptyMsg);
    return;
  }

  let productRow;
  filtered.forEach((product, index) => {
    if (index % 3 === 0) { 
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

    const isOutOfStock = availableStock <= 0;

    div.innerHTML = `
  <i style="margin-top: 40px;" class="fas fa-box"></i>
  <div>${product.name}</div>
  <div><b>${product.price.toLocaleString()} KZT</b></div>
  <div>Stock: ${availableStock}</div>
  <button class="add-product-btn"
    style="padding:0px; margin-top: 10px; height:60px; font-size:14px; border-radius:10px;"
    ${isOutOfStock ? 'disabled style="background:gray;cursor:not-allowed;"' : ''}
    onclick="${isOutOfStock ? '' : `toggleCartProduct(${product.id}, '${product.name}', ${product.price}, ${product.stock_quantity})`}">
    ${isOutOfStock ? 'Out of Stock' : 'Add'}
  </button>
`;

    productRow.appendChild(div);  
  });

  localStorage.setItem("lastCategory", category);
  gridArea.style.display = "flex";
  gridArea.style.flexWrap = "wrap"; 
}

function toggleCartProduct(id, name, price, stock_quantity) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");

  const index = cart.findIndex(p => p.id === id);

  if (index === -1) {
    cart.push({ id, name, price, stock_quantity, quantity: 1 });
  } else {
    if (cart[index].quantity < cart[index].stock_quantity) {
      cart[index].quantity += 1;
    } else {
      alert(`Product ${name}'s quantity is 0.`);
    }
  }

  localStorage.setItem("cart", JSON.stringify(cart));

  renderCart();
}

function renderCart() {
  const cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const tbody = document.querySelector(".product-table tbody");
  if (!tbody) {
    console.error("Cart table body not found");
    return;
  }

  tbody.innerHTML = "";


  let total = 0;

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

function removeFromCart(id) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  cart = cart.filter(item => item.id != id); 
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

function updateQty(id, delta) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const item = cart.find(p => p.id == id);  
  if (!item) return;

  if (delta > 0) {
    if (item.quantity < item.stock_quantity) {
      item.quantity += delta;
    }
  } else {
    item.quantity += delta;
  }
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

document.addEventListener("DOMContentLoaded", () => {
  renderCart();

  const savedCategory = localStorage.getItem("lastCategory");
  const defaultCategory = Object.keys(productsByCategory)[0];

  if (savedCategory && productsByCategory[savedCategory]) {
    showProducts(savedCategory);
  } else if (defaultCategory) {
    showProducts(defaultCategory);
  }
});


document.querySelector(".next-total").addEventListener("click", function () {
  const totalText = document.querySelector(".total-amount").innerText;
  const total = parseFloat(totalText.replace(/\D/g, ''));
  localStorage.setItem("posTotal", total);
  window.location.href = "/posSystem";
});


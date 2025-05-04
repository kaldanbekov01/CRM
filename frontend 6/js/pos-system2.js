let currentCategory = null;

const products = JSON.parse(localStorage.getItem("products")) || [
  { name: 'Nike Air Jordan', price: 35000, category: 'Shoes' },
  { name: 'New Balance', price: 29990, category: 'Shoes' },
];

if (!localStorage.getItem("products")) {
  localStorage.setItem("products", JSON.stringify(products));
}

function showProducts(category) {
  const gridArea = document.getElementById("categoryContainer");

  if (currentCategory === category) {
    gridArea.querySelectorAll(".product-card").forEach(el => el.remove());
    currentCategory = null;
    localStorage.removeItem("lastCategory");
    return;
  }

  gridArea.querySelectorAll(".product-card").forEach(el => el.remove());

  const filtered = products.filter(p => p.category === category);
  const cart = JSON.parse(localStorage.getItem("cart") || "[]");

  filtered.forEach(product => {
    const div = document.createElement("div");
    div.className = "product-card";

    const inCart = cart.find(p => p.name === product.name);
    if (inCart) div.classList.add("active");

    div.innerHTML = `
      <i class="fas fa-box"></i>
      <div>${product.name}</div>
      <div><b>${product.price.toLocaleString()} KZT</b></div>
    `;

    div.onclick = () => {
      toggleCartProduct(product);
      div.classList.add("active");
    };

    gridArea.appendChild(div);
  });

  currentCategory = category;
  localStorage.setItem("lastCategory", category);
}

function toggleCartProduct(product) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const index = cart.findIndex(p => p.name === product.name);

  if (index === -1) {
    cart.push({ ...product, quantity: 1 });
  } else {
    cart[index].quantity += 1;
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

function renderCart() {
  const cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const tbody = document.querySelector(".product-table tbody");
  if (!tbody) return;
  tbody.innerHTML = "";

  let total = 0;

  cart.forEach(item => {
    const itemTotal = item.price * item.quantity;
    total += itemTotal;

    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${item.name}</td>
      <td>
        <button onclick="updateQty('${item.name}', -1)">-</button>
        ${item.quantity}
        <button onclick="updateQty('${item.name}', 1)">+</button>
      </td>
      <td>${item.price.toLocaleString()} KZT</td>
      <td>${itemTotal.toLocaleString()} KZT</td>
      <td>
        <span onclick="removeFromCart('${item.name}')" style="color: red; cursor: pointer; font-size: 50px;">&times;</span>
      </td>
    `;
    tbody.appendChild(row);
  });

  const totalEl = document.querySelector(".total-amount");
  if (totalEl) totalEl.innerText = `${total.toLocaleString()} KZT`;
}

function updateQty(name, delta) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const item = cart.find(p => p.name === name);
  if (!item) return;

  item.quantity += delta;
  if (item.quantity <= 0) {
    cart = cart.filter(p => p.name !== name);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

function removeFromCart(name) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  cart = cart.filter(p => p.name !== name);
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
}

document.addEventListener("DOMContentLoaded", () => {
  renderCart();

  const savedCategory = localStorage.getItem("lastCategory") || "Shoes";
  showProducts(savedCategory);

  const nextBtn = document.querySelector(".next-total");
  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      const totalText = document.querySelector(".total-amount").innerText;
      const total = parseFloat(totalText.replace(/\D/g, ''));
      localStorage.setItem("posTotal", total);
      window.location.href = "pos-system1.html";
    });
  }
});
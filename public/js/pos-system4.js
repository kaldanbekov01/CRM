document.addEventListener("DOMContentLoaded", function () {
    const total = parseFloat(localStorage.getItem("posTotal")) || 0;
    const method = localStorage.getItem("payment_method") || "cash";
    const formatted = total.toLocaleString('en-US', { maximumFractionDigits: 0 }) + " KZT";
  
    document.querySelectorAll(".payment-amount").forEach(el => {
      el.textContent = "0 KZT";
    });

    const selectedMethod = document.getElementById(method);
    if (selectedMethod) {
      selectedMethod.classList.add("active");
      selectedMethod.querySelector(".payment-amount").textContent = formatted;
    }
  
    const totalAmounts = document.querySelectorAll(".total-amount");
    if (totalAmounts.length >= 2) {
      totalAmounts[0].textContent = formatted; 
      totalAmounts[1].textContent = formatted; 
    }
  
    const change = document.getElementById("change");
    if (change) {
      change.textContent = "0 KZT";
    }
  
    const cart = JSON.parse(localStorage.getItem("cart") || "[]");
    const tbody = document.querySelector(".product-table tbody");
  
    if (!tbody) return;
  
    tbody.innerHTML = "";
  
    cart.forEach(item => {
      const totalItem = item.price * item.quantity;
  
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.name}</td>
        <td>${item.quantity}</td>
        <td>${item.price.toLocaleString()} KZT</td>
        <td>${totalItem.toLocaleString()} KZT</td>
        <td></td>
      `;
      tbody.appendChild(row);
    });
  });


  const nextBtn = document.getElementById("next-btn");
  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      window.location.href = "pos-system5.html";
    });
  }
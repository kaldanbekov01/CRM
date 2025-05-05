document.addEventListener("DOMContentLoaded", () => {
  // Retrieve cart data, total, and payment method from localStorage
  const cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const total = parseFloat(localStorage.getItem("posTotal")) || 0;
  const payment = localStorage.getItem("payment_method") || "Cash";

  // Get current date and time for the receipt
  const now = new Date();
  const dateElem = document.getElementById("date");
  const timeElem = document.getElementById("time");

  if (dateElem) dateElem.innerText = now.toLocaleDateString('en-GB');
  if (timeElem) timeElem.innerText = now.toLocaleTimeString('en-GB');

  // Insert cart items into the receipt
  const container = document.getElementById("items-container");
  if (container && cart.length > 0) {
      cart.forEach((item, i) => {
          const line = document.createElement("div");
          line.classList.add("item");
          line.innerHTML = `
              <div>${i + 1}. '${item.name}'<br><small>${item.quantity} × ${item.price.toLocaleString()} KZT</small></div>
              <div>${(item.price * item.quantity).toLocaleString()} KZT</div>
          `;
          container.appendChild(line);
      });
  }

  // Display the total amount and payment details
  const totalAmount = document.getElementById("totalAmount");
  const paidAmount = document.getElementById("paidAmount");
  const paymentMethod = document.getElementById("paymentMethod");

  if (totalAmount) totalAmount.innerText = `${total.toLocaleString()} KZT`;
  if (paidAmount) paidAmount.innerText = `${total.toLocaleString()} KZT`;
  if (paymentMethod) paymentMethod.innerText = payment.charAt(0).toUpperCase() + payment.slice(1); // Capitalize the first letter

  // Language switcher functionality
  const switcher = document.getElementById('languageSwitcher');
  const options = document.getElementById('language-options');

  if (switcher && options) {
      switcher.addEventListener('click', (e) => {
          e.preventDefault();
          options.style.display = options.style.display === 'block' ? 'none' : 'block';
      });

      // Close language options if clicking outside of it
      document.addEventListener('click', function (e) {
          if (!switcher.contains(e.target) && !options.contains(e.target)) {
              options.style.display = 'none';
          }
      });
  }
});

// Back button functionality
const backBtn = document.querySelector(".back-btn");
if (backBtn) {
  backBtn.addEventListener("click", function () {
      // Clear the cart and payment data from localStorage
      localStorage.removeItem("cart");
      localStorage.removeItem("posTotal");
      localStorage.removeItem("payment_method");

      // Redirect to the POS system page
      window.location.href = "/posSystem";
  });
}

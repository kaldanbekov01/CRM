document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".keypad-btn[data-action='next']").addEventListener("click", function () {
      window.location.href = "pos-system4.html";
    });
  });
  
document.addEventListener("DOMContentLoaded", function () {
    const display = document.getElementById("pos-display");
    const buttons = document.querySelectorAll(".keypad-btn");
    const paymentButtons = document.querySelectorAll(".payment-btn");
    let currentInput = "";
    let currentTotal = 0;
    let selectedPaymentMethod = 'cash';
  
    const savedMethod = localStorage.getItem("payment_method");
    paymentButtons.forEach(button => {
        button.addEventListener("click", function () {
          let method = this.getAttribute("data-method");
          if (method === 'qr') method = 'mobile';
          selectedPaymentMethod = method;
      
          localStorage.setItem("payment_method", selectedPaymentMethod);
      
          paymentButtons.forEach(btn => btn.classList.remove("active"));
      
          this.classList.add("active");
        });
      });
  
    const cart = JSON.parse(localStorage.getItem("cart") || "[]");
    if (cart.length > 0) {
      currentTotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
      display.innerText = currentTotal.toLocaleString('en-US', { maximumFractionDigits: 0 });
      localStorage.setItem("posTotal", currentTotal);
      return;
    }
  
    function updateDisplay() {
      if (currentInput.includes("+")) {
        try {
          const parts = currentInput.split("+").map(part => parseFloat(part));
          if (parts.every(n => !isNaN(n))) {
            currentTotal = parts.reduce((acc, val) => acc + val, 0);
            display.innerText = `${currentInput} = ${currentTotal.toLocaleString('en-US', { maximumFractionDigits: 0 })}`;
          } else {
            display.innerText = currentInput;
          }
        } catch {
          display.innerText = currentInput;
        }
      } else {
        currentTotal = parseFloat(currentInput) || 0;
        display.innerText = currentInput || "0";
      }
    }

    buttons.forEach(button => {
      button.addEventListener("click", function () {
        const value = this.getAttribute("data-value");
        const action = this.getAttribute("data-action");
  
        if (value) {
          currentInput += value;
        } else if (action === "clear") {
          currentInput = "";
        } else if (action === "delete") {
          currentInput = currentInput.slice(0, -1);
        } else if (action === "add") {
          if (currentInput && !currentInput.endsWith("+")) {
            currentInput += "+";
          }
        } else if (action === "next") {
          localStorage.setItem("posTotal", currentTotal);
          localStorage.setItem("payment_method", selectedPaymentMethod);
          window.location.href = "pos-system4.html";
        }
  
        updateDisplay();
      });
    });
  
    paymentButtons.forEach(button => {
      button.addEventListener("click", function () {
        let method = this.getAttribute("data-method");
        if (method === 'qr') method = 'mobile';
        selectedPaymentMethod = method;
  
        localStorage.setItem("payment_method", selectedPaymentMethod);

        paymentButtons.forEach(btn => btn.classList.remove("active"));
        this.classList.add("active");
      });
    });
  
    const storedTotal = localStorage.getItem("posTotal");
    if (!cart.length && storedTotal) {
      display.innerText = Number(storedTotal).toLocaleString('en-US', { maximumFractionDigits: 0 });
      currentTotal = parseFloat(storedTotal);
    }
  
    updateDisplay();
  });
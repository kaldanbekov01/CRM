document.addEventListener("DOMContentLoaded", function () {
    const cart = JSON.parse(localStorage.getItem("cart") || "[]");
    const total = parseFloat(localStorage.getItem("posTotal")) || 0;
    const method = localStorage.getItem("payment_method") || "cash";

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Get CSRF token

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

    const tbody = document.querySelector(".product-table tbody");
    if (!tbody) return;

    tbody.innerHTML = "";

    cart.forEach(item => {
        if (item.quantity > 0) {
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
        }
    });

    const nextBtn = document.getElementById("next-btn");
    if (nextBtn) {
        nextBtn.addEventListener("click", function () {
            const dataToSend = {
                cart: cart,
                total_amount: total,
                payment_method: method
            };

            console.log('Data to send:', dataToSend);

            fetch('/posSystem/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(dataToSend)
            })
                .then(async response => {
                    const contentType = response.headers.get("content-type");

                    if (contentType && contentType.includes("application/json")) {
                        const data = await response.json();

                        if (data.success) {
                            window.location.href = '/receipt';
                            // Или куда ты хочешь
                        } else {
                            alert(data.message || 'Ошибка оформления заказа');
                        }
                    } else {
                        const text = await response.text();
                        console.error('Ошибка 500:', text);
                        alert('Сервер вернул не JSON. Проверь логи Laravel.');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
        });
    }
});

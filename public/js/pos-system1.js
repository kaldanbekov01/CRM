document.addEventListener("DOMContentLoaded", function () {
    const display = document.getElementById("pos-display");
    const buttons = document.querySelectorAll(".keypad-btn");
    const paymentButtons = document.querySelectorAll(".payment-btn");
    let currentInput = "";

    function updateDisplay() {
        display.innerText = currentInput || "0";
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
            } else if (action === "next") {
                alert("Proceeding to the next step with: " + currentInput);
            } else if (action === "add") {
                currentInput += "+";
            }

            updateDisplay();
        });
    });

    paymentButtons.forEach(button => {
        button.addEventListener("click", function () {
            const method = this.getAttribute("data-method");
            alert(`Payment method selected: ${method.toUpperCase()}`);
        });
    });

    updateDisplay();
});

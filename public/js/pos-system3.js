const costInput = document.getElementById('cost-price');
        const sellingInput = document.getElementById('selling-price');
        const markupInput = document.getElementById('markup');
        const switchLabels = document.querySelectorAll('.switch-label');

        function calculateMarkup() {
            const cost = parseFloat(costInput.value);
            const selling = parseFloat(sellingInput.value);
            const mode = document.querySelector('.switch-label.active')?.innerText.trim();

            if (!isNaN(cost) && !isNaN(selling)) {
                if (mode === '%') {
                    const markupPercent = ((selling - cost) / cost) * 100;
                    markupInput.value = markupPercent.toFixed(2);
                } else if (mode === 'KZT') {
                    const markupValue = selling - cost;
                    markupInput.value = markupValue.toFixed(2);
                }
            } else {
                markupInput.value = '';
            }
        }

        costInput.addEventListener('input', calculateMarkup);
        sellingInput.addEventListener('input', calculateMarkup);

        switchLabels.forEach(label => {
            label.addEventListener('click', () => {
                switchLabels.forEach(l => l.classList.remove('active'));
                label.classList.add('active');
                calculateMarkup();
            });
        });

        const quantityDisplay = document.getElementById('quantity-value');
        const increaseBtn = document.getElementById('increase-qty');
        const decreaseBtn = document.getElementById('decrease-qty');

        let quantity = 1;

        function updateQuantityDisplay() {
            quantityDisplay.value = quantity;
        }

        increaseBtn.addEventListener('click', () => {
            quantity++;
            updateQuantityDisplay();
        });

        decreaseBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                updateQuantityDisplay();
            }
        });

        const barcode = document.getElementById('barcode');
        const cost = document.getElementById('cost-price');
        const selling = document.getElementById('selling-price');
        const name = document.getElementById('product-name');
        const markup = document.getElementById('markup');
        const category = document.getElementById('category_id');
        const addBtn = document.getElementById('add-btn');

        function validateForm() {
            if (
                barcode.value.trim() !== '' &&
                cost.value.trim() !== '' &&
                selling.value.trim() !== '' &&
                name.value.trim() !== '' &&
                markup.value.trim() !== '' &&
                category.value.trim() !== ''
            ) {
                addBtn.disabled = false;
            } else {
                addBtn.disabled = true;
            }
        }

        [barcode, cost, selling, name, markup, category].forEach(input => {
            input.addEventListener('input', validateForm);
        });

        validateForm();
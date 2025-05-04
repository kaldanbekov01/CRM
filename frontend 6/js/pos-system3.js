const barcode = document.getElementById('barcode');
const cost = document.getElementById('cost-price');
const selling = document.getElementById('selling-price');
const name = document.getElementById('product-name');
const category = document.getElementById('category');
const markupInput = document.getElementById('markup');
const costInput = document.getElementById('cost-price');
const sellingInput = document.getElementById('selling-price');
const switchLabels = document.querySelectorAll('.switch-label');
const addBtn = document.getElementById('add-btn');
const quantityDisplay = document.getElementById('quantity-value');
const increaseBtn = document.getElementById('increase-qty');
const decreaseBtn = document.getElementById('decrease-qty');


// Markup claculation
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

  validateForm();
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

// Quantity buttons
let quantity = 1;
function updateQuantityDisplay() {
  quantityDisplay.textContent = quantity;
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

function isValidBarcode(value) {
  return /^\d{13}$/.test(value) && value.startsWith('487');
}

// Cheking form
function validateForm() {
  const isValid =
    isValidBarcode(barcode.value.trim()) &&
    cost.value.trim() !== '' &&
    selling.value.trim() !== '' &&
    name.value.trim() !== '' &&
    category.value.trim() !== '';

  addBtn.disabled = !isValid;
}

barcode.addEventListener('input', () => {
    barcode.value = barcode.value.replace(/\D/g, '');
  
    if (barcode.value.length > 13) {
      barcode.value = barcode.value.slice(0, 13);
    }
    
    validateForm();
});

[barcode, cost, selling, name, category].forEach(input => {
  input.addEventListener('input', validateForm);
});

// Sending form 
document.querySelector('.product-form').addEventListener('submit', function (e) {
  e.preventDefault();

  const barcodeValue = barcode.value.trim();
  const costValue = cost.value.trim();
  const sellingValue = selling.value.trim();
  const nameValue = name.value.trim();
  const categoryValue = category.value.trim();

  let errorMessage = '';

  if (!isValidBarcode(barcodeValue)) {
    errorMessage += '• Barcode must be 13 digits and start with "487"\n';
  }
  if (costValue === '') errorMessage += '• Cost Price is required\n';
  if (sellingValue === '') errorMessage += '• Selling Price is required\n';
  if (nameValue === '') errorMessage += '• Product Name is required\n';
  if (categoryValue === '') errorMessage += '• Category is required\n';

  if (errorMessage !== '') {
    alert('Please fix the following issues:\n\n' + errorMessage);
    return;
  }

  alert('The product has been added successfully!');

  barcode.value = '';
  cost.value = '';
  selling.value = '';
  name.value = '';
  category.value = '';
  markupInput.value = '';

  quantity = 1;
  updateQuantityDisplay();

  switchLabels.forEach(l => l.classList.remove('active'));
  switchLabels[0].classList.add('active');

  validateForm();
  barcode.focus();
});

function goBack() {
  const params = new URLSearchParams(window.location.search);
  const fromUrl = params.get('from');

  if (fromUrl) {
      window.location.href = fromUrl;
  } else {
      window.location.href = 'pos-system2.html'; // fallback, если нет from
  }
}
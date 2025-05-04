const ctxIncomeExpense = document.getElementById('incomeExpenseChart').getContext('2d');
  new Chart(ctxIncomeExpense, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [
        {
          label: 'Income',
          data: [700000, 900000, 600000, 800000, 850000, 1000000, 950000, 550000, 700000, 1200000, 1000000, 800000],
          borderColor: '#007058',
          fill: false,
          tension: 0.3
        },
        {
          label: 'Expenses',
          data: [600000, 850000, 500000, 750000, 800000, 900000, 680000, 300000, 450000, 1000000, 387000, 750000],
          borderColor: '#99CFCB',
          fill: false,
          tension: 0.3
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: true } },
      scales: { y: { beginAtZero: false } }
    }
  });

  const ctxNetSavings = document.getElementById('netSavingsChart').getContext('2d');
  new Chart(ctxNetSavings, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Net savings',
        data: [700000, 900000, 600000, 800000, 850000, 1000000, 950000, 550000, 700000, 1200000, 1000000, 800000],
        borderColor: '#20a090',
        fill: false,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: false } }
    }
  });
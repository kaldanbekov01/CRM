const ctxIncomeExpense = document.getElementById('incomeExpenseChart').getContext('2d');
new Chart(ctxIncomeExpense, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
      {
        label: 'Income',
        data: incomeData,
        borderColor: '#007058',
        fill: false,
        tension: 0.3
      },
      {
        label: 'Expenses',
        data: expenseData,
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
      data: savingsData,
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

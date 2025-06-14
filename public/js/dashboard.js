new Chart(document.getElementById('lineChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: weeklyOrderLabels,
        datasets: [{
            label: 'Orders',
            data: weeklyOrderData,
            borderColor: '#20a090',
            tension: 0.3,
            fill: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

new Chart(document.getElementById('pieChart').getContext('2d'), {
    type: 'pie',
    data: {
        labels: categoryLabels,
        datasets: [{
            data: categoryTotals,
            backgroundColor: ['#008060', '#20a090', '#80c0a0', '#40b090', '#60d0b0']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});


const ctxBar = document.getElementById('barChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: topProducts,
        datasets: [{
            label: 'Sales',
            data: topProductsQuantity,
            backgroundColor: ['#008060', '#20a090', '#80c0a0', '#40b090']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,  
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

const ctxLine = document.getElementById('lineChart').getContext('2d');
new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Orders',
            data: [1000, 2000, 1500, 3000, 2500, 2800, 4000],
            borderColor: '#20a090',
            tension: 0.3,
            fill: false
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

const ctxPie = document.getElementById('pieChart').getContext('2d');
new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Category A', 'Category B', 'Category C'],
        datasets: [{
            data: [40, 30, 30],
            backgroundColor: ['#008060', '#20a090', '#80c0a0']
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
        labels: ['Product A', 'Product B', 'Product C', 'Product D'],
        datasets: [{
            label: 'Sales',
            data: [40, 70, 20, 60],
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

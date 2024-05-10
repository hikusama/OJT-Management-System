// $(document).ready(function () {



// });

// Function to generate random data for the chart
function generateRandomData() {
    const data = [];
    for (let i = 0; i < 4; i++) {
        data.push(Math.floor(Math.random() * 100));
    }
    return data;
}

// Function to update the chart with new data
function updateChart(chart, newData) {
    chart.data.datasets[0].data = newData;
    chart.update();
}

// Function to initialize the chart
function initializeChart() {
    const ctx = document.getElementById('myChart').getContext('2d');
    const initialData = generateRandomData();

    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Data 1", "Data 2", "Data 3", "Data 4"],
            datasets: [{
                label: 'Random Data',
                data: initialData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Update the chart with new data every 3 seconds
    setInterval(function () {
        const newData = generateRandomData();
        updateChart(myChart, newData);
    }, 3000);
}

// Call initializeChart to create and update the chart
initializeChart();

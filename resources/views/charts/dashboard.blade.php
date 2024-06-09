<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard - Patients Overview
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-6 md:grid-cols-2">
                <!-- Pie Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <canvas id="pieChart" width="400" height="400"></canvas>
                </div>
                
                <!-- Bar Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <canvas id="barChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example data (simulate data you might fetch from the backend)
        var pieData = @json($pieData);
        var barData = @json($barData);

        // Prepare data for the pie chart
        var pieChartData = {
            labels: [],
            datasets: [{
                label: 'Patients by Risk Category',
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'], // Add more colors as needed
                data: []
            }]
        };

        // Populate pie chart data
        pieData.forEach(function(item) {
            pieChartData.labels.push(item.category);
            pieChartData.datasets[0].data.push(item.percentage.toFixed(2)); // Round to 2 decimal places
        });

        // Render the pie chart using Chart.js
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Percentage of Patients in Each Risk Category Group'
                    }
                }
            }
        });

// Prepare data for the bar chart
var chartData = {
    labels: [], // Array to hold labels (month and week)
    datasets: [] // Array to hold datasets (each risk category)
};

// Iterate through the fetched data to populate chartData
barData.forEach(function(item) {
    var label = item.month_label + ' - Week ' + item.week_number;
    if (!chartData.labels.includes(label)) {
        chartData.labels.push(label); // Push unique labels (month - week)
    }

    var dataset = chartData.datasets.find(function(dataset) {
        return dataset.label === item.month_label; // Check if dataset exists for month
    });

    if (!dataset) {
        dataset = {
            label: item.month_label,
            backgroundColor: '#' + (Math.random().toString(16) + '000000').substring(2,8), // Random color
            data: [] // Initialize data array for the dataset
        };
        chartData.datasets.push(dataset);
    }

    dataset.data.push(item.total_patients); // Push patient count to the dataset
});

// Render the bar chart using Chart.js
var ctx = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Patients Count by Month and Week'
            }
        }
    }
});
    </script>
</x-app-layout>

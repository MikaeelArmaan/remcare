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
        var pieData = @json($pieData);
        var pieChartData = {
            labels: [],
            datasets: [{
                label: 'Patients by Risk Category',
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'], // Add more colors as needed
                data: []
            }]
        };

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

var data = @json($barData);
var chartData = {
            labels: [],
            datasets: []
        };
data.forEach(function(item) {
            var dataset = {
                label: 'Risk Category ' + item.risk_category,
                data: [],
                backgroundColor: '#' + Math.floor(Math.random()*16777215).toString(16), // Random color
            };

            Object.keys(item.data).forEach(function(week) {
                let label = item.data[week].month + ' - ' + week;
                if (!chartData.labels.includes(label)) {
                    chartData.labels.push(label);
                }
                dataset.data.push(item.data[week].total_patients);
            });

            chartData.datasets.push(dataset);
        });
// Render the chart using Chart.js
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
                        text: 'Total Patients Waiting by Week and Month in Each Risk Category Group'
                    }
                }
            }
        });
    </script>
</x-app-layout>

import React, { useEffect, useState } from 'react';
import Chart from 'chart.js/auto'; // Import Chart from Chart.js

const Dashboard = () => {
    const [pieChartInstance, setPieChartInstance] = useState(null);
    const [barChartInstance, setBarChartInstance] = useState(null);
    const [pieChartData, setPieChartData] = useState(null);
    const [barChartData, setBarChartData] = useState(null);

    // Function to fetch data from API
    const fetchData = async () => {
        try {
            // Example: Fetching pie chart data
            const dashboardCharts = await fetch('http://127.0.0.1:8000/api/dashboard');
            const chartData = await dashboardCharts.json();
            setPieChartData(chartData.pieData);
            setBarChartData(chartData.barData);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    useEffect(() => {
        fetchData(); // Fetch data when component mounts
    }, []);

    useEffect(() => {
        // Clean up any existing chart instances before rendering new ones
        if (pieChartInstance) {
            pieChartInstance.destroy();
        }
        if (barChartInstance) {
            barChartInstance.destroy();
        }

        // Render new charts if data is available
        if (pieChartData) {
            const newPieChartInstance = renderPieChart();
            setPieChartInstance(newPieChartInstance);
        }
        if (barChartData) {
            const newBarChartInstance = renderBarChart();
            setBarChartInstance(newBarChartInstance);
        }

        // Cleanup function
        return () => {
            if (pieChartInstance) {
                pieChartInstance.destroy();
            }
            if (barChartInstance) {
                barChartInstance.destroy();
            }
        };
    }, [pieChartData, barChartData]); // Re-run effect when pieChartData or barChartData change

    const renderPieChart = () => {
        const labels = pieChartData.map(item => item.category);
        const data = pieChartData.map(item => item.total_appointments);
        const backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
        ];
        const borderColor = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
        ];

        const pieChartCanvas = document.getElementById('pie-chart');
        return new Chart(pieChartCanvas, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Appointments',
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'A pie chart showing percentage of patients each group',
                        font: {
                            size: 16
                        }
                    }
                }
            },
        });
    };

    const renderBarChart = () => {
        const labels = barChartData[0].data ? Object.keys(barChartData[0].data) : [];
        const datasets = barChartData.map(item => {
            const randomColor = () => {
                const r = Math.floor(Math.random() * 256);
                const g = Math.floor(Math.random() * 256);
                const b = Math.floor(Math.random() * 256);
                return `rgba(${r}, ${g}, ${b}, 0.2)`;
            };

            const backgroundColor = randomColor();
            const borderColor = backgroundColor.replace(/[^,]+(?=\))/, '1');
            const data = labels.map(label => item.data[label].total_patients);
            return {
                label: `Risk Category ${item.risk_category}`,
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1
            };
        });

        const barChartCanvas = document.getElementById('bar-chart');
        return new Chart(barChartCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'A bar chart showing total patients waiting by week and month in each group',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    };

    return (
        <div className="p-4">
            <h1 className="text-2xl font-bold mb-4">Dashboard</h1>
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div className="px-5">
                    <canvas id="pie-chart" className="bg-white rounded-lg shadow-md my-5 py-2"></canvas>
                </div>
                <div className="px-5">
                    <canvas id="bar-chart" className="bg-white rounded-lg shadow-md my-5 py-2"></canvas>
                </div>
            </div>
        </div>
    );
};

export default Dashboard;

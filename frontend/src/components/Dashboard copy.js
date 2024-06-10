import React, { useEffect, useState } from 'react';
import Chart from 'chart.js/auto'; // Import Chart from Chart.js

const Dashboards = () => {
    const [pieChartInstance, setPieChartInstance] = useState(null);
    const [barChartInstance, setBarChartInstance] = useState(null);

    // Example data for pie chart
    const pieChartData = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
        datasets: [
            {
                label: 'My First Dataset',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1,
            },
        ],
    };

    // Example data for bar chart
    const barChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'Sales 2021 (M)',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ],
                borderWidth: 1,
            },
        ],
    };

    // Example options for bar chart
    const barChartOptions = {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    };

    useEffect(() => {
        // Clean up any existing chart instances before rendering new ones
        if (pieChartInstance) {
            pieChartInstance.destroy();
        }
        if (barChartInstance) {
            barChartInstance.destroy();
        }

        // Render new charts
        const newPieChartInstance = renderPieChart();
        const newBarChartInstance = renderBarChart();

        // Set the new chart instances
        setPieChartInstance(newPieChartInstance);
        setBarChartInstance(newBarChartInstance);

        // Cleanup function
        return () => {
            if (newPieChartInstance) {
                newPieChartInstance.destroy();
            }
            if (newBarChartInstance) {
                newBarChartInstance.destroy();
            }
        };
    }, []); // Empty dependency array to run effect only once on mount

    const renderPieChart = () => {
        return new Chart(document.getElementById('pie-chart'), {
            type: 'pie',
            data: pieChartData,
            options: {
                // Optional chart options
            },
        });
    };

    const renderBarChart = () => {
        return new Chart(document.getElementById('bar-chart'), {
            type: 'bar',
            data: barChartData,
            options: barChartOptions,
        });
    };

    return (
        <div className="p-4 ">
            <h1 className="text-2xl font-bold mb-4">Dashboard</h1>
            <div className="grid 2xl:grid-cols-2 gap-4 ">
                <div className="px-5 ">
                    <canvas id="pie-chart" className="bg-white rounded-lg shadow-md  my-5 py-2" ></canvas>
                </div>
                <div className="px-5 py-5">
                    <canvas id="bar-chart" className="bg-white rounded-lg shadow-md my-5 py-2"></canvas></div>
            </div>
        </div>
    );
};

export default Dashboards;

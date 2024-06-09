// src/components/PieChart.js

import React, { useEffect, useState } from 'react';
import axios from '../api/config'; // Import the Axios instance from your config file
import { Pie } from 'react-chartjs-2';

const PieChart = () => {
    const [data, setData] = useState({});

    useEffect(() => {
        fetchData();
    }, []);

    const fetchData = async () => {
        try {
            const response = await axios.get('/patients-by-risk-group'); // Example API endpoint
            setData(response.data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    return (
        <div>
            <h2>Pie Chart: Percentage of Patients by Risk Group</h2>
            <Pie data={data} />
        </div>
    );
};

export default PieChart;

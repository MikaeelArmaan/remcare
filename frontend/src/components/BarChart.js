// src/components/BarChart.js

import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Bar } from 'react-chartjs-2';

const BarChart = () => {
    const [data, setData] = useState({});

    useEffect(() => {
        fetchData();
    }, []);

    const fetchData = async () => {
        try {
            const response = await axios.get('/api/patients-waiting-by-week-month');
            setData(response.data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    return (
        <div>
            <h2>Bar Chart: Total Patients Waiting by Week and Month</h2>
            <Bar data={data} />
        </div>
    );
};

export default BarChart;

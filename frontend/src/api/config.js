import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api', // Replace with your Laravel API base URL
    timeout: 10000, // Adjust as needed
});

export default instance;
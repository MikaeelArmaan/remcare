// App.js
import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import { AuthProvider } from './contexts/AuthContext';
import Login from './components/Login';
import Dashboard from './components/Dashboard';

function App() {
  return (
    <AuthProvider>
      <Router>
        <div className="App bg-gray-100 min-h-screen">
          <nav className="bg-gray-800 text-white p-4">
            <ul className="flex space-x-4 mx-auto max-w-sm px-2 sm:px-6 lg:px-8">
              <li><Link to="/login" className="hover:text-gray-400">Login</Link></li>
              <li><Link to="/dashboard" className="hover:text-gray-400">Dashboard</Link></li>
            </ul>
          </nav>

          <div className="p-4 mx-auto max-w-container px-4 pt-4 sm:px-6  lg:px-8">
            <Routes>
              <Route path="/login" element={<Login />} />
              {/* <PrivateRoute path="/dashboard" element={<Dashboard />} /> */}
              <Route path="/dashboard" element={<Dashboard />} />
              
              {/* Add more routes as needed */}
            </Routes>
          </div>
        </div>
      </Router>
    </AuthProvider>
  );
}

export default App;

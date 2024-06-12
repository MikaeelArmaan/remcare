// App.js
import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import { AuthProvider, AuthContext } from './contexts/AuthContext';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import PrivateRoute from './routes/PrivateRoute';

function App() {
  return (
    <AuthProvider>
      <Router>
        <div className="App bg-gray-100 min-h-screen ">
          <nav className="bg-gray-800 text-white p-4 ">
            <AuthContext.Consumer>
              {({ isAuthenticated, logout }) => (
                <ul className="flex space-x-4 mx-auto max-w-sm px-2 sm:px-6 lg:px-8">
                  {isAuthenticated ? (
                    <>
                      <li>
                        <Link to="/dashboard" className="hover:text-gray-400">Dashboard</Link>
                      </li>
                      <li>
                        <button onClick={logout} className="hover:text-gray-400">Logout</button>
                      </li>
                    </>
                  ) : (
                    <li>
                      <Link to="/login" className="hover:text-gray-400">Login</Link>
                    </li>
                  )}
                </ul>
              )}
            </AuthContext.Consumer>
          </nav>

          <div className="p-4 mx-auto  max-w-screen-2xl px-4 pt-4 sm:px-6 lg:px-8">
            <Routes>
              <Route path="/login" element={<Login />} />
              <Route path="/dashboard" element={
                <PrivateRoute>
                  <Dashboard />
                </PrivateRoute>
              } />
              {/* Add more routes as needed */}
            </Routes>
          </div>
        </div>
      </Router>
    </AuthProvider>
  );
}

export default App;

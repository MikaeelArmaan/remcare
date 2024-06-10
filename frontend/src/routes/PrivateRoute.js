import React, { useContext } from 'react';
import { Navigate, Route } from 'react-router-dom';
import { AuthContext } from '../contexts/AuthContext';

const PrivateRoute = ({ element, ...rest }) => {
  const { isAuthenticated } = useContext(AuthContext);

  return isAuthenticated ? (
    <Route {...rest} element={element} />
  ) : (
    <Navigate to="/login" replace />
  );
};

export default PrivateRoute;

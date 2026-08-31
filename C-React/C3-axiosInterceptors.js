/*
C3 · Interceptor de Axios con JWT

Requisitos:
1. Agregar a cada petición el JWT guardado en localStorage.
2. Ante una respuesta 401, limpiar la sesión y redirigir a /login.
*/

import axios from 'axios';

// Interceptor de peticiones
axios.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');

    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Interceptor de respuestas
axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response?.status === 401) {
      localStorage.clear();
      window.location.href = '/login';
    }

    return Promise.reject(error);
  }
);

export default axios;
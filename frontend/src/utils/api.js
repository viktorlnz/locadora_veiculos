import axios from 'axios';
import { getToken } from './tokenStorage';
import serverUrl from './serverUrl';

const url = serverUrl() + '/api/v1';

const api = (route, method = 'GET', body = null, contentType= 'application/json') => {
  const token = getToken();

  const headers = {
    'Accept': 'application/json',
    'Authorization': `Bearer ${token}`,
    'Content-Type': contentType
  };

  const axiosConfig = {
    method: method,
    url: url + route,
    headers: headers,
    data: body,
  };

  return axios(axiosConfig)
    .then(response => {
      return response.data;
    })
    .catch(error => {
      throw error;
    });
};

export default api;
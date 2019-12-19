import axios from "axios";

const axiosInstance = axios.create({
  baseURL: process.env.MIX_APP_URL
});

const errorHandler = error => {
  if (error.response.status == 401) {
    window.location.href = "/login";
  }
  return Promise.reject(error);
};

const successHandler = response => {
  return response;
};

axiosInstance.interceptors.response.use(
  response => successHandler(response),
  error => errorHandler(error)
);

export default axiosInstance;

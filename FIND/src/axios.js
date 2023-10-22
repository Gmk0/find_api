
import router from "./router/index.js";
import { useAuthStore } from "./store/index.js";

import axios from "axios";




axios.defaults.withCredentials = true;
const axiosClient = axios.create({
    baseURL: 'http://localhost:8000/api',
})

axiosClient.interceptors.request.use(config => {
    const useAuth = useAuthStore();
    config.headers.Authorization = `Bearer ${useAuth.token}`
    return config;
})

axiosClient.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
       // useAuth.clearToke();
        router.push({ name: 'login' })
    }
    throw error;
})





export default axiosClient;


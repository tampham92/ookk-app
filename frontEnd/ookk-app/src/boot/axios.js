import axios from 'axios'

window.baseURL = "http://localhost:8000/api/";
const api = axios.create({ baseURL: window.baseURL })
api.defaults.headers.common["Authorization"] = "Bearer" + localStorage.getItem("token");

export {api}
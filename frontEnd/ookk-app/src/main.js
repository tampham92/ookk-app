import { createApp } from 'vue'
import router from './router/index.js'
import App from './App.vue'
// import axios from 'axios'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

// window.axios = axios;

const app = createApp(App);
app.use(router);
app.mount('#app');

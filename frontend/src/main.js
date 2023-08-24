import { createApp } from 'vue'

import App from './App.vue'
import router from './router/router'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

import 'bootstrap-icons/font/bootstrap-icons.css';

createApp(App).use(router).mount('#app')

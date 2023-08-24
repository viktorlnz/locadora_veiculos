import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router/router'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

createApp(App).use(router).mount('#app')

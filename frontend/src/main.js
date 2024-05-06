import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { store } from './store';
import Auth from './auth/index';
// import 'bootstrap/dist/css/bootstrap.min.css'
import 'mdb-ui-kit/js/mdb.min.js'

import 'mdb-vue-ui-kit/css/mdb.min.css';

import './fonts/fontawesome-free-6.1.2-web/css/all.min.css'

const app = createApp(App);

app.config.globalProperties.auth = Auth;

app.use(router).use(store).mount('#app')


import { createApp } from "vue";
import App from './App.vue';
import 'mdb-vue-ui-kit/css/mdb.min.css';
import router from "./routes/index.js";
import Auth from './auth/index';
import CKEditor from '@ckeditor/ckeditor5-vue';

const app = createApp(App)

app.config.globalProperties.auth = Auth;

app.use(router).use(CKEditor).mount('#app');

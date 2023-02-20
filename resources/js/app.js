import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'
import {createApp} from "vue";
import axios from "axios";

axios.defaults.baseURL = 'http://localhost:8072/api';
axios.defaults.headers.common['Accept'] = "application/json"
axios.defaults.headers.common['Content-Type'] = "multipart/form-data"

import App from './Components/App.vue'

createApp(App).mount("#app")

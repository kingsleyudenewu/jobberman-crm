import Vue from 'vue';
import App from './App';
import router from './router';
import axios from 'axios';
import VueAxios from 'vue-axios';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);

// axios.defaults.baseURL = '/api/v1/auth';

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

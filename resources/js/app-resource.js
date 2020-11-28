import Vue from 'vue';

import axios from 'axios';
import VueAxios from 'vue-axios';
import store from './store';
import App from './App';
import router from './router';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
axios.defaults.withCredentials = true

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});

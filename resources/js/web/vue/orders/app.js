require('@orders/bootstrap');

// Vue
import Vue from 'vue';
window.Vue = Vue;

// Axios Interceptors
require('vue-axios-interceptors');

// Axios, Vue-Axios
import VueAxios from 'vue-axios';
import axios from 'axios';
window.axios = require('axios');
Vue.use(VueAxios, axios);

// Vue-Axios defaults
Vue.axios.defaults.withCredentials = false;

// Loading indicator
import LoadingIndicator from "@shared/components/ui/LoadingIndicator";
Vue.component('LoadingIndicator', LoadingIndicator);

// Vue-Notifications
import Notifications from 'vue-notification';
Vue.use(Notifications);

import Interceptor from "@shared/mixins/Interceptor";

// Vuex store
import store from '@shared/config/store';

// App component
Vue.component('order-form', require('@orders/views/Order.vue').default);

// Mount App
if (document.getElementById("app-order")) {
  const app = new Vue({
    mixins: [Interceptor],
    store
  }).$mount('#app-order');
}
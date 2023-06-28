require('@posts/bootstrap');

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

import Interceptor from "@shared/mixins/Interceptor";

// Vue-Notifications
import Notifications from 'vue-notification';
Vue.use(Notifications);

import Clipboard from 'v-clipboard';
Vue.use(Clipboard);

// Vuex store
import store from '@shared/config/store';


// App component
Vue.component('post-feed', require('@posts/views/Posts.vue').default);

// Mount App
if (document.getElementById("app-participate")) {
  const app = new Vue({
    mixins: [Interceptor],
    store
  }).$mount('#app-participate');
}
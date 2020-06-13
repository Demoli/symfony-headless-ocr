// import Vue from 'vue'
// import App from './App.vue'
import router from './router'
// import '../scss/app.scss';
//
// Vue.component("v-select", vSelect);
//
// const axios = require("axios").create({
//     baseURL: "http://docker.headless-store.com/api",
//     // headers: {"X-AUTH-TOKEN": "c95352664937759188158ddf56baf9a550c00fff"},
//     timeout: 1000,
// });
// Vue.prototype.$axios = axios;
// new Vue({
//     router,
//     render: h => h(App)
// }).$mount('#app')

import Vue from 'vue';
import App from './components/App';
import '../css/app.css';

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
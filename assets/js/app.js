import Vue from 'vue';
import App from './components/App';
import router from './router'
import '../css/app.css';

const axios = require("axios").create({
    baseURL: "http://docker.ocr-queue.com/api",
    // headers: {"X-AUTH-TOKEN": "c95352664937759188158ddf56baf9a550c00fff"},
    timeout: 1000,
});
Vue.prototype.$axios = axios;

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
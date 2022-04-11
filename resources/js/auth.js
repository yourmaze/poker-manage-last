import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './components/Auth/App.vue';
import Dashboard from './components/Auth/Dashboard.vue';
import Home from './components/Auth/Home.vue';
import Register from './components/Auth/Register.vue';
import Login from './components/Auth/Login.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://m30.tournament-app.ru/api';

const router = new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Home

    },{
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }

    },{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },{
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    }]

});

Vue.router = router

import auth from '@websanova/vue-auth/dist/v2/vue-auth.esm.js';
import driverAuthBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios       from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';
Vue.use(auth, {
    plugins: {
        http: Vue.axios, // Axios
        router: Vue.router,
    },
    drivers: {
        auth: driverAuthBearer,
        http: driverHttpAxios,
        router: driverRouterVueRouter,
    },
})

App.router = Vue.router

new Vue(App).$mount('#app');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

import Vuetify from 'vuetify'
Vue.use(Vuetify)
const opts = {}
const vuetifyComp =  new Vuetify(opts)


import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Form from 'vform'
window.Form = Form;


const routes = [
    {
        path: '/dealers/create',
        component: require('./components/Dealer/DealerCreateComponent').default,
        meta: {
            title: 'Добавление нового дилера',
            requiresAuth: true
        }
    },
    {
        path: '/dealers',
        component: require('./components/Dealer/DealerComponent').default,
        meta: {
            title: 'Управление дилерами',
            requiresAuth: true
        }
    },
];
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((toRoute, fromRoute, next) => {
    if (toRoute.matched.some(toRoute => toRoute.meta.requiresAuth)) {
        if (window.Laravel.user == null) {
            window.location.href = '/login';
        } else {
            next()
        }
    } else {
        window.document.title = toRoute.meta.title;
        document.getElementById('page-title').textContent = toRoute.meta.title;
        next()
    }
})

export default {
    components: {
        router,
        vuetifyComp
    }
}

const app = new Vue({
    Vuetify,
    router
}).$mount('#app');


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');


import Filter from './components/Charts/ChartComponent'



const app = new Vue({
    render: h => h(Filter)
}).$mount('#app');


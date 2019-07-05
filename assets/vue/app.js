import Vue from 'vue';

Vue.component('new-event-component', require('./components/new-event-component').default);
Vue.component('agenda-list', require('./views/AgendaList').default);

new Vue({}).$mount('#app')

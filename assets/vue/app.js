window.Vue = require('vue');

Vue.component('new-event-component', require('./components/new-event-component').default);

const app = new Vue({
    el: "#app"
});
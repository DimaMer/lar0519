import Vue from 'vue';
import test  from './components/ExampleComponent.vue';


import VueResource from 'vue-resource';
Vue.use(VueResource);
new Vue({

    el: '#app',


    components: {
        test },



});
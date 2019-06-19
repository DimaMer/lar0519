import Vue from 'vue';
import test  from './components/viewVacancyComponent.vue';
import VueResource from 'vue-resource';
Vue.use(VueResource);
new Vue({
    el: '#app',
    components: {
        test
    },
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueMeta from 'vue-meta';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import StoreData from './store/store';
import {routes} from './routes/routes';
import {initialize} from './helpers/general';
import Moment from 'vue-moment';



Vue.use(Moment);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueMeta);


const store = new Vuex.Store(StoreData);

const router = new VueRouter({
  routes,
  mode:'history'
});

initialize(store, router);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding Layouts components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import LayoutApp from './layouts/LayoutApp.vue';


const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
      LayoutApp
    }
});

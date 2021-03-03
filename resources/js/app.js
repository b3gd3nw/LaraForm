/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header_map', require('./components/Header.vue').default);
Vue.component('step-one', require('./components/First_step').default);
Vue.component('step-two', require('./components/Second_step').default);
Vue.component('reg-form', require('./components/Reg_form').default);
Vue.component('social', require('./components/Social').default);
Vue.component('all_members', require('./components/All_members').default);


import Vue from 'vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

import VueCookie from 'vue-cookie'
// Tell Vue to use the plugin
Vue.use(VueCookie);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from "./router";
const app = new Vue({
    el: '#app',
    router
});

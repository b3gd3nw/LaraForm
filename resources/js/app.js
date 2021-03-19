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
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

import VueCookie from 'vue-cookie'
// Tell Vue to use the plugin
Vue.use(VueCookie);


//------Notifications----------
import Notifications from 'vue-notification'

Vue.use(Notifications)


//------VeeValidate----------
import { Validator} from 'vee-validate';
import {ValidationProvider, extend, ValidationObserver} from 'vee-validate';
import { required, email, max, min, mimes, alpha_spaces, size, regex } from 'vee-validate/dist/rules';
import { localize } from 'vee-validate';

localize({
    en: {
        fields: {
            firstname: {
                max: 'Enter no more than 20 characters',
            },
            lastname: {
                max: 'Enter no more than 20 characters',
            },
            reportsubject: {
                max: 'Enter no more than 200 characters',
            },
            company: {
                max: 'Enter no more than 200 characters',
            },
            position: {
                max: 'Enter no more than 200 characters',
            },
            aboutme: {
                max: 'Enter no more than 200 characters',
            },

        }
    }
});
// Vue.use(ValidationProvider);
// Add a rule.
// No message specified.
extend('email', email);

extend('regex', regex);

// Override the default message.
extend('required', {
    ...required,
    message: 'This field is required'
});

extend('max', {
    ...max,
    firstname: {
        message: 'Enter no more than 20 characters'
    },
    lastname: {
        message: 'Enter no more than 20 characters'
    },
    reportsubject: {
        message: 'Enter no more than 200 characters'
    }
});
extend('min', min);
extend('mimes', {
    ...mimes,
    message: 'Try again with png or jpg file'
});
extend('alpha_spaces', {
    ...alpha_spaces,
    message: 'Use only letters and one language, please'
});

extend('size', {
    ...size,
    message: 'Max photo size 2MB'
});

// Register it globally
Vue.component('ValidationProvider', ValidationProvider).default;
Vue.component('ValidationObserver', ValidationObserver).default;
//------VeeValidate----------

import Datepicker from 'vuejs-datepicker';

export default {
    disabled: {
        "from": "2021-03-05T12:53:00.000Z"
    },
    // ...
    components: {
        Datepicker
    }
    // ...
}
Vue.component('datepicker', Datepicker).default;

import PhoneMaskInput from  "vue-phone-mask-input";

Vue.component('phone-mask-input', PhoneMaskInput).default;

import ResetInput from 'v-reset-input'

Vue.use(ResetInput)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from "./router";
const app = new Vue({
    el: '#app',
    router,
});

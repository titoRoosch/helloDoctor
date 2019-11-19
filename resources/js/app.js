/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


Vue.component('specialties-list', require('./components/specialties/SpecialtiesListComponent.vue').default);
Vue.component('specialties-register', require('./components/specialties/SpecialtiesRegisterComponent.vue').default);
Vue.component('specialties-update', require('./components/specialties/SpecialtiesUpdateComponent.vue').default);

Vue.component('doctors-list', require('./components/doctor/DoctorListComponent.vue').default);
Vue.component('doctors-register', require('./components/doctor/DoctorRegisterComponent.vue').default);
Vue.component('doctors-update', require('./components/doctor/DoctorUpdateComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

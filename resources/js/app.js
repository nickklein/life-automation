/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import vueResource from 'vue-resource';
Vue.use(vueResource);

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('navigation', require('./components/NavigationComponent.vue').default);
Vue.component('passport-clients',require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue').default);
Vue.component('devices-list',require('./components/devices/Devices.vue').default);
Vue.component('device-settings-list', require('./components/devices/DeviceSettings.vue').default);
Vue.component('device-jobs-list',require('./components/devices/DeviceJobs.vue').default);
Vue.component('life-weather',require('./components/WeatherComponent.vue').default);
Vue.component('categories-list',require('./components/shopping/CategoriesComponent.vue').default);
Vue.component('news-sources',require('./components/news/NewsSourcesComponent.vue').default);
Vue.component('news-tags',require('./components/news/NewsTagsComponent.vue').default);
Vue.component('news-list',require('./components/news/NewsListComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

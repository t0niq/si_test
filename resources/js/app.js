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
import store from './store'

import VModal from 'vue-js-modal'
import '@kouts/vue-modal/dist/vue-modal.css';
import VueTagsInput from '@johmun/vue-tags-input';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect)
Vue.component('tasks-component', require('./components/TasksComponent.vue').default);
Vue.component('task-edit-component', require('./components/TaskEditComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Tag', VueTagsInput);

Vue.use(VModal, { dialog: true })

const app = new Vue({
    store,
    el: '#app',
    components: {
      }
});


require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router'
import Vue from 'vue'
import routes from "./routes"
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueMaterial)
Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)



const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});

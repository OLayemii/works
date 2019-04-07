import Vue from 'vue'
import App from './App.vue'
import Vuetify from 'vuetify'
import VeeValidate from 'vee-validate'
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
import routerParams from './router/index.js';
import VueRouter from 'vue-router'


Vue.config.productionTip = false
Vue.use(Vuetify)
Vue.use(VeeValidate)
Vue.use(VueRouter)

let router = new VueRouter(routerParams);

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')

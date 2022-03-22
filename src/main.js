import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueMask from 'v-mask'


import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import vuetify from './plugins/vuetify'

Vue.use(VueMask)

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


Vue.config.productionTip = false

Vue.filter ('formatProduct', function(producto) {
  return producto.split('_').map(palabra => palabra.charAt(0).toUpperCase() + 
  palabra.slice(1).toLowerCase()).join(' ');
}),

Vue.filter('formatPrecio', function(precio) {
  return `$${precio.toFixed(2)}`
}),


Vue.filter('formatVencimiento',function(vencimiento) {
  return vencimiento.toLocaleString('ES-es')
}),

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')

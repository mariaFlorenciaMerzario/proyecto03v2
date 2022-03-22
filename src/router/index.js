import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/HomeView.vue'

Vue.use(VueRouter)

const routes = [

  {
    path: '/',
    name: 'Home',
    component: Home
  },
  
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */ '../views/LoginView.vue')
  },

  {
    path: '/tarjeta/:totalVar',
    name: 'Tarjeta',
    component: () => import(/* webpackChunkName: "tarjeta" */ '../views/TarjetaView.vue')
  },

  {
    path: '/carrito',
    name: 'Carrito',
    component: () => import(/* webpackChunkName: "carrito" */ '../views/CarritoView.vue')
  },  
]

const router = new VueRouter({
  routes
})

export default router

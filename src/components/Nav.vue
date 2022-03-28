<template>
    <div>
        <v-toolbar xxs>
            <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Mi App</v-toolbar-title>
            <v-spacer></v-spacer>

            <div v-if="sessionStorageUsuario">
                <v-btn class="btn btn-link nav-link padding-8" @click="logout">Cerrar Sesión</v-btn>
            </div>
            <div v-else>
                <v-btn class="btn btn-link nav-link padding-8 w-50 m-3" @click="irLogin">Login</v-btn>
            </div>

        </v-toolbar>
                                            <!-- v-model esta en verdadero pero puede deshabilitarse -->
        <v-navigation-drawer xxs v-model="drawer" temporary>
              <div>
                <v-btn class="btn btn-link nav-link padding-8 w-50 m-3" @click="irHome">Home</v-btn>
                <!-- <router-link to="/" class="p-3">Home</router-link> -->
            </div>

            <div>
                <v-btn class="btn btn-link nav-link padding-8 w-50 m-3" @click="irCarrito">Carrito</v-btn>
                <!-- <router-link to="/carrito"></router-link> -->
            </div>

        </v-navigation-drawer>
     
      <!-- <router-link to="/">Home</router-link>
        <div v-if="sessionStorageUsuario">
        <button class="btn btn-link nav-link padding-8" @click="logout">Cerrar Sesión</button>
         <router-link to="/login">Logout</router-link> |  -->
        <!-- </div>
        <div v-else>
            <router-link to="/login">Login</router-link>
        </div>

        <router-link to="/carrito">Carrito</router-link>  --> 

        <router-view/>
    </div>
</template>

<script>

import {mapState} from 'vuex'

//import FetchPost from './components/Home.vue'
export default ({
    name:'Nav',
    data(){
      return{
          drawer:true,
      }
  },

  computed:{
      ...mapState([
          'sessionStorageUsuario',
          'loginVar',  
      ]),
    },

  methods:{
   
      logout() {
     
          sessionStorage.removeItem('usuario_email'); 
          localStorage.removeItem('arrayLocalStorage'); 

      //    commit('loginVar', true)    
          // commit('sessionStorageUsuario', false)
          this.$router.push('/login')
      },
      irHome() {
            
            this.$router.push('/')
        },

      irLogin() {
        
        this.$router.push('/login')
        },
     irCarrito() {
            
            this.$router.push('Carrito')
       },
       
    }
})

</script>


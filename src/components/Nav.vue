<template>
    <div>
        <v-toolbar xxs>
       
            <v-toolbar-title>
              <v-img
                    :src="require('../assets/logo.png')"
                    contain
                    width="60"
                />
              </v-toolbar-title>
                   <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon>
            <v-spacer></v-spacer>

            <div v-if="sessionStorageUsuario == true">
                <v-btn class="btn btn-link nav-link padding-8" @click="logout">{{this.emailVar}}
                       Cerrar Sesión</v-btn>
            </div>
            <div v-if="sessionStorageUsuario == false">
                <v-btn class="btn btn-link nav-link padding-8 w-50 m-3" 
                @click="irLogin">Login</v-btn>
            </div>

        </v-toolbar>
                                            <!-- v-model esta en verdadero pero puede deshabilitarse -->
        <v-navigation-drawer xxs v-model="drawer" temporary>
              <div>
                <v-btn class="btn btn-link nav-link padding-8 w-50 m-3" @click="irHome">Home</v-btn>
            </div>

            <div>
                <v-btn class="btn btn-link nav-link padding-8 w-50 m-3" @click="irCarrito">Carrito</v-btn>
            </div>
        </v-navigation-drawer>
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

    mounted(){
        this.emailVar = this.$store.commit('sessionEmailVar',sessionStorage.getItem("usuario_email"))
     
   
      if(this.emailVar == null){
            this.$store.commit('sessionStorageUsuario', false)    
           
        }else{
            this.$store.commit('sessionStorageUsuario', true)   
        }
    },
  methods:{
   
      logout() {
     
          sessionStorage.removeItem('usuario_email'); 
          localStorage.removeItem('arrayLocalStorage'); 

           this.$store.commit('cambiarLoginVar', false)    
           this.$store.commit('sessionStorageUsuario', false)
           this.$store.commit('loginVar', true)    

           this.$router.push('/login')
      },

      irHome() {

        this.$router.replace({ name: "Home"}).catch(()=>{
             'misma ruta'
         });

      },

      irLogin() {
          this.$router.replace({ name: "Login"}).catch(()=>{
             'misma ruta'
         });
        },
     irCarrito() {    
           this.$router.replace({ name: "Carrito"}).catch(()=>{
             'misma ruta'
         });       },
       
    }
})

</script>


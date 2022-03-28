<template>
  <div class="ma-12 pa-12 d-flex">
    <v-card class="m-auto my-4 p-2">
  
    <template>
        <table class="table">
            <thead>
                <td class="p-2">Producto</td>
                <td class="p-2">Precio</td>
                <td class="p-2">Cant</td>
                <td class="p-2">Subtotal</td>
            </thead>
            <tbody>
                <tr v-for="(producto,i) in this.arrayProductosDeStorage" :key="i" >
                    <td class="text-start p-3">{{ producto.nombre_storage }}</td>
                    <td class="text-start p-3">${{ producto.precio_storage }}</td>
                    <td class="text-start p-3">{{ producto.cantidad_storage}}</td>
                    <td class="text-start p-3">${{producto.precio_storage * producto.cantidad_storage}}</td>
                    
                    <td> 
                      <!-- se abre la modal -->
                      <!-- <div data-app>
                          <Modal
                              :producto="producto.nombre_storage" 
                              :data-toggle="modal"  />
                      </div> -->

                    </td>
                </tr>
                <tr class="p-2 d-flex justify-content-end">
                  <td>Total: ${{total()}}.-</td>
                </tr>
            </tbody>
           
        </table>
        <div v-if="this.carritoLleno == true">
          <router-link 
              :to="{ name:'Home'}">
          </router-link>
       </div>
      </template>

    <div v-if="this.logueado == 'true'">
      <div class="bg-success p-1"> 
        <router-link 
            :to="{ name: 'Tarjeta', params: {totalVar: total()}}">
            <button class="text-white">
              Pagar
            </button>
        </router-link>
      </div>
    </div>
               
    <div v-if="this.logueado == 'false'">
      <div class="bg-warning p-2">
        <button @click="login"> Link aquí para registro y pagar</button>
          <router-link
            :to="{ name: 'Login'}">
          </router-link>
      </div>
    </div>
   </v-card>
 </div>
</template>

<script>

import Modal from '../components/Modal.vue';

  export default {

     name: 'Carrito',
     data:() => ({
             arrayProductosDeStorage:[], 
             carritoLleno:false,
             dialog:true,
             logueado:'',
             modal:'modal',
        }),
        components:{
          Modal
        },

    // cuando los datos ya se encuentran disponibles
    created()
        {
            let data = localStorage.getItem("arrayLocalStorage");
            if(data != null)
            {
                this.arrayProductosDeStorage = JSON.parse(data);
                this.carritoLleno = true;
                console.log('created en carro')
            }   
            let usuario_session = sessionStorage.getItem('usuario_email');
         
            if(usuario_session == '' || usuario_session == null){
              this.logueado = 'false' 
                
            }else{
              this.logueado = 'true'
                
            }
        },
     //se ejecuta al insertar el DOM o cuando el
    //componente o la vista se muestra en la pagina
    mounted()
        {
        },
     
    //se ejecuta cuando detecta cambios
    beforeUpdate(){
            let data = localStorage.getItem("arrayLocalStorage");
            if(data != null)
            {
              this.arrayProductosDeStorage = JSON.parse(data);
            }             
     },

     methods:{
        total: function(){  
          let totalVar=0;
          let array=[];
          let i=0;
          let data = localStorage.getItem("arrayLocalStorage");
            if(data != null)
            {
              array = JSON.parse(data);
             
                for (i=0; i < array.length; i++) {
                  totalVar = array[i].precio_storage * array[i].cantidad_storage + totalVar;   
              }
                  return totalVar
          }
        },

          delete: function(){
               this.arrayProductosDeStorage.forEach((element, index) => {
                if (element.email === this.producto.email_storage) {
                      
                      this.arrayProductosDeStorage.splice(index,1)
                }
  })
          },
          carrito() {
              this.$router.push('Carrito')
          },

          login() {
            this.$router.push('Login')
          },

        pagar: function(){
          this.dialog = false;
          let usuario_session = sessionStorage.getItem('usuario_email');
         
            if(usuario_session == '' || usuario_session == null){
              this.logueado = 'false' ;

           
            }else{
              
              this.logueado = 'true';    
              let totalVr=0;
              let array=[];
              let i=0;
              let data = localStorage.getItem("arrayLocalStorage");
                if(data != null)
                {
                  array = JSON.parse(data);
                    for (i=0; i < array.length; i++) {
                      totalVr = array[i].precio_storage * array[i].cantidad_storage + totalVr;        
                     }
                       
                 /*    this.$router.push({
                        name: 'Tarjeta',
                        params: { pathMatch: totalVr },
                      })
                 */
                   this.$router.push({ name: 'Tarjeta', params: { totalVar: totalVr} })
                }
          }
        }
     }
  
  }
</script>


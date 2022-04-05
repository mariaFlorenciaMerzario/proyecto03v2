
<template>
<div>
  <div v-if="this.carritoProcesado == false" class="row">
  <table class="table table-striped border_gray border-rounded w-75 m-auto my-2">
  <tr class="border_gray">
      <td class="text-secondary font-09">Nombre</td>
      <td class="text-secondary font-09">Precio</td>
      <td class="text-secondary font-09">Cant</td>
      <td class="text-secondary font-09">Subtotal</td>
      <td class="text-secondary font-09">Eliminar</td>

  </tr>
   <tr v-for="(item, i) in this.arrayProductosDeStorage" :key="i">
    
        <td class="text-secondary font-08 col-3">{{item.nombre_storage}}</td>
        <td class="text-secondary font-08 col-2">$ {{item.precio_storage}}</td>
        <td class="w-25 text-center w-25 col-3">
          <input :id="item.nombre_storage" v-on:change="modificarCant(item)" 
          class="font_08 w-50 text-center font-08 text-danger " 
          :value="item.cantidad_storage"
            type="text">
        </td>
        <!-- subtotal --> 
         <td class="w-25 text-center text-secondary font-08 col-2" :id="'subtotal'+item.nombre_storage" >$ {{item.precio_storage * item.cantidad_storage}}</td>
         <td>
            <div data-app>
                <Modal
                    :producto="item.nombre_storage" 
                    :data-toggle="modal"
                />
            </div>
        </td>
  </tr>
</table>
      <div v-if="this.loginVar == true">
        <button type="button" @click="grabarCarro()" class="btn btn-primary">Confirmar</button>
      </div>
      <div v-if="this.loginVar == false">
        <div class="rosaAlert p-2 w-50 m-auto">Tenés que loguearte para confirmar tu carrito</div>
      </div>
  </div>

      <div v-if="this.carritoProcesado == true">
        <div class="bg-success p-2 w-50 m-auto">El carrito fué procesado con Exito solo resta realizar el pago</div>
      </div>
</div>

</template>
<script>

import {mapState} from 'vuex'
import Modal from '../components/Modal.vue';

  export default {

     name: 'Carrito',
     data:() => ({
             arrayProductosDeStorage:[], 
             carritoLleno:false,
             dialog:true,
             logueado:'',
             modal:'modal',
             cantidad_modificada:0,
             cont: 0,
             carritoProcesado:false,
            
             headers:[
               {text: 'Producto', value:'nombre_storage'},
               {text: 'Precio', value:'precio_storage'},
               {text: 'Cantidad', value:'cantidad_storage'},
               {text: 'Subtotal', value:''},
               {text: 'Eliminar', value:''},
             ],
       }),  

        computed:{
        ...mapState([
            'banderita',
            'loginVar',

          ]),  

           subtotal(){
              let subtotal = this.arrayProductosDeStorage.precio_storage *
              this.arrayProductosDeStorage.cantidad_storage
              return{
                subtotal
              }
           },
      }, 
        components:{
          Modal
        },

    // cuando los datos ya se encuentran disponibles
    created()
        {
            let data = localStorage.getItem("arrayLocalStorage");
            if(data.length > 0)
            {
                this.arrayProductosDeStorage = JSON.parse(data);
                this.carritoLleno = true;
                this.$store.commit('banderita', true)
            }else{

               this.$store.commit('banderita', false)
              // alert('false, estoy en carrito.vue false de data.length')
            } 
            let usuario_session = sessionStorage.getItem('usuario_email');
         
            if(usuario_session == '' || usuario_session == null){
                this.$store.commit('loginVar', false)    
  
            }else{
               this.$store.commit('loginVar', true)    

                
            }
          //  alert('123')
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
            //  alert('hola aca no entra')
              this.arrayProductosDeStorage = JSON.parse(data);
              this.$store.commit('banderita', true)
           }             
      },

     methods:{
        total: function(){  
          let totalVar=0;
          let array=[];
          let i=0;
          let data = localStorage.getItem("arrayLocalStorage");
        //  alert('aca estoy en methods carrito1')
            if(data != null)
          //  alert('aca estoy en methods carrito2')
            {
              array = JSON.parse(data);
                for (i=0; i < array.length; i++) {
                  totalVar = array[i].precio_storage * array[i].cantidad_storage + totalVar;   
              }
                  return totalVar
          }
        },
          asignarCant(item){
                console.log(item)
          },
      
          carrito() {
              this.$router.push('Carrito')
          },

          login() {
              this.$router.push('Login')
          },

           modificarCant(item) {
           
            let datoDiv = 'subtotal'+item.nombre_storage

             //this.cantidad_modificada = item.cantidad_storage
            //alert(this.$refs.this.datoDiv); 
            
            //document.getElementById(datoDiv).innerHTML = item.cantidad_storage
            let cant_modificada = document.getElementById(item.nombre_storage).value
            let subTotal = cant_modificada * item.precio_storage
            document.getElementById(datoDiv).innerHTML = '$ '+subTotal
          
             //grabo el cambio en localstorage
            let data = localStorage.getItem("arrayLocalStorage");
            this.arrayLocalStorage = JSON.parse(data);
              for (let i = 0; i < this.arrayLocalStorage.length; i++) {
                if(this.arrayLocalStorage[i].nombre_storage == item.nombre_storage){
                   this.arrayLocalStorage[i].cantidad_storage = cant_modificada
                  localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))                    
                    }//cierra el if
                  } //cierra el for

          },


        edit(){
          this.dialog = false;
          let data = localStorage.getItem("arrayLocalStorage");
          this.arrayLocalStorage = JSON.parse(data);

              for (let i = 0; i < this.arrayLocalStorage.length; i++) {
                if(this.arrayLocalStorage[i].nombre_storage == this.nombre){
                    this.arrayLocalStorage[i].cantidad_storage = this.cantidadModificada
                    + this.arrayProductosDeStorage[i].cantidad_storage
                  alert('Cantidad modificada')
                    
                    }//cierra el if
                  } //cierra el for
           
                //nombre en el localStorage
              localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))
              this.nombre_storage = ""
              this.descripcion_storage = ""
              this.precio_storage = ""
              this.cantidad_storage = ""
              this.imagen_storage = ""     
        },
          //fin metodo edit

        grabarCarro: function(){
          this.dialog = false;
          let usuario_session = sessionStorage.getItem('usuario_email');

            if(usuario_session == '' || usuario_session == null){
                this.$store.commit('loginVar', false)    

            }else{
             
              this.$store.commit('loginVar', true)    
              let arrayCarrito=[]
              let data = localStorage.getItem("arrayLocalStorage");
              arrayCarrito = JSON.parse(data);
                if(arrayCarrito.length != null)
                {
                  arrayCarrito[0].email=usuario_session;
                  let carritoVar = {
                    method: 'POST',
                    body: JSON.stringify(arrayCarrito),
                    headers: {
                        'Content-Type': 'application/json'
                          },
                    }
                    fetch('http://localhost:81/coder/proyecto03v2/api/carritos.php',carritoVar)
                      .then(response => response.json())
                      .then(respons => {   
                        if(respons.success === true){ 
                          alert('true')    
                          window.localStorage.removeItem('arrayLocalStorage')
                            this.carritoProcesado = true;

                        //    this.$router.go('/carrito')  
                          }else{ 
                            this.carritoProcesado = false; 
                        }             
                    })
                }
               }
            } 
        }      
                  //calculo el subtotal de cada linea 
                
                 //   for (i=0; i < array.length; i++) {
                  //    subtotal = array[i].precio_storage * array[i].cantidad_storage + subtotal;        
                    
                       
                 /*    this.$router.push({
                        name: 'Tarjeta',
                        params: { pathMatch: subtotal },
                      })
                 */
                  // this.$router.push({ name: 'Carrito', params: { totalVar: subtotal} })
          
  
  }
</script>


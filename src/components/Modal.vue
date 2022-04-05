<template>
  <v-row class="center m-1 w-25">
    <v-dialog
      v-model="dialog"
      class="shadow-none"
    >
      <template v-slot:activator="{ on, attrs }" class="box">
        <v-btn class="m-auto m-1 w-25"
          v-bind="attrs"
          v-on="on"
        >
       <i class="fa fa-trash text-danger">
       </i>
        </v-btn>
      </template>


      <v-card class="w-25 m-auto">
        <v-card-title class="text-h5 text-danger bold">
          Atención
        </v-card-title>
       
        <v-card-text> Estás seguro de eliminar el producto?.</v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
              <v-btn
                color="green darken-1"
                class="bg-primary text-white m-3"
                text
                @click="eliminar"
              >
                Confirmar
              </v-btn>
              <v-btn
                class="bg-danger text-white"
                text
                @click="dialog = false"
              >
                Cancelar
              </v-btn>
          </v-card-actions>
      </v-card>
    </v-dialog>

  </v-row>
</template>


<script>

import {mapState} from 'vuex'
  export default {
    name: 'Modal',
    props: ['producto'],

    data: () => ({
       dialog: false,
    }),
      computed:{
      ...mapState([
          'carritoVacio',
          'banderita'
      ]),
    },
     
     methods:{
       eliminar() {

        let data = localStorage.getItem("arrayLocalStorage");
         this.arrayLocalStorage = JSON.parse(data);
         
          for (let i = 0; i < this.arrayLocalStorage.length; i++) {
            if (this.arrayLocalStorage[i].nombre_storage === this.producto) {
                this.arrayLocalStorage.splice(i,1)
               
               if( this.arrayLocalStorage.length ==0 ){
                  window.localStorage.removeItem('arrayLocalStorage')
                 this.$store.commit('banderita', false)
                }else{
                  localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))    
                }
            }
          }

        //chequeo si el carro esta vacio o sino recargo la pag
        let data2 = localStorage.getItem("arrayLocalStorage");
         this.arrayLocalStorage = JSON.parse(data2);
      
          if(this.arrayLocalStorage.length ==0){
            this.$store.commit('banderita', false)
            //aviso que el carro esta vacio
          }else{
             location.reload()
          }
          
        },
       },
     }
  
</script>

<template>
<div>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="450"
    >
      <template v-slot:activator="{ on, attrs }">

        <v-list-item link
          v-bind="attrs"
          v-on="on"
        >
            <v-list-item-title>Comprar</v-list-item-title>
           </v-list-item>
      </template>
 
      <v-card>
           <v-card-title class="text-h5">
          {{nombre}}
          </v-card-title>
      
           <v-card-text>
              {{descripcion}}
           </v-card-text>

            <v-card-text>
              ${{precio}}-
           </v-card-text>

          <!-- inicia el select -->

          <label>Cantidad</label>
          <v-select 
              v-model="cantidad" 
              :items="cantidadNumeros" 
              item-text="cantidad"
              class="w-25 m-auto"
          ></v-select>

           <!-- termina el select -->
            <v-card-text>
              Total: ${{precio * this.cantidad}}-
           </v-card-text>
           <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="agregarAlCarrito">
            Agregar
           <!-- enviar info a carrito -->
            <!-- <Carrito /> -->
          </v-btn>
          <v-btn
            color="green darken-1"
            text
            @click="dialog = false">
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-row>
    <!-- <div v-if="this.arrayLocalStorage != null">
      <div v-for="(storage, i) in arrayLocalStorage" :key="i">
          {{storage.nombre}}
          {{storage.cantidad}}
      </div>
    </div> -->
    <div v-if="this.carritoLleno">
      <router-link 
          :to="{ name:'Home'}">
      </router-link>
    </div>
</div>
</template>

<script>

//import Split from './Split.vue'

 export default {
      name: 'ModalComprar',
      Components:{
     
      
      },
   props: ['nombre','descripcion','precio','imagen','array','carritoVacio'],

      data () {
        return {
          dialog: false,
          valid:true,  
          cantidadNumeros:[1,2,3,4,5,6,7,8,9,10],
          selected:'',
          cantidad:0,
          resultado:0,
          arrayLocalStorage:[],
          nombre_storage: '',
          descripcion_storage: '',
          precio_storage: '',
          cantidad_storage: '',
          imagen_storage: '',
          carritoLleno: false,
 
        }
    },
    created(){
        //busca la informacion en localStorage
        let data = localStorage.getItem("arrayLocalStorage");
        if(data != null){
          this.arrayLocalStorage = JSON.parse(data);
          this.carritoLleno = true 
        }
     },
 
  methods:{ 
          agregarAlCarrito: function(){
          
          this.dialog = false;
          
          this.arrayLocalStorage.push(
          {
            nombre_storage:this.nombre,
            descripcion_storage:this.descripcion,
            precio_storage:this.precio,
            cantidad_storage:this.cantidad,
            imagen_storage:this.imagen
        }
        );
                              //nombre en el localStorage
          localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))
          this.nombre_storage = ""
          this.descripcion_storage = ""
          this.precio_storage = ""
          this.cantidad_storage = ""
          this.imagen_storage = ""
         
        }

          
          
     },
     
 }
</script>




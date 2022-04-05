<template>
<div>
  <v-row class="m-0 justify-content-center bg-transparente">
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
            <v-list-item-title>Ver Más</v-list-item-title>
           </v-list-item>
      </template>

      <v-card>
           <v-card-title class="text-h5 text-secondary">
            {{nombre}}
            </v-card-title>
        
            <v-card-text class="text-secondary">
                {{descripcion}}
            </v-card-text>

              <v-card-text class="text-secondary">
                Precio Unitario: ${{precio}}-
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
                Importe Total: $ {{precio * this.cantidad}} .-
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
import {mapState} from 'vuex'

 export default {
      name: 'ModalComprar',
      Components:{   
      },
       computed:{
      ...mapState([
          'banderita'
      ]),
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
          nombreRepetido: false,
 
        }
    },
    created(){
        //busca la informacion en localStorage
        let data = localStorage.getItem("arrayLocalStorage");
        if(data != null){
         // alert('AcA carga el home')
          this.arrayLocalStorage = JSON.parse(data);
          this.carritoLleno = true 
        }
     },
 
  methods:{ 
         agregarAlCarrito: function(){
            this.dialog = false;
            let data = localStorage.getItem("arrayLocalStorage"); 
            this.arrayLocalStorage = JSON.parse(data); 

            if(this.arrayLocalStorage === null || this.arrayLocalStorage.length === 0){
              this.arrayLocalStorage=[];
              alert('soy null')
              alert(this.arrayLocalStorage)

                this.arrayLocalStorage.push(
                      {
                        'nombre_storage': this.nombre,
                        'descripcion_storage': this.descripcion,
                        'precio_storage': this.precio,
                        'cantidad_storage': this.cantidad,
                        'imagen_storage': this.imagen
                    });
                        this.nombre_storage = ""
                        this.descripcion_storage = ""
                        this.precio_storage = ""
                        this.cantidad_storage = ""
                        this.imagen_storage = ""
                        this.nombreRepetido = true,
                        localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))
            }
           alert(this.arrayLocalStorage.length)
            if(this.arrayLocalStorage != null ||  this.arrayLocalStorage.length != 0 || this.arrayLocalStorage.length != 0){
              this.arrayLocalStorage = JSON.parse(data);
               for (let i = 0; i < this.arrayLocalStorage.length; i++) {
               
                if(this.nombre == this.arrayLocalStorage[i].nombre_storage){
                    this.arrayLocalStorage[i].cantidad_storage =
                    this.arrayLocalStorage[i].cantidad_storage
                    +this.cantidad;
                  
                   // const itemAModificar = data.find(item=>item.nombre_storage === this.arrayLocalStorage[i].nombre_storage)
                  //  itemAModificar.cantidad_storage = this.cantidad_storage

                    localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))

                      this.nombre_storage = ""
                      this.descripcion_storage = ""
                      this.precio_storage = ""
                      this.cantidad_storage = ""
                      this.imagen_storage = ""

                      this.$store.commit('banderita', true)
                      this.nombreRepetido = true;
                      alert('repetido!!!')
                      break
                    }//cierra el if
                   } //cierra el for
                  
              if(this.nombreRepetido === false){
                alert('nombreRepetido = false')
                this.arrayLocalStorage.push(
                {
                  'nombre_storage': this.nombre,
                  'descripcion_storage': this.descripcion,
                  'precio_storage': this.precio,
                  'cantidad_storage': this.cantidad,
                  'imagen_storage': this.imagen
              });
                  this.nombre_storage = ""
                  this.descripcion_storage = ""
                  this.precio_storage = ""
                  this.cantidad_storage = ""
                  this.imagen_storage = ""

                  localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))
              }
            }   
         },
    }
  }
</script>




<template>
<div>

  <v-container>
     <div>   
      <v-row  
        no-gutters
        style="height: 150px;"
        class="d-flex text-center justify-content-center"
      >
       <v-col cols="6" sm="1" md="3" 
           v-for="(producto, i) in productos" :key="i"
         >
            <v-card
                  :loading="loading"
                   max-width="300"
                   class="p-4 text-center d-flex justify-content-center flex-column align-items-center"
                >
                  <template slot="progress">
                    <v-progress-linear
                      color="deep-purple"
                      height="10"
                      indeterminate
                    ></v-progress-linear>
                  </template>

                  <v-img
                    height="250"
                    :src='producto.imagen'
                    v-model="imagenPadre"
                  ></v-img>

                  <v-card-title>
                     <input type="text" class="text-center" :id="nombrePadre" :nombrePadre='producto.nombre'
                      :value='producto.nombre' />
                  </v-card-title>

                   <v-card-text class="p-2">
                    <v-row
                      align="center"
                      class="mx-0"
                    >   
                    </v-row>

                    <!-- <v-card-text>
                       <textarea type="text" id="descripcionPadre" :descripcionPadre="producto.descripcion"
                        :value='producto.descripcion' class="bg-light p-3">
                      </textarea>
             
                    </v-card-text> -->
                   $ <input type="text" class="text-center" id="precioPadre" :precioPadre="producto.precio"
                      :value='producto.precio'/>
                    </v-card-text>
   <!-- aca empieza la modal -->
       <template>
            <div data-app class="m-2">
             <v-row>
              <v-dialog
                v-model="dialog"
                persistent
                max-width="290"
              >
                <template v-slot:activator="{ on, attrs }" >
                  <v-btn 
                    color="primary"
                    dark
                    v-bind="attrs"
                    v-on="on"
                     
                  >
                    <ModalComprar
                        :nombre='producto.nombre'
                        :descripcion='producto.descripcion'
                        :precio='producto.precio'
                        :imagen='producto.imagen'
                        :dialog='false'   
                        :array='productos'
                        :carritoVacio='0'
                        >
                    </ModalComprar>
                  </v-btn>
                </template>
              </v-dialog>
            </v-row> 
            </div>          
          </template>
   <!-- aca termina la modal -->
            </v-card>
        </v-col>
      </v-row>
     </div>
  </v-container>
</div>
</template>

<script>


import {mapState, mapMutations, mapActions} from 'vuex'
import ModalComprar from '../components/ModalComprar.vue'
//import Carrito from '../components/Carrito.vue'

export default {
    name: 'Home',
    components:{
        ModalComprar,
     //   Carrito
    },

      computed:{
      ...mapState([
          'productos',
          'productoInicial',
         
      ]),
    },

    data: () => ({
              posts:[],
              loading: false,
              selection: 1,
              dialog:false, 
              nombrePadre:'',
              descripcionPadre:'',
              precioPadre:'',
              imagenPadre:'',
              carritoVacio: 0,
              banderita: false,
           
              arrayProductos:[
              { 
                producto_id:'',
                nombre: '',
                precio: '',
                descripcion: '',
                categoria: '',
                imagen:''
              },
             ],
              arrayProductosDeStorage:[
                {
                  producto_id:'',
                  nombre: '',
                  precio: '',
                  descripcion: '',
                  categoria: '',
                  imagen:''
                }
              ],

               alignments: [
                'start',
                'center',
                'end',
             ],
    }),

    mounted(){
        
        let data = localStorage.getItem("arrayLocalStorage");
        if(data != null){
          this.arrayProductosDeStorage = JSON.parse(data);
          //this.banderita = true;
        }
        this.cargarProductos();
     },

    //se ejecuta al insertar el DOM o cuando el
    //componente o la vista se muestra en la pagina
     created(){
      /*console.log('created en home')
      let productoVar = {
          
              method: 'GET',
              body: JSON.stringify(),
              credentials: 'include',
              headers: {
                  'Content-Type': 'application/json',
              },
          }
      fetch('http://localhost:81/coder/03proyecto/api/productos.php',
      productoVar)

        .then(response => response.json())
        .then(response => {
             this.arrayProductos = response.data
        })
             console.log(this.arrayProductos)
             return this.arrayProductos
     }, 
     */
     },
     
 
      beforeUpdate(){
         
      },

      beforeMounted(){
        let data = localStorage.getItem("arrayLocalStorage");
          if(data != null)
          {
              this.arrayProductosDeStorage = JSON.parse(data);  
          }
      },

      methods:{
          ...mapMutations([
          ]),
          ...mapActions([
              'cargarProductos'

          ]),
          mostrarModal: function(){
              return document.getElementById('UserCreate').modal('show');
          },
          
          alertCarro: function(){
            alert('alert carro en home')
          }
        },
  }
</script>

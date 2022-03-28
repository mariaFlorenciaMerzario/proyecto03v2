<template>

  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="290"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-bind="attrs"
          v-on="on"
          class="bg-transparent"
        >
           <i class="fa fa-trash text-danger">
       </i>
        </v-btn>
      </template>


      <v-card>
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

  export default {
    name: 'Modal',
    props: ['producto'],

    data: () => ({
       dialog: false,
    }),
     
     methods:{
       eliminar() {

        let data = localStorage.getItem("arrayLocalStorage");
         this.arrayLocalStorage = JSON.parse(data);
         
          for (let i = 0; i < this.arrayLocalStorage.length; i++) {
            if (this.arrayLocalStorage[i].nombre_storage === this.producto) {
                this.arrayLocalStorage.splice(this.arrayLocalStorage[i],1)
                localStorage.setItem("arrayLocalStorage", JSON.stringify(this.arrayLocalStorage))    
            }
        }

        //chequeo si el carro esta vacio o sino recargo la pag
        /*let data = localStorage.getItem("arrayLocalStorage");
         this.arrayLocalStorage = JSON.parse(data);
         if(this.arrayLocalStorage.length >0){
            location.reload()
         }else{
           this.carritoVacio = true;
         }*/
        },
       
       
          // for (let i = 0; i < this.arrayLocalStorage.length; i++) {
         //     if(this.arrayLocalStorage[i].nombre_storage == this.producto){
          //        this.arrayLocalStorage[i].splice(index, 1)
           //       }//cierra el if
            //    } //cierra el for
          
       },
     }
  
</script>

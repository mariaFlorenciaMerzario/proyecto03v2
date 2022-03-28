<template>
    <div>  
        <div v-if="this.banderita == true">
             <div class="h3 m-5"> Tu Carrito de Compras: </div>
            <Carrito/>
        </div>

        <div v-if="this.banderita == false">
             <div class="h3 m-5 rosaAlert"> Tu carrito de compras aún está vacío </div> 
        </div>
    </div>
</template>

<script>
import Carrito from '@/components/Carrito.vue'

export default {
    components: {
        Carrito
    },
    data () {
        return {
            banderita:false
        }
    },

    mounted(){
        let data = localStorage.getItem("arrayLocalStorage");
        if(data != null){
          this.banderita = true;
        }
     },
   
    methods: {
     
    }
}
</script>
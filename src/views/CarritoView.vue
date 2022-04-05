<template>
    <div>  
        <div v-if="this.banderita == true" class="d-flex justify-content-center flex-column align-items-center">
            
             <div class="h3 m-3 bg-secondary p-3 text-white w-50"> Tu Carrito de Compras: </div>
            <Carrito/>
        </div>

        <div v-if="this.banderita == false" class="bg-primary d-flex justify-content-center">
             <div class="h3 m-5 rosaAlert w-25"> Tu carrito de compras está vacío 
                <router-link :to="{ path: '/' }">
                    <button>Ir a Home</button>
                </router-link>
            </div> 
        </div>
    </div>
</template>


<script>
import {mapState} from 'vuex'
import Carrito from '@/components/Carrito.vue'

export default {
    components: {
        Carrito
    },
    data () {
        return {
           
        }
    },

    computed:{
      ...mapState([
          'banderita',
      ]),
    },

    mounted(){
        let data = localStorage.getItem("arrayLocalStorage");

        if(data.length){
            this.$store.commit('banderita', true)    
        }else{
            this.$store.commit('banderita', false)
        }
     },
   
    methods: {
     
    }
}
</script>
<template>
<v-card class="w-50 m-auto my-4">

  <div v-if="this.camposVacios === true" class="rosaAlert p-3">
      Debés completar todos los campos
  </div>
  

    <div v-if="this.loginVar === false" class="rosaAlert p-3">
      Las credenciales no son correctas, volvé a intentarlo      
  </div>

   <div v-if="this.regVar === true" class="bg-warning text-white p-3">
       <p>Bienvenido</p>
  </div>
  
  <div v-else>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            class="p-3"
        >
            <v-text-field
            v-model="usuarioLogin.nombre"
            :counter="10"
            :rules="nameRules"
            label="Name"
            required
            ></v-text-field>

            <v-text-field
            v-model="usuarioLogin.email"
            :rules="emailRules"
            label="E-mail"
            required
            ></v-text-field>
 
        <v-text-field
            v-model="usuarioLogin.password"
            :counter="10"
            :rules="nameRules"
            label="Password"
            required
            >
         </v-text-field>

        <v-btn
            color="green darken-1"
            text
            class="bg-primary m-3 text-white"
            @click="obtenerUsers"
        >
            Login
        </v-btn>

          <v-btn 
            @click="reset"   
          >
            Reseteo
        </v-btn>

        <!-- <v-btn
            color="green darken-1"
            text
            @click="crearUsers"
            class="bg-warning m-3"
        >
            Registro
        </v-btn>     -->
          <div class="text-primary pt-3 d-block ">
              <button @click="registro"> 
                 Hacé click acá si no estás registrado
              </button>   
          </div>

    </v-form>
  </div>
</v-card>
</template>

<script>


import {mapState, mapMutations, mapActions} from 'vuex'
  export default {
    components: { 
         },  
         
    name: 'Login',

    computed:{
      ...mapState([
          'usuarios',
          'loginVar',        
          'usuarioLogin',  
          'regVar',
          'camposVacios'
      ]),
    },

    data: () => ({
      valid: true,
      dialog:false,
      //regVar:'',
      //loginVar:'',
    /*  usuario:{
              nombre:'',
              email:'',
              password:''
          },
      */
   //     camposVacios: false,
        respuesta:'',
        status:false,
        usuariosPosts:[],
        logVar:'',
      /*nombre:'',
      email:'',
      password:'', */ 
      nameRules: [
        v => !!v || 'El campo es requerido',
        v => (v && v.length <= 10) || 'Debe contener no mas de 10 caracteres',
      ],
      emailRules: [
        v => !!v || 'E-mail es requerido',
        v => /.+@.+\..+/.test(v) || 'E-mail con formato inválido',
      ],
     
    }),

     methods:{
            ...mapMutations([
           
            ]),
            ...mapActions([
                'obtenerUsers',
                'crearUsers'
            ]),
/*
      crear(){
              this.$refs.form.validate()
              if(this.usuario.nombre == '' || this.usuario.email == '' || this.usuario.password == ''){
                this.camposVacios = true; 
              }else{
              let usuarioVar = {
                method: 'POST',
              //  mode: 'no-cors',
                body: JSON.stringify(this.usuario),
                headers: {
                    'Content-Type': 'application/json'
                },
          }

            fetch('http://localhost:81/coder/02proyecto/api/usuarios.php',usuarioVar)
              .then(response => response.json())
              .then(respons => {
                
                if(respons.success == true){
                  
                    this.regVar = true;
                    this.$router.go('/login')  
                  }else{ 
                    this.regVar = false; 
                  }
                
              })
          }
      },*/

  /*      loginGo(){
            let usuarioVar = {
          
              method: 'post',
              body: JSON.stringify(this.usuario),
              credentials: 'include',
              headers: {
                  'Content-Type': 'application/json',
              },
          }

          fetch('http://localhost:81/coder/02proyecto/api/login.php',usuarioVar)
        
          .then(res => res.json())
          .then(res => {
                    
              if(res.success == 'true'){
                sessionStorage.setItem("usuario_email", this.usuario.email)
                
                this.$router.push({name:'Home'})  

              }else{ 
                this.loginVar = false;

              }
            
          })
        },

         /*linkCarrito(){
          this.loginVar === true? this.$router.push('Home'):null;
    },
    */
        
        irHome() {
            this.regVar = true;  
            this.$router.push('Home')
        },
        validate () {
          this.$refs.form.validate()
        },
        
        reset () {
          this.$refs.form.reset()
        },

        registroTrue () {
          return this.registroVar = true;
        },
        registro() {
            this.$store.commit('cambiarLoginVar', false) 
            this.$store.commit('usuarioExiste', false)    
            this.$router.push('Registro')
          },
      
      },
    }
  
  
</script>
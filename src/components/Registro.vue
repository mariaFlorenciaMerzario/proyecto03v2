<template>
<v-card class="w-50 m-auto my-4">

  <p v-if="this.camposVacios === true" class="rosaAlert p-3 text-white">
      Debés completar todos los campos
  </p>
  
  <p v-if="usuarioExiste" class="rosaAlert p-3">Ya existe un usuario registrado con ese Email</p>
  <div>
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
            label="Nombre"
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

        <v-text-field
            v-model="usuarioLogin.passwordTwo"
            :counter="10"
            :rules="nameRules"
            label="Confirmar Password"
            required
            >
        </v-text-field>
        <p v-if="usuarioLogin.password != usuarioLogin.passwordTwo" class="rosaAlert p-2">
                Las password deben coincidir
            </p>
        
        
        <div v-if="usuarioLogin.password == usuarioLogin.passwordTwo">    
            <v-btn
                color="green darken-1"
                text
                class="bg-primary m-3 text-white"
                @click="crearUsers"
            >
                Registro
            </v-btn>
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
         
    name: 'Registro',

    computed:{
      ...mapState([
          'usuarios',
          'usuarioLogin',  
          'regVar',
          'camposVacios',
          'usuarioExiste',  
      ]),
    },

    data: () => ({
        valid: true,
        dialog:false,
        respuesta:'',
        status:false,
        usuariosPosts:[],
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
            this.$router.push('Registro')
          },
      
      },
    }
  
  
</script>
import Vue from 'vue'
import Vuex from 'vuex'
import router from '../router'


Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    usuarios:[],
    productos:[],
    pagos:[],
    emailVar:'',
    usuarioLogin:
          {
              nombre:'',
              email:'',
              password:'',
              passwordTwo:''
          },

    productoInicial:
          {
              nombre:'',
              descripcion:'',
              precio:'',
              cantidad:'',
              imagen:'',
              categoria:''        
          },

    pagoInicial:
          {
             total:'',
             email:'',   
          },

    loginVar:'',
    regVar:'',
    camposVacios:'',
    usuarioExiste:'',
    sessionStorageUsuario:'',
  },
  

    mounted(){
      
    },

  mutations: {
    llenarUsers(state, userActions){
      //aca guardo la repuesta del commit
      state.usuarios = userActions
    },

    createUsers(state, userActions){
      //aca guardo la repuesta del commit
      state.usuarios = userActions
    },

    cargarProducts(state, productsAction){
      //aca guardo la repuesta del commit
      state.productos = productsAction
    },

    createPayment(state, paymentAction){
      //aca guardo la repuesta del commit
      state.pagos = paymentAction
    },

    cambiarRegVar(state, valueRegVar){
      //aca guardo la repuesta del commit
      state.regVar = valueRegVar
    },

    cambiarCampos(state, valueCamposVacios){
      //aca guardo la repuesta del commit
      state.camposVacios = valueCamposVacios
    },

    cambiarLoginVar(state, valueLoginVar){
      //aca guardo la repuesta del commit
      state.loginVar = valueLoginVar
    },

    usuarioExiste(state, valueUsuarioExiste){
      //aca guardo la repuesta del commit
      state.usuarioExiste = valueUsuarioExiste
    },

    loginVar(state, valueLoginVar){
      //aca guardo la repuesta del commit
      state.loginVar = valueLoginVar
    },

    sessionStorageUsuario(state, valueSession){
      let data = localStorage.getItem("arrayLocalStorage");
      if(data != null){
        state.sessionStorageUsuario = valueSession
      }
    }
  },
  actions: {
    //llamo a la API

    async crearUsers( {commit}){
      if(this.state.usuarioLogin.nombre == '' || this.state.usuarioLogin.email == ''
           || this.state.usuarioLogin.password == ''){
            commit('cambiarCampos', true)

          }else{
       
            let url = 'http://localhost:81/coder/proyecto03v2/api/usuarios.php';
            
            let usuarioVar = {
            method: 'POST',
          //  mode: 'no-cors',
            body: JSON.stringify(this.state.usuarioLogin),
            headers: {
                'Content-Type': 'application/json'
            },
          }

          const response = await fetch(url,usuarioVar)
          const usuarios = await response.json();

          if(usuarios.success == true){
           // router.go({name:'Login'})
           
            sessionStorage.setItem("usuario_email", this.state.usuarioLogin.email)  
              this.emailVar = sessionStorage.getItem("usuario_email");
              commit('cambiarLoginVar', true)
              commit('cambiarRegVar', true)
              commit('cambiarCampos', false)
              commit('loginVar', true)
              commit('sessionStorageUsuario', true)
              commit('createUsers', usuarios)
              
              router.push({name:'Home'})

            }else{ 

              commit('usuarioExiste', true)
            }        
          //obtengo el resultado y lo muestro (parametro llamado commit   
      } 
     // asi se llama la mutation, y usuarios es el segundo parametro
    },

    //funcion para el login
    async obtenerUsers( {commit}){

      if(this.state.usuarioLogin.nombre == '' || this.state.usuarioLogin.email == ''
           || this.state.usuarioLogin.password == ''){
       //this.camposVacios = true; 
        commit('cambiarCampos', true)
      }else{

        let url = 'http://localhost:81/coder/proyecto03v2/api/login.php';
      
        let usuarioVar = {
            
          method: 'post',
          body: JSON.stringify(this.state.usuarioLogin),
          credentials: 'include',
          headers: {
              'Content-Type': 'application/json',
          },
        }
            const response = await fetch(url,usuarioVar)
            const usuarios = await response.json();

            if(usuarios.success == 'true'){
             
              sessionStorage.setItem("usuario_email", this.state.usuarioLogin.email)  
              this.emailVar = sessionStorage.getItem("usuario_email");
              commit('cambiarLoginVar', true)
              commit('cambiarRegVar', true)
              commit('sessionStorageUsuario', true)
              router.push({name:'Home'})


            }else{ 
              commit('cambiarCampos', false)
              commit('cambiarRegVar', false)
              commit('loginVar', false)

            }
           
        //obtengo el resultado y lo muestro (parametro llamado commit)
      commit('llenarUsers', usuarios)
      // asi se llama la mutation, y usuarios es el segundo parametro
      }
    },

      async cargarProductos( {commit}){

        commit('cambiarRegVar', false)

        console.log('cargando productos')
        let url = 'http://localhost:81/coder/proyecto03v2/api/productos.php';

        let productoVar = {
            
          method: 'GET',
          body: JSON.stringify(),
          credentials: 'include',
          headers: {
              'Content-Type': 'application/json',
          },
      }

        const response = await fetch(url,productoVar)
        const productos = await response.json();
            
            console.log('this cargar productos')
            console.log(this.state.productoInicial)
      
        //obtengo el resultado y lo muestro (parametro llamado commit)
      commit('cargarProducts', productos.data)
        },
// crear pago
    async crearPago( {commit}){ 
      this.state.pagoInicial.email = sessionStorage.getItem("usuario_email");
      
        let totalVar=0;
        let array=[];
        let i=0;
        let data = localStorage.getItem("arrayLocalStorage");
          if(data != null)
          {
            array = JSON.parse(data);
           
              for (i=0; i < array.length; i++) {
                totalVar = array[i].precio_storage * array[i].cantidad_storage + totalVar;   
            }
      
        this.state.pagoInicial.total =  totalVar;
        let url = 'http://localhost:81/coder/proyecto03v2/api/pagos.php';
    
        console.log('pago inicial email')
        console.log(this.emailVar)

        console.log('store,pago.email')
        console.log( this.state.pagoInicial.email)

        let pagoVar = {
        method: 'POST',
      //  mode: 'no-cors',
        body: JSON.stringify(this.state.pagoInicial),
        headers: {
            'Content-Type': 'application/json'
        },
      }
      const response = await fetch(url,pagoVar)
      const pagos = await response.json();

      
      if(pagos.success == 'true'){
          this.pagoReg = true;
          alert('pago exitoso')
          /**************************** */
        //  this.$router.push('/pago')  
          // no funciona ***********************************
        }else{ 
           /**************************** */
           this.pagoReg = false;
       //    this.$router.push('/pago')  
           alert('pago no realizado')

           // no funciona ***********************************
        }
          console.log('this pago registrado')
          console.log(this.state.pagoVar)
      //obtengo el resultado y lo muestro (parametro llamado commit)
    commit('createPayment', pagos)
      }
    
    // asi se llama la mutation, y usuarios es el segundo parametro
    }

  },
  modules: {
  }
})

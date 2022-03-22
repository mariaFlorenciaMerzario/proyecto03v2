<template>
  <div id="app">
    <div class="my-3">
   <!-- AGREGA LOS ACCESSO -->
      <router-link to="/">Home</router-link> | 
      <router-link to="/login">Login</router-link> | 
      <router-link to="/carrito">Carrito</router-link> 
    </div>
  <router-view/>

  </div>
    <!-- MUESTRA LAS VISTAS -->
</template>

<script>


//import FetchPost from './components/Home.vue'
export default ({
  //components: { Home },
 
})
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>

<template>
  <div>
    <router-view :email="this.$route.params.email"/>
  </div>
</template>

<script>
export default {
  name: "App",
  components: {
  },

};
</script>
<style >
#app {
  font-family: Roboto, Helvetica, Arial, sans-serif;
  background-color: linear-gradient(to right, #c1e8ce4e 20%, #c1e8ce72 50%, #c1e8ceb8);
}
a{
  cursor: pointer;
}
nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}
.home{
    position: relative;
    min-height: 100vh;
    padding: 0px 0px 100px 0px;
  }
  #footer{
    position: absolute;
    margin-top: 20%;
    bottom: 0;
    width: 100%;
  }
/* nav a.router-link-exact-active {
  color: #42b983;
} */
</style>

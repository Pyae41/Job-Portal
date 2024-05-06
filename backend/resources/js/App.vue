<template>
  <router-view></router-view>
</template>

<script>
export default {
  name: "App",
  components: {}
};
</script>

<style lang="css">
#app {
  font-family: Roboto, Helvetica, Arial, sans-serif;
}

body {
  background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}
.ck-editor__editable {
  min-height: 200px;
}
.ck-editor__editable:focus {
  border-color: #14a44d !important;
}
/* .ck.ck-editor__editable{
  border: 1px solid #dc4c64 !important;
} */
.form-control:focus {
  border-color: #14a44d !important;
}
</style>

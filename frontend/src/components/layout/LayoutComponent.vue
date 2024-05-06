<template>
  <div class="home">
        <NavComponentVue/>
        <slot/>

        <FooterComponentVue/>
  </div>
</template>

<script>
import FooterComponentVue from '../Partials/FooterComponent.vue';
import NavComponentVue from '../Partials/NavComponent.vue';


export default {
    name: 'LayoutComponent',
    components: {
        NavComponentVue,
        FooterComponentVue
    }
}
</script>

<style>

</style>
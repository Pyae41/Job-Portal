<template>
  <div>
    <LayoutComponentVue>
      <AccInfoComponent/>
    </LayoutComponentVue>
  </div>
</template>

<script>
import LayoutComponentVue from '@/components/layout/LayoutComponent.vue'
import AccInfoComponent from '@/components/accInfo/AccInfoComponent.vue';

export default {
  name: 'AccInfoView',
  components:{
    LayoutComponentVue,AccInfoComponent
  }
}
</script>

<style lang="scss" scoped>

</style>
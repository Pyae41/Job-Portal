<template>
    <div>
      <LayoutComponentVue>
        <AppliedJobsComponent/>
      </LayoutComponentVue>
    </div>
  </template>
  
  <script>
  import LayoutComponentVue from '@/components/layout/LayoutComponent.vue'
  import AppliedJobsComponent from '@/components/Jobs/AppliedJobsComponent.vue'
  
  export default {
    name: 'AppliedJobsView',
    components:{
      LayoutComponentVue,AppliedJobsComponent
    }
  }
  </script>
  
  <style scoped>
  
  </style>
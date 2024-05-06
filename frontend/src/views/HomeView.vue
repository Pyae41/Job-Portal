<template>
  <LayoutComponentVue>
    <BannerComponentVue />
    <JobsComponent />
  </LayoutComponentVue>
</template>

<script>
import BannerComponentVue from "../components/Partials/BannerComponent.vue";
import JobsComponent from "@/components/Jobs/JobsComponent.vue";
import LayoutComponentVue from "@/components/layout/LayoutComponent.vue";
import router from "@/router";

export default {
  name: "HomeView",
  data() {
    return {};
  },
  mounted(){
  },
  methods:{

  },
  components: {
    LayoutComponentVue,
    BannerComponentVue,
    JobsComponent,
  },
};
</script>

<style scoped>
</style>
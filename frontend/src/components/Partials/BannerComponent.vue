<template>
  <div class="main-head text-center">
    <div class="mt-4 font-display">
      HMM Project<br class="" />
      for the Job<span class="high_light"> Portal</span> System
    </div>
  </div>
</template>

<script>

export default {
  name: "BannerComponent",
  data() {
    return {
    };
  },
  mounted() {
  },
  methods: {
  },
};
</script>

<style scoped>

.high_light {
  color: #13b955;
}
@media screen and (min-width: 375px) {
  .col-sm-4 {
    margin-top: 5px;
  }
  .font-display{
    margin-top: 30px !important;
    font-size: xx-large;
    font-weight: 600;
    margin-bottom: 30px;
  }
}
@media screen and (min-width: 978px) {
  .col-sm-4 {
    margin-top: 5px;
  }
  .font-display {
  font-size: 70px;
  font-weight: 600;
  margin-bottom: 50px;
}

}
</style>
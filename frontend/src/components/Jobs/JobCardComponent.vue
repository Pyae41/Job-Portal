<template>
  <div class="card mb-5">
    <div class="card-title p-3">
      <div class="badge badge-success badge-sm float-end mt-3">{{ job.job_type.job_type }}</div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-12 d-flex justify-content-center mb-3">
          <img
            :src="job.company.company_logo"
            alt=""
            class="rounded-circle"
            width="100"
            height="100"
          />
        </div>
        <div class="col-sm-12 col-md-6 col-lg-12 mb-3" style="display: grid; place-items: center">
          <small style="font-size: smaller" class="text-muted">{{
            job.company.name
          }}</small>
          <h5 class="text-center">{{ job.job_position }}</h5>
          <small style="font-size: smaller" class="text-muted text-truncate"
            ><i class="fas fa-map-marker-alt me-2"></i
            >{{ job.company.address }}</small
          >
        </div>
        <div class="col-12">
          <div class="d-flex justify-content-between mt-3">
            <p class="">{{ job.salary }}</p>
            <router-link :to="`/jobs/jobDetail/${job.id}`" class="text-success"
              >View details <i class="fa-solid fa-arrow-right"></i
            ></router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "JobCardComponent",
  props: ["job"],
  mounted(){
  }
};
</script>

<style scoped>
.card{
  border: 1px solid transparent;
  transition: .3s all ease-in-out;
}
.card:hover {
  border-color:#13b955 !important;
}
</style>
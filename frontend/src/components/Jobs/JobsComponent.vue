<template>
  <div class="container">
    <form
      class="search-box mt-2 d-flex justify-content-center"
      @submit.prevent="filterJobs"
    >
      <div class="card border-secondary mb-3 filter-box w-75">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-4 mb-2 mt-2">
              <select
                name=""
                id=""
                class="form-select mdbInput"
                @change="filterData.category_name = $event.target.value"
              >
                <option value="" hidden selected>Choose Category</option>
                <option
                  :value="category.name"
                  v-for="category in categories"
                  :key="category.index"
                >
                  {{ category.name }}
                </option>
              </select>
            </div>
            <div class="col-sm-4 mb-2 mt-2">
              <select name="" id="" class="form-select mdbInput" @change="filterData.job_type = $event.target.value">
                <option value="" hidden selected>Choose Job Type</option>
                <option
                  :value="jobtype.job_type"
                  v-for="jobtype in jobtypes"
                  :key="jobtype.index"
                >
                  {{ jobtype.job_type }}
                </option>
              </select>
            </div>
            <div class="col-sm-4 mb-2 mt-2">
              <div class="row">
                <div class="col-12 col-md-6 mb-2">
                  <button class="btn btn-success w-100"><i class="fas fa-magnifying-glass"></i></button>
                </div>
                <div class="col-12 col-md-6">
                  <button class="btn btn-secondary w-100" @click="clearFilter"><i class="fas fa-arrows-rotate"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="text-center mt-5">
      <h1 class="">Latest Jobs</h1>
      <p class="">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim ipsum
        perspiciatis sequi provident,<br />praesentium corrupti officiis atque.
        Fugit provident voluptates iure eveniet non rerum iusto fuga ut. Harum,
        iste impedit?
      </p>
    </div>
    <div class="row mt-5">
      <div
        class="col-sm-12 col-md-6 col-lg-3"
        v-for="(job, index) in jobposts.data"
        :key="index"
      >
        <JobCardComponentVue :job="job" />
      </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
      <router-link to="/jobs" class="btn btn-success">See more</router-link>
    </div>
  </div>
</template>

<script>
import { filter } from "@/fonts/fontawesome-free-6.1.2-web/js/v4-shims";
import JobCardComponentVue from "./JobCardComponent.vue";
import Apicalls from "@/api/index";
export default {
  name: "JobsComponent",
  data() {
    return {
      jobposts: [],
      categories: [],
      jobtypes: [],
      filterData: {
        category_name: "",
        job_type: "",
      },
    };
  },
  components: {
    JobCardComponentVue,
  },
  mounted() {
    this.getJobPosts();
    this.getCategories();
    this.getJobTypes();
  },
  methods: {
    getJobPosts(page = 1) {
      Apicalls.get(`frontend/jobPost?page=${page}`).then((response) => {
        if (response.status == 200) {
          this.jobposts = response.data.jobPosts;
          console.log(this.jobposts);
          if(response.data.current_page<response.data.last_page){
            
          }
        }
      });
    },
    getCategories() {
      Apicalls.get("frontend/category").then((response) => {
        if (response.status == 200) {
          this.categories = response.data.categories;
        }
      });
    },
    getJobTypes() {
      Apicalls.get("frontend/jobType").then((response) => {
        if (response.status == 200) {
          this.jobtypes = response.data.jobTypes;
        }
      });
    },
    filterJobs() {
      let formData = new FormData();
      formData.append("category_name", this.filterData.category_name);
      formData.append("job_type", this.filterData.job_type);
      console.log(formData);
      Apicalls.post("frontend/jobPost/search",formData).then((response) => {
        if (response.status == 200) {
          this.jobposts = response.data.jobPosts;
        }
      });
    },
    clearFilter(){
      window.location.href = '/';
    }
  },
};
</script>

<style scoped>
@media screen and (max-width: 768px) {
  .col-md-3 {
    margin-top: 5px;
  }
}
.mdbInput:focus {
  border-color: #14a44d;
  box-shadow: 0 0 0 0.1rem #14a44e4a;
}
</style>
<template>
  <LayoutComponentVue>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-lg-3 mb-3">
          <JobsFilterComponent />
        </div>
        <div class="col-12 col-lg-9">
          <div class="row">
            <div
              class="col-12 col-lg-4"
              v-for="(job, index) in jobposts.data"
              :key="index"
            >
              <JobCardComponent :job="job" />
            </div>
            <div class="text-center" v-show="moreExists">
              <!-- <button class="btn btn-success" v-if="isLoading">
                <span
                  class="spinner-border spinner-border-sm"
                  role="status"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Loading...</span>
              </button> -->
              <button class="btn btn-success"  @click.prevent="loadMore">
                <i class="fas fa-arrow-down"></i> Load More
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LayoutComponentVue>
</template>

<script>
import LayoutComponentVue from "@/components/layout/LayoutComponent.vue";
import JobCardComponent from "@/components/Jobs/JobCardComponent.vue";
import JobsFilterComponent from "@/components/Jobs/JobsFilterComponent.vue";
import ApiCalls from "@/api/index.js";
export default {
  name: "JobsView",
  data() {
    return {
      jobposts: [],
      moreExists: true,
      currentPage: 1,
      lastPage: 1,
      isLoading: false,
    };
  },
  components: {
    LayoutComponentVue,
    JobCardComponent,
    JobsFilterComponent,
  },
  mounted() {
    this.getJobPosts();
  },
  methods: {
    getJobPosts() {
      ApiCalls.get("frontend/jobPost").then((response) => {
        if (response.status == 200) {
          this.jobposts = response.data.jobPosts;
        }
      });
    },
    getCategories() {
      ApiCalls.get("frontend/category").then((response) => {
        if (response.status == 200) {
          this.categories = response.data.categories;
        }
      });
    },
    getJobTypes() {
      ApiCalls.get("frontend/jobType").then((response) => {
        if (response.status == 200) {
          this.jobtypes = response.data.jobTypes;
        }
      });
    },
    loadMore() {
      this.currentPage++;
      ApiCalls.get(`frontend/jobPost?page=${this.currentPage}`).then(
          (response) => {
            if (response.status === 200) {
              console.log(response.data.jobPosts.data);
              console.log(this.jobposts);
              // response.data.jobPosts.data.forEach((data) => {
              //   this.jobposts.data.push(data);
              //  });
              if(response.data.jobPosts.data.length != 0){
                  this.jobposts.data = [...this.jobposts.data,...response.data.jobPosts.data];
              }

              // Update the current page and check if there are more job posts to load

              if (this.currentPage < response.data.jobPosts.last_page) {
                this.moreExists = true; // No more job posts to load
              } else {
                this.moreExists = false;
              }
            }
          }
        );
    },
  },
};
</script>

<style scoped>

</style>
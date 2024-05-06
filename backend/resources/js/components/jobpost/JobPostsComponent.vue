<template>
  <LayoutComponent>
    <div class="container p-3">
      <h3>Job Posts List</h3>
      <router-link to="/admin/jobpost/add" class="btn btn-sm btn-success">Post a job</router-link>

      <FilterBoxComponent @search="search" @refresh="getJobPosts" :placeholder="'Search Job Posts'" />
    </div>

    <div
      class="d-flex justify-content-center align-items-center"
      v-if="isLoading"
      style="height: 500px;"
    >
      <div class="spinner-border text-success" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div v-else-if="fetchError" style="height: 500px;display:grid;place-items:center;">
      <div>
        <i class="fas fa-exclamation-triangle me-2 text-danger"></i>
        <span class="text-uppercase">{{ fetchErrorMessage}}</span>
        <br />
        <button class="btn btn-sm btn-danger mt-2" @click="retry">
          <i class="fas fa-rotate-right me-2"></i>Retry
        </button>
      </div>
    </div>

    <div v-else>
      <table class="table text-center mt-3">
        <thead class="table-success">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Job Position</th>
            <th scope="col">Company</th>
            <th scope="col">Deadline</th>
            <th scope="col">Action</th>
            <th scope="col">Active</th>
          </tr>
        </thead>
        <tbody>
          <JobPostComponent
            v-for="(jobpost, index) in jobposts.data"
            :key="index"
            :jobpost="jobpost"
            :index="jobposts.from + index"
            @statusChange="updateStatus($event,jobpost.id)"
          />
        </tbody>
      </table>
    </div>
    <div class="fixed-bottom">
      <PaginationComponent :data="jobposts" @paginate="getJobPosts" />
    </div>
  </LayoutComponent>
</template>

<script>
import LayoutComponent from "../Layouts/LayoutComponent.vue";
import JobPostComponent from "./JobPostComponent.vue";
import ApiCalls from "../../api/index.js";
import PaginationComponent from "../Layouts/Partials/PaginationComponent.vue";
import router from "../../routes";
import FilterBoxComponent from "../Layouts/Partials/FilterBoxComponent.vue";

export default {
  name: "JobTypesComponent",
  components: {
    LayoutComponent,
    PaginationComponent,
    JobPostComponent,
    FilterBoxComponent
  },
  data() {
    return {
      jobposts: [],
      isLoading: true,
      fetchError: false,
      fetchErrorMessage: "Something Wrong",
      urlCheck: "jobPost"
    };
  },
  mounted() {
    this.getJobPosts();
  },
  methods: {
    getJobPosts(page = 1) {
      this.urlCheck = "jobPost";
      if (this.isLoading) {
        setTimeout(() => {
          ApiCalls.get(`admin/jobPost?page=${page}`)
            .then(response => {
              if (response.status == 200) {
                this.isLoading = false;
                this.jobposts = response.data.jobPosts;
              }
            })
            .catch(error => {
              this.isLoading = false;
              this.fetchError = true;

              if (error.response.status == 401) {
                this.auth.logout();

                alert("Session timeout");

                router.push("/login");
              }
            });
        }, 1000);
      } else {
        ApiCalls.get(`admin/jobPost?page=${page}`)
          .then(response => {
            if (response.status == 200) {
              this.jobposts = response.data.jobPosts;
            }
          })
          .catch(error => {
            this.isLoading = false;
            this.fetchError = true;

            if (error.response.status == 401) {
              this.auth.logout();

              alert("Session timeout");

              router.push("/login");
            }
          });
      }
    },
    updateStatus(checked, id) {
      let status = checked ? "Active" : "Inactive";
      console.log(id,checked);
      ApiCalls.update(`admin/jobPost/${id}`, { status: status }).catch(
        error => {
          console.log(error);
        }
      );
    },
    retry() {
      this.isLoading = true;
      this.fetchError = false;
      this.searchData = "";
      this.getJobPosts();
    },
    search(searchData,page = 1) {
      this.urlCheck = "jobPost/search";

      let formData = new FormData();
      this.searchData = searchData
      formData.append("searchData", this.searchData);

    //   this.isLoading = true;

      setTimeout(() => {
        ApiCalls.post(`admin/jobPost/search?page=${page}`, formData)
          .then(response => {
            console.log(response.data);
            if ((response.status = 200)) {
            //   this.isLoading = false;
              this.jobposts = response.data.jobpost;
            }
          })
          .catch(error => {
            this.isLoading = false;
            this.fetchError = true;

            let err = error.response.data;

            if ((err.status = 404)) {
              this.fetchErrorMessage = err.message;
            }
          });
      }, 500);
    }
  }
};
</script>

<style>
</style>

<template>
  <LayoutComponent>
    <div class="container p-3">
      <h3>Job Type List</h3>
      <router-link to="/admin/jobtype/add" class="btn btn-sm btn-success">Add Job Type</router-link>
      <FilterBoxComponent @search="search" @refresh="getJobTypes" :placeholder="'Search Job Type'" />
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
        <span class="text-uppercase">Error</span>
        <br />
        <button class="btn btn-sm btn-danger mt-2" @click="retry">
          <i class="fas fa-rotate-right me-2"></i>Retry
        </button>
      </div>
    </div>
    <table class="table text-center mt-3" v-else>
      <thead class="table-success">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Job Type</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <JobTypeComponent
          v-for="(jobtype, index) in jobtypes.data"
          :key="index"
          :jobtype="jobtype"
          :index="jobtypes.from + index"
          @deleteJT="deleteJobType(jobtype.id)"
        />
      </tbody>
    </table>
    <div class="fixed-bottom">
      <PaginationComponent :data="jobtypes" @paginate="getJobTypes" />
    </div>
  </LayoutComponent>
</template>

<script>
import LayoutComponent from "../Layouts/LayoutComponent.vue";
import JobTypeComponent from "./JobTypeComponent.vue";
import ApiCalls from "../../api/index.js";
import PaginationComponent from "../Layouts/Partials/PaginationComponent.vue";
import FilterBoxComponent from "../Layouts/Partials/FilterBoxComponent.vue";

export default {
  name: "JobTypesComponent",
  components: {
    LayoutComponent,
    PaginationComponent,
    JobTypeComponent,
    FilterBoxComponent
  },
  data() {
    return {
      jobtypes: [],
      isLoading: true,
      fetchError: false
    };
  },
  mounted() {
    this.getJobTypes();
  },
  methods: {
    getJobTypes(page = 1) {
      if (this.isLoading) {
        setTimeout(() => {
          ApiCalls.get(`admin/jobType?page=${page}`)
            .then(response => {
              if (response.status == 200) {
                this.isLoading = false;
                this.jobtypes = response.data.jobTypes;
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
        ApiCalls.get(`admin/jobType?page=${page}`)
          .then(response => {
            if (response.status == 200) {
              this.jobtypes = response.data.jobTypes;
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
    deleteJobType(id) {
      let message = confirm("Are you sure to delete?");

      if (message) {
        ApiCalls.delete(`admin/jobType/${id}`)
          .then(response => {
            if (response.data.status == 200) {
              this.getJobTypes();
            }
          })
          .catch(error => {
            alert("Sorry");
          });
      }
    },
    retry() {
      this.isLoading = true;
      this.fetchError = false;
      this.getJobTypes();
    },
    search(searchData) {
      let formData = new FormData();
      this.searchData = searchData
      formData.append("job_type", this.searchData);

    //   this.isLoading = true;

      setTimeout(() => {
        ApiCalls.post(`admin/jobType/search`, formData)
          .then(response => {
            console.log(response.data);
            if ((response.status = 200)) {
            //   this.isLoading = false;
            console.log(response);
              this.jobtypes.data = response.data.jobType;
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

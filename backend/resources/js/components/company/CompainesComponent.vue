<template>
  <LayoutComponentVue>
    <div class="container p-3">
      <h3>Companies List</h3>
      <router-link to="/admin/company/add" class="btn btn-sm btn-success">Add Company</router-link>
      <FilterBoxComponent @search="search" @refresh="getCompanies" :placeholder="'Search Company'" />
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
          <th scope="col">Company Logo</th>
          <th scope="col">Company Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody v-for="(company, index) in companies.data" :key="index">
        <CompanyComponent
          :company="company"
          :index="companies.from + index"
          @deleteCom="deleteCompany(company.id)"
        />
      </tbody>
    </table>
    <div class="fixed-bottom">
      <PaginationComponent :data="companies" @paginate="getCompanies" />
    </div>
  </LayoutComponentVue>
</template>

<script>
import LayoutComponentVue from "../Layouts/LayoutComponent.vue";
import CompanyComponent from "./CompanyComponent.vue";
import ApiCalls from "../../api/index";
import PaginationComponent from "../Layouts/Partials/PaginationComponent.vue";
import router from "../../routes";
import FilterBoxComponent from "../Layouts/Partials/FilterBoxComponent.vue";

export default {
  name: "CompaniesComponent",
  data() {
    return {
      companies: [],
      isLoading: true,
      fetchError: false
    };
  },
  components: {
    LayoutComponentVue,
    CompanyComponent,
    PaginationComponent,
    FilterBoxComponent
  },
  mounted() {
    this.getCompanies();
  },
  methods: {
    getCompanies(page = 1) {
      if (this.isLoading) {
        setTimeout(() => {
          ApiCalls.get(`admin/company?page=${page}`)
            .then(response => {
              if (response.status == 200) {
                this.isLoading = false;
                this.companies = response.data.companies;
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
        ApiCalls.get(`admin/company?page=${page}`)
          .then(response => {
            if (response.status == 200) {
              this.companies = response.data.companies;
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
    deleteCompany(id) {
      let message = confirm("Are you sure to delete");

      if (message) {
        ApiCalls.delete(`admin/company/${id}`)
          .then(response => {
            if (response.data.status == 200) {
              this.getCompanies();
            }
          })
          .catch(error => {
            alert("Fail to delete");
            // console.log(error);
          });
      }
    },
    retry() {
      this.isLoading = true;
      this.fetchError = false;
      this.getCompanies();
    },
    search(searchData) {
      let formData = new FormData();
      this.searchData = searchData
      formData.append("name", this.searchData);

    //   this.isLoading = true;

      setTimeout(() => {
        ApiCalls.post(`admin/company/search`, formData)
          .then(response => {
            console.log(response.data);
            if ((response.status = 200)) {
            //   this.isLoading = false;
            console.log(response);
              this.companies.data = response.data.company;
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

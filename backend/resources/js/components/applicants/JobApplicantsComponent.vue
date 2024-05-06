<template>
  <LayoutComponentVue>
    <div class="container p-3" id="p_info">
      <div class="row">
        <div class="col-12">
          <h3>Applicants</h3>

          <router-link to="/admin/applicants" class="btn btn-sm btn-success">back</router-link>
          <br />
          <FilterBoxComponent @filter="filterApplicants" :showFilter="true" :showSearchBox="false" :filterData="['Accept','Pending','Reject']" :placeholder="'Search Applicant'" />
        </div>
        <div class="col-12">
          <div
            class="d-flex justify-content-center align-items-center w-100"
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

          <table class="table text-center" v-else>
            <thead class="table-success">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Applicant Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Applied Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <ApplicantComponent
                v-for="(applicant, index) in applicants.data"
                :key="index"
                :applicant="applicant"
                :index ="applicants.from + index"
                @openModal="openModal"
              />
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <info-modal-component  @success="getApplicants" ref="info_modal"/>
  </LayoutComponentVue>
</template>

<script>
import ApiCalls from "../../api/index";
import LayoutComponentVue from "../Layouts/LayoutComponent.vue";
import FilterBoxComponent from "../Layouts/Partials/FilterBoxComponent.vue";
import ApplicantComponent from "./ApplicantComponent.vue";
import { useRoute } from "vue-router";
import InfoModalComponent from "./InfoModalComponent.vue";
import { ref } from 'vue';

export default {
  name: "JobApplicantsComponent",
  components: {
    LayoutComponentVue,
    FilterBoxComponent,
    ApplicantComponent,
    InfoModalComponent
  },
  data() {
    return {
      applicants: [],
      isLoading: true,
      fetchError: false,
      route: useRoute(),
      status: 'Pending',
    };
  },
  setup(){
    const info_modal = ref();

    function openModal(personalId,statusJob){
        console.log(statusJob);
        info_modal.value.openModal(true,personalId,statusJob);
    }

    return {
        info_modal,
        openModal
    }
  },
  mounted() {
    setTimeout(() => {
        this.getApplicants();
    },1000);
  },
  methods: {
    getApplicants() {
      ApiCalls.get(`admin/applicants/${this.route.params.id}/${this.status}`)
        .then(response => {
          if (response.status == 200) {
            this.isLoading = false;
            this.applicants = response.data.applicants;
            console.log(response.data);
          }
        })
        .catch(error => {
          this.isLoading = false;
          this.fetchError = true;
        });
      console.log(this.applicants);
    },
    filterApplicants(data){
    this.status = data;
    console.log("Hello");
    ApiCalls.get(`admin/applicants/${this.route.params.id}/${this.status}`)
        .then(response => {
          if (response.status == 200) {
            this.isLoading = false;
            this.applicants = response.data.applicants;
            console.log(response.data);
          }
        })
        .catch(error => {
          this.isLoading = false;
          this.fetchError = true;
    });
  }
  },

};
</script>

<style>
</style>

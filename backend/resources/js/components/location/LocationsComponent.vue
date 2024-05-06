<template>
  <LayoutComponent>
    <div class="container p-3">
      <h3>Locations List</h3>
      <router-link to="/admin/location/add" class="btn btn-sm btn-success">Add Location</router-link>
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
          <th scope="col">City</th>
          <th scope="col">Country</th>
          <th scope="col">Action</th>
        </tr>
      </thead>

      <tbody>
        <LocationComponent
          v-for="(location, index) in locations.data"
          :key="index"
          :location="location"
          :index="locations.from + index"
          @deleteLocation="deleteLocation(location.id)"
        />
      </tbody>
    </table>

    <div class="fixed-bottom">
      <PaginationComponent :data="locations" @paginate="getLocations" />
    </div>
  </LayoutComponent>
</template>

<script>
import LayoutComponent from "../Layouts/LayoutComponent.vue";
import LocationComponent from "./LocationComponent.vue";
import ApiCalls from "../../api/index.js";
import PaginationComponent from "../Layouts/Partials/PaginationComponent.vue";

export default {
  name: "JobTypesComponent",
  components: {
    LayoutComponent,
    PaginationComponent,
    LocationComponent
  },
  data() {
    return {
      locations: [],
      isLoading: true,
      fetchError: false
    };
  },
  mounted() {
    this.getLocations();
  },
  methods: {
    getLocations(page = 1) {
      if (this.isLoading) {
        setTimeout(() => {
          ApiCalls.get(`admin/location?page=${page}`)
            .then(response => {
              if (response.status == 200) {
                this.isLoading = false;
                this.locations = response.data.locations;
              }
            })
            .catch(error => {
              this.fetchError = true;
              this.isLoading = false;

              if (error.response.status == 401) {
                this.auth.logout();

                alert("Session timeout");

                router.push("/login");
              }
            });
        }, 1000);
      } else {
        ApiCalls.get(`admin/location?page=${page}`)
          .then(response => {
            if (response.status == 200) {
              this.locations = response.data.locations;
            }
          })
          .catch(error => {
            this.fetchError = true;
            this.isLoading = false;

            if (error.response.status == 401) {
              this.auth.logout();

              alert("Session timeout");

              router.push("/login");
            }
          });
      }
    },
    deleteLocation(id) {
      let message = confirm("Are you sure to delete?");

      if (message) {
        ApiCalls.delete(`admin/location/${id}`)
          .then(response => {
            if (response.data.status == 200) {
              this.getLocations();
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
      this.getLocations();
    }
  }
};
</script>

<style>
</style>

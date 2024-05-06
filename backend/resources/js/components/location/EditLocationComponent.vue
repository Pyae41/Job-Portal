<template>
  <LayoutComponentVue>
    <div class="container">
      <h3>Edit Job Type</h3>
      <router-link to="/admin/location" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
          <i :class="`${changeIcon} float-end`" @click="isEdit"></i>
          <form action class="mt-3" @submit.prevent="updateLocation">
            <div class="form-group mb-3">
              <label for class="form-label">Job Type</label>
              <input
                type="text"
                name
                id
                :class="errors.city ? errorStyle : normalStyle"
                placeholder="Enter Category Name"
                :value="location.city"
                @input="location.city = $event.target.value"
                @focus="errors.city  = false"
                :disabled="isDisabled"
              />
              <small v-if="errors.city " class="text-danger">{{ errorMessages.city }}</small>
            </div>

            <div class="form-group mb-3">
              <label for class="form-label">Job Type</label>
              <input
                type="text"
                name
                id
                :class="errors.country ? errorStyle : normalStyle"
                placeholder="Enter Category Name"
                :value="location.country"
                @input="location.country = $event.target.value"
                @focus="errors.country = false"
                :disabled="isDisabled"
              />
              <small v-if="errors.country" class="text-danger">{{ errorMessages.country }}</small>
            </div>
            <button type="submit" :class="isDisabled ? 'd-none' : 'btn btn-success w-100'">UPdate</button>
          </form>
        </div>
      </div>
    </div>
  </LayoutComponentVue>
</template>

<script>
import LayoutComponentVue from "../Layouts/LayoutComponent.vue";
import ApiCalls from "../../api/index.js";
import { useRoute } from "vue-router";
import router from "../../routes";

export default {
  name: "EditCategoryComponent",
  components: {
    LayoutComponentVue
  },
  data() {
    return {
      location: [],
      normalStyle: "form-control",
      errors: {
        city: false,
        country: false
      },
      errorMessages: {
        city: "",
        country: ""
      },
      errorStyle: "form-control border-danger",
      route: useRoute(),
      isDisabled: true,
      changeIcon: "fas fa-pen"
    };
  },
  mounted() {
    this.getLocationDetail();
  },
  methods: {
    async getLocationDetail() {
      let data = await ApiCalls.getById(
        `admin/location/${this.route.params.id}/edit`
      );

      this.location = data.location;
      //   console.log(data);
    },
    updateLocation() {
      let formData = new FormData();
      formData.append("city", this.location.city);
      formData.append("country", this.location.country);

      ApiCalls.update(`admin/location/${this.route.params.id}`, formData)
        .then(response => {
          if (response.data.status == 200) {
            router.push("/admin/location");
          }
        })
        .catch(error => {
          let err = error.response.data.messages;
          console.log(error);

          if (err.hasOwnProperty("city")) {
            this.errors.city = true;
            this.errorMessages.city = err.city[0];
          }

          if (err.hasOwnProperty("country")) {
            this.errors.country = true;
            this.errorMessages.country = err.country[0];
          }
        });
    },
    isEdit() {
      this.isDisabled = this.isDisabled ? false : true;

      this.changeIcon = this.isDisabled ? "fas fa-pen" : "fas fa-times";
    }
  }
};
</script>

<style>
</style>

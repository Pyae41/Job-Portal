<template>
  <LayoutComponent>
    <div class="container">
      <h3>Add Location</h3>
      <router-link to="/admin/location" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
          <form action class="mt-3" @submit.prevent="addLocation">
            <div class="form-group mb-3">
              <label for class="form-label">City</label>
              <input
                type="text"
                name
                id
                :class="errors.city ? errorStyle : normalStyle"
                placeholder="Enter City"
                :value="location.city"
                @input="location.city = $event.target.value"
                @focus="errors.city = false"
              />
              <small v-if="errors.city" class="text-danger">{{ errorMessages.city }}</small>
            </div>

            <div class="form-group mb-3">
              <label for class="form-label">Country</label>
              <input
                type="text"
                name
                id
                :class="errors.country ? errorStyle : normalStyle"
                placeholder="Enter Country"
                :value="location.country"
                @input="location.country = $event.target.value"
                @focus="errors.country = false"
              />
              <small v-if="errors.country" class="text-danger">{{ errorMessages.country }}</small>
            </div>
            <button type="submit" class="btn btn-success w-100">Create</button>
          </form>
        </div>
      </div>
    </div>
  </LayoutComponent>
</template>

<script>
import LayoutComponent from "../Layouts/LayoutComponent.vue";
import ApiCalls from "../../api/index.js";
import router from "../../routes";

export default {
  name: "AddJobTypeComponent",
  components: {
    LayoutComponent
  },
  data() {
    return {
      location: {
        city: '',
        country: '',
      },
      normalStyle: "form-control",
      errors: {
        city: false,
        country: false,
      },
      errorMessages: {
        city: '',
        country: '',
      },
      errorStyle: "form-control border-danger"
    };
  },
  methods: {
    addLocation() {
        let formData = new FormData();
        formData.append('city',this.location.city);
        formData.append('country',this.location.country);

        ApiCalls.post('admin/location', formData)
        .then(response => {
            if(response.data.status == 201){
                router.push('/admin/location');
            }
        })
        .catch(error => {
            let err = error.response.data.messages;
            console.log(error);

            if(err.hasOwnProperty('city')){
                this.errors.city = true;
                this.errorMessages.city = err.city[0];
            }

            if(err.hasOwnProperty('country')){
                this.errors.country = true;
                this.errorMessages.country = err.country[0];
            }
        });
    }
  }
};
</script>

<style scoped></style>


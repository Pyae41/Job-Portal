<template>
  <LayoutComponent>
    <div class="container">
      <h3>Add Job Type</h3>
      <router-link to="/admin/jobtype" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
          <form action class="mt-3" @submit.prevent="addJobType">
            <div class="form-group mb-3">
              <label for class="form-label">Job Type</label>
              <input
                type="text"
                name
                id
                :class="error ? errorStyle : normalStyle"
                placeholder="Enter Job Type"
                :value="job_type"
                @input="job_type = $event.target.value"
                @focus="error = false"
              />
              <small v-if="error" class="text-danger">{{ errorMessage }}</small>
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
      job_type: '',
      normalStyle: "form-control",
      error: false,
      errorMessage: '',
      errorStyle: "form-control border-danger"
    };
  },
  methods: {
    addJobType() {
        let formData = new FormData();
        formData.append('job_type',this.job_type);

        console.log(formData.get('job_type'));
        ApiCalls.post('admin/jobType', formData)
        .then(response => {
            if(response.data.status == 201){
                router.push('/admin/jobtype');
            }
        })
        .catch(error => {
            this.error = true;
            console.log(error);
            this.errorMessage = error.response.data.messages.job_type[0];
        });
    }
  }
};
</script>

<style scoped>
</style>

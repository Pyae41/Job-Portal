<template>
  <LayoutComponentVue>
    <div class="container">
      <h3>Edit Job Type</h3>
      <router-link to="/admin/jobtype" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
            <i :class="`${changeIcon} float-end`" @click="isEdit"></i>
          <form action class="mt-3" @submit.prevent="updateJobType">
            <div class="form-group mb-3">
              <label for class="form-label">Job Type</label>
              <input
                type="text"
                name
                id
                :class="error ? errorStyle : normalStyle"
                placeholder="Enter Category Name"
                :value="jobtype.job_type"
                @input="jobtype.job_type = $event.target.value"
                @focus="error = false"
                :disabled="isDisabled"
              />
              <small v-if="error" class="text-danger">{{ errorMessage }}</small>
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
      jobtype: [],
      normalStyle: "form-control",
      error: false,
      errorMessage: "",
      errorStyle: "form-control border-danger",
      route: useRoute(),
      isDisabled: true,
      changeIcon: 'fas fa-pen',
    };
  },
  mounted() {
    this.getJobTypeDetail();
  },
  methods: {
    async getJobTypeDetail() {
      let data = await ApiCalls.getById(
        `admin/jobType/${this.route.params.id}/edit`
      );

      this.jobtype = data.jobType;
      this.oldData = this.jobtype.job_type;
      //   console.log(data);
    },
    updateJobType() {
      let formData = new FormData();
      formData.append("job_type", this.jobtype.job_type);

      ApiCalls.update(`admin/jobType/${this.route.params.id}`, formData)
        .then(response => {
          if (response.data.status == 200) {
            router.push("/admin/jobtype");
          }
        })
        .catch(error => {
          this.error = true;
          console.log(error);
          this.errorMessage = error.response.data.messages.job_type[0];
        });
    },
    isEdit(){
        this.isDisabled = this.isDisabled ? false : true;

        this.changeIcon = this.isDisabled ? 'fas fa-pen' : 'fas fa-times';
    }
  }
};
</script>

<style>
</style>

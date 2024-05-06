<template>
  <LayoutComponent>
    <div class="container">
      <h3>Add Category</h3>
      <router-link to="/admin/category" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
          <form action class="mt-3" @submit.prevent="addCategory">
            <div class="form-group mb-3">
              <label for class="form-label">Category Name</label>
              <input
                type="text"
                name
                id
                :class="error ? errorStyle : normalStyle"
                placeholder="Enter Category Name"
                :value="name"
                @input="name = $event.target.value"
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
  name: "AddCategoryComponent",
  components: {
    LayoutComponent
  },
  data() {
    return {
      name: "",
      normalStyle: "form-control",
      error: false,
      errorMessage: '',
      errorStyle: "form-control border-danger"
    };
  },
  methods: {
    addCategory() {
        let formData = new FormData();
        formData.append('name',this.name);


        ApiCalls.post('admin/category',formData)
        .then(response => {
            if(response.data.status == 201){
                router.push('/admin/category');
            }
        })
        .catch(error => {
            this.error = true;
            this.errorMessage = error.response.data.messages.name[0];
        });
    }
  }
};
</script>

<style scoped>
</style>

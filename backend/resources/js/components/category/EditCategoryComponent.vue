<template>
  <LayoutComponentVue>
    <div class="container">
      <h3>Edit Category</h3>
      <router-link to="/admin/category" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
            <i :class="`${changeIcon} float-end`" @click="isEdit"></i>
          <form action class="mt-3" @submit.prevent="updatCategory">
            <div class="form-group mb-3">
              <label for class="form-label">Category Name</label>
              <input
                type="text"
                name
                id
                :class="error ? errorStyle : normalStyle"
                placeholder="Enter Category Name"
                :value="category.name"
                @input="category.name = $event.target.value"
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
      category: [],
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
    this.getCategoryDetail();
  },
  methods: {
    async getCategoryDetail() {
      let data = await ApiCalls.getById(
        `admin/category/${this.route.params.id}/edit`
      ).then(response => response.data);

      this.category = data.category;
      //   console.log(data);
    },
    updatCategory() {
      let formData = new FormData();
      formData.append("name", this.category.name);

      ApiCalls.update(`admin/category/${this.route.params.id}`, formData)
        .then(response => {
          if (response.data.status == 200) {
            router.push("/admin/category");
          }
        })
        .catch(error => {
          this.error = true;
          this.errorMessage = error.response.data.messages.name[0];
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

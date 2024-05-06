<template>
  <LayoutComponent>
    <div class="container p-3">
      <h3>Categories List</h3>
      <router-link to="/admin/category/add" class="btn btn-sm btn-success">Add Category</router-link>
      <FilterBoxComponent @search="search" @refresh="getCategories" :placeholder="'Search Category'" />
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
          <th scope="col">Category Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <CategoryComponent
          v-for="(category, index) in categories.data"
          :key="index"
          :category="category"
          :index="categories.from + index"
          @deleteCate="deleteCategory(category.id)"
        />
      </tbody>
    </table>
    <div class="fixed-bottom">
      <PaginationComponent :data="categories" @paginate="getCategories" />
    </div>
  </LayoutComponent>
</template>

<script>
import LayoutComponent from "../Layouts/LayoutComponent.vue";
import CategoryComponent from "./CategoryComponent.vue";
import ApiCalls from "../../api/index.js";
import PaginationComponent from "../Layouts/Partials/PaginationComponent.vue";
import router from "../../routes";
import FilterBoxComponent from "../Layouts/Partials/FilterBoxComponent.vue";

export default {
  name: "CategoriesComponent",
  components: {
    LayoutComponent,
    CategoryComponent,
    PaginationComponent,
    FilterBoxComponent
  },
  data() {
    return {
      categories: [],
      isLoading: true,
      fetchError: false
    };
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    getCategories(page = 1) {
      if (this.isLoading) {
        setTimeout(() => {
          ApiCalls.get(`admin/category?page=${page}`)
            .then(response => {
              if (response.status == 200) {
                this.isLoading = false;
                this.categories = response.data.categories;
              }
            })
            .catch(error => {
              this.fetchError = true;
              this.isLoading = false;

              console.log(error);
              if (error.response.status == 401) {
                this.auth.logout();

                alert("Session timeout");
                router.push("/login");
              }
            });
        }, 1000);
      } else {
        ApiCalls.get(`admin/category?page=${page}`)
          .then(response => {
            if (response.status == 200) {
              this.categories = response.data.categories;
            }
          })
          .catch(error => {
            this.fetchError = true;
            this.isLoading = false;

            console.log(error);
            if (error.response.status == 401) {
              this.auth.logout();

              alert("Session timeout");
              router.push("/login");
            }
          });
      }
    },
    deleteCategory(id) {
      let message = confirm("Are you sure to delete?");

      if (message) {
        ApiCalls.delete(`admin/category/${id}`)
          .then(response => {
            if (response.data.status == 200) {
              this.getCategories();
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
      this.getCategories();
    },
    search(searchData) {
      let formData = new FormData();
      this.searchData = searchData
      formData.append("name", this.searchData);

    //   this.isLoading = true;

      setTimeout(() => {
        ApiCalls.post(`admin/category/search`, formData)
          .then(response => {
            console.log(response.data);
            if ((response.status = 200)) {
            //   this.isLoading = false;
            console.log(response);
              this.categories.data = response.data.category;
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

<template>
  <LayoutComponent>
    <div class="container">
      <h3 class="text-uppercase">Post a job</h3>
      <router-link to="/admin/jobpost" class="btn btn-sm btn-success">Back</router-link>

      <div class="card mx-auto mt-3">
        <div class="card-body">
          <form action class="mt-3" @submit.prevent="addJobPost">
            <div class="row">
              <div class="col-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Job Position</label>
                  <input
                    type="text"
                    name
                    id
                    :class="errors.job_position ? errorStyle : normalStyle"
                    placeholder="Enter Job Position"
                    :value="jobpost.job_position"
                    @input="jobpost.job_position = $event.target.value"
                    @focus="errors.job_position = false"
                  />
                  <small
                    v-if="errors.job_position"
                    class="text-danger"
                  >{{ errorMessages.job_position }}</small>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Deadline</label>
                  <input
                    type="date"
                    name
                    id
                    :class="errors.deadline ? errorStyle : normalStyle"
                    placeholder="Enter Job Position"
                    :value="jobpost.deadline"
                    @change="jobpost.deadline = $event.target.value"
                    @focus="errors.deadline = false"
                  />
                  <small v-if="errors.deadline" class="text-danger">{{ errorMessages.deadline }}</small>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Job Category</label>
                  <multiselect
                    v-model="jobpost.category_id"
                    :options="categories"
                    placeholder="Select one category"
                    :multiple="false"
                    open-direction="bottom"
                    label="name"
                    track-by="name"
                    @search-change="searchCategories"
                    @focus="errors.category_id = false"
                    :style="errors.category_id ? 'border: 1px solid #f86c6b !important;border-radius: 4px;' : ''"
                  ></multiselect>

                  <small
                    v-if="errors.category_id"
                    class="text-danger"
                  >{{ errorMessages.category_id }}</small>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Job Type</label>
                  <multiselect
                    v-model="jobpost.job_type_id"
                    :options="jobTypes"
                    placeholder="Select one job type"
                    :multiple="false"
                    open-direction="bottom"
                    label="job_type"
                    track-by="job_type"
                    @search_change="searchJobTypes"
                    :style="errors.job_type_id ? 'border: 1px solid #f86c6b !important;border-radius: 4px;' : ''"
                  ></multiselect>

                  <small
                    v-if="errors.job_type_id"
                    class="text-danger"
                  >{{ errorMessages.job_type_id }}</small>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Company</label>
                  <multiselect
                    v-model="jobpost.company_id"
                    :options="companies"
                    placeholder="Select one company"
                    :multiple="false"
                    open-direction="bottom"
                    label="name"
                    track-by="name"
                    @search-change="searchCompanies"
                    :style="errors.company_id ? 'border: 1px solid #f86c6b !important;border-radius: 4px;' : ''"
                  ></multiselect>

                  <small v-if="errors.company_id" class="text-danger">{{ errorMessages.company_id }}</small>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Location</label>
                  <multiselect
                    v-model="jobpost.location_id"
                    :options="locations"
                    placeholder="Select one location"
                    :multiple="false"
                    open-direction="bottom"
                    label="city"
                    track-by="city"
                    @search-change="searchLocations"
                    :style="errors.location_id ? 'border: 1px solid #f86c6b !important;border-radius: 4px;' : ''"
                  ></multiselect>

                  <small
                    v-if="errors.location_id"
                    class="text-danger"
                  >{{ errorMessages.location_id }}</small>
                </div>
              </div>

              <div class="col-12 mb-3">
                <label for class="form-label">Description</label>
                <textarea name="description" id="editor"></textarea>

                <small v-if="errors.description" class="text-danger">{{ errorMessages.description }}</small>
              </div>
              <div class="col-12 mb-3">
                <label for class="form-label">Skill</label>
                <textarea
                  placeholder="Enter Skills"
                  :class="errors.skill ? errorStyle : normalStyle"
                  :value="jobpost.skill"
                  @input="jobpost.skill = $event.target.value"
                  @focus="errors.skill = false"
                ></textarea>

                <small v-if="errors.skill" class="text-danger">{{ errorMessages.skill }}</small>
              </div>

              <div class="col-12 mb-3">
                <label for class="form-label">Salary</label>
                <input
                  placeholder="Enter Salary"
                  :class="errors.salary ? errorStyle : normalStyle"
                  :value="jobpost.salary"
                  @input="jobpost.salary = $event.target.value"
                  @focus="errors.salary = false"
                />

                <small v-if="errors.salary" class="text-danger">{{ errorMessages.salary }}</small>
              </div>
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
import Multiselect from "vue-multiselect";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  name: "AddJobTypeComponent",
  components: {
    LayoutComponent,
    Multiselect,
    ClassicEditor
  },
  data() {
    return {
      jobpost: {
        job_position: "",
        category_id: "",
        job_type_id: "",
        location_id: "",
        company_id: "",
        skill: "",
        salary: "",
        deadline: "",
        description: "",
        status: ""
      },
      value: null,
      categories: [],
      jobTypes: [],
      companies: [],
      locations: [],
      normalStyle: "form-control",
      errors: {
        job_position: false,
        category_id: false,
        job_type_id: false,
        location_id: false,
        company_id: false,
        skill: false,
        salary: false,
        deadline: false,
        description: false,
        status: false
      },
      errorMessages: {
        job_position: "",
        category_id: "",
        job_type_id: "",
        location_id: "",
        company_id: "",
        skill: "",
        salary: "",
        deadline: "",
        description: "",
        status: ""
      },
      errorStyle: "form-control border-danger"
    };
  },
  mounted() {
    this.getCategories();
    this.getJobTypes();
    this.getCompnies();
    this.getLocations();

    ClassicEditor.create(document.querySelector("#editor"), {
      placeholder: "Enter Description",
      minHeight: "200px"
      //   toolbar: [
      //     "bold",
      //     "italic",
      //     "bulletedList",
      //     "numberedList",
      //     "outdent",
      //     "indent"
      //   ]
    })
      .then(newEditor => {
        window.editor = newEditor;
        editor.ui.view.editable.element.style.height = "200px";
      })
      .catch(error => {
        console.error(error);
      });
  },
  methods: {
    async getCategories() {
      let data = await ApiCalls.get("admin/category").then(
        response => response.data
      );

      this.categories = data.categories.data;
    },
    async getJobTypes() {
      let data = await ApiCalls.get("admin/jobType").then(
        response => response.data
      );

      this.jobTypes = data.jobTypes.data;
    },
    async getCompnies() {
      let data = await ApiCalls.get("admin/company").then(
        response => response.data
      );

      this.companies = data.companies.data;
    },
    async getLocations() {
      let data = await ApiCalls.get("admin/location").then(
        response => response.data
      );

      this.locations = data.locations.data;
    },
    searchCategories(query) {
      ApiCalls.post("admin/category/search", { name: query })
        .then(response => {
          this.categories = response.data.category;
        })
        .catch(error => alert(error));
    },
    searchJobTypes(query) {
      ApiCalls.post("admin/jobtype/search", { job_type: query })
        .then(response => {
          this.categories = response.data.jobType;
        })
        .catch(error => alert(error));
    },
    searchCompanies(query) {
      ApiCalls.post("admin/company/search", { name: query })
        .then(response => {
          this.companies = response.data.company;
        })
        .catch(error => alert(error));
    },
    searchLocations(query) {
      ApiCalls.post("admin/location/search", { location: query })
        .then(response => {
          this.locations = response.data.location;
        })
        .catch(error => alert(error));
    },
    addJobPost() {
      let formData = new FormData();

      formData.append("category_id", this.jobpost.category_id.id ?? "");
      formData.append("location_id", this.jobpost.location_id.id ?? "");
      formData.append("company_id", this.jobpost.company_id.id ?? "");
      formData.append("job_type_id", this.jobpost.job_type_id.id ?? "");
      formData.append("job_position", this.jobpost.job_position);
      formData.append("description", window.editor.getData());
      formData.append("skill", this.jobpost.skill);
      formData.append(
        "salary",
        this.jobpost.salary != ""
          ? this.jobpost.salary + " MMK"
          : this.jobpost.salary
      );
      formData.append("deadline", this.jobpost.deadline);

      // console.log(formData.get("job_type"));
      ApiCalls.post("admin/jobPost", formData)
        .then(response => {
          if (response.data.status == 201) {
            router.push("/admin/jobpost");
          }
        })
        .catch(error => {
          //   this.error = true;

        //   console.log(error);
          if (error.response.status == 400) {
            let err = error.response.data.messages;

            if (err.hasOwnProperty("category_id")) {
              this.errors.category_id = true;
              this.errorMessages.category_id = err.category_id[0];
            }
            if (err.hasOwnProperty("company_id")) {
              this.errors.company_id = true;
              this.errorMessages.company_id = err.company_id[0];
            }
            if (err.hasOwnProperty("job_type_id")) {
              this.errors.job_type_id = true;
              this.errorMessages.job_type_id = err.job_type_id[0];
            }
            if (err.hasOwnProperty("location_id")) {
              this.errors.location_id = true;
              this.errorMessages.location_id = err.location_id[0];
            }
            if (err.hasOwnProperty("job_position")) {
              this.errors.job_position = true;
              this.errorMessages.job_position = err.job_position[0];
            }
            if (err.hasOwnProperty("skill")) {
              this.errors.skill = true;
              this.errorMessages.skill = err.skill[0];
            }
            if (err.hasOwnProperty("description")) {
              this.errors.description = true;
              this.errorMessages.description = err.description[0];
            }
            if (err.hasOwnProperty("salary")) {
              this.errors.salary = true;
              this.errorMessages.salary = err.salary[0];
            }
            if (err.hasOwnProperty("deadline")) {
              this.errors.deadline = true;
              this.errorMessages.deadline = err.deadline[0];
            }
          }

          if (error.response.status == 401) {
            alert("Session time out");
            this.auth.logout();
            router.push("/login");
          }
        });
    }
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<style scoped>
.multiselect.invalid .multiselect__tags {
  border: 1px solid #f86c6b !important;
}
</style>

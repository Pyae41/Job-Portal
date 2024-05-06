<template>
  <div class="card">
    <div
      class="card-title p-3 d-flex align-items-center justify-content-between"
    >
      <div class="filter-text">
        <h5 class="mt-2">Jobs Filter</h5>
      </div>
      <div class="filter-btns">
        <small class="d-inline me-2 text-muted">Clear Filter</small>
        <a
          class="rounded-circle shadow-lg p-2 d-lg-none text-dark"
          data-mdb-toggle="collapse"
          href="#mainCollapse"
          style="font-size: smaller"
          ><i class="fas fa-filter"></i
        ></a>
      </div>
    </div>
    <div class="collapse d-lg-block" id="mainCollapse">
      <hr class="mx-auto" style="width: 95%" />
      <div class="card-content p-3">
        <form action="">
          <div class="form-group">
            <input
              type="text"
              name=""
              id=""
              placeholder="Location"
              class="form-control mdbInput"
            />
          </div>
        <div class="accordion mt-3" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button
                class="accordion-button collapsed"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#collapseOne"
                aria-expanded="false"
                aria-controls="collapseOne"
              >
                Job Type
              </button>
            </h2>
            <div
              id="collapseOne"
              class="accordion-collapse collapse"
              aria-labelledby="headingOne"
              data-mdb-parent="#accordionExample"
            >
              <div class="accordion-body">
                <div
                  v-for="jobType in jobtypes"
                  :key="jobType.index"
                  class="mt-2"
                >
                  <input
                    type="radio"
                    name="jobtype"
                    id=""
                    :value="jobType.job_type"
                    class="form-check-control me-2"
                  />
                  <label for="" class="form-label">{{
                    jobType.job_type
                  }}</label>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button
                class="accordion-button collapsed"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#collapseTwo"
                aria-expanded="false"
                aria-controls="collapseTwo"
              >
                Category
              </button>
            </h2>
            <div
              id="collapseTwo"
              class="accordion-collapse collapse"
              aria-labelledby="headingTwo"
              data-mdb-parent="#accordionExample"
            >
              <div class="accordion-body">
                <div
                  v-for="category in categories"
                  :key="category.index"
                  class="mt-2"
                >
                  <input
                    type="checkbox"
                    :name="category.name"
                    id=""
                    class="form-check-control me-2"
                    :value="category.name"
                  />
                  <label for="" class="form-label">{{ category.name }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-center mt-3">
    <button class="btn btn-success">Search job</button>
  </div>
</template>

<script>
import ApiCalls from "@/api/index.js";
export default {
  name: "JobsFilter",
  data() {
    return {
      categories: [],
      jobtypes: [],
    };
  },
  mounted() {
    this.getCategories();
    this.getJobTypes();
  },
  methods: {
    getCategories() {
      ApiCalls.get("frontend/category").then((response) => {
        if (response.status == 200) {
          this.categories = response.data.categories;
        }
      });
    },
    getJobTypes() {
      ApiCalls.get("frontend/jobType").then((response) => {
        if (response.status == 200) {
          this.jobtypes = response.data.jobTypes;
        }
      });
    },
  },
};
</script>

<style>

.accordion-header:not(.collapsed)::after {
  color: #13b955 !important;
}

</style>
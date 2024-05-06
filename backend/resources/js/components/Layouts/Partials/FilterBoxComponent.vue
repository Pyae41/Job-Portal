<template>
  <div class="container float-end mb-2" style="width: 500px;margin-right:5%;postition: relative;">
    <div class="row searchFilter">
      <div class="col-sm-12">
        <div :class="`input-group ${showSearchBox ? 'float-end' : ''}`">
          <button
            type="button"
            class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
            data-mdb-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            style="position:relative;z-index: 0;"
            v-if="showFilter"
          >
            <i class="fas fa-filter"></i>
            <span class="caret">&nbsp;</span>
          </button>
          <input
            id="table_filter"
            type="text"
            class="form-control"
            aria-label="Text input with segmented button dropdown"
            :placeholder="placeholder"
            style="border-radius: 0px;height: 20px;"
            v-model="searchData"
            v-show="showSearchBox"
          />
          <div class="input-group-btn">

            <div class="dropdown-menu dropdown-menu-right">
              <ul class="category_filters">
                <li v-for="data,index in filterData" :key="index" style="cursor: pointer;" @click.prevent="filter(data)">
                  <label class="category-label" for="Design">{{ data }}</label>
                </li>
              </ul>
            </div>
            <button id="searchBtn" type="button" class="btn btn-sm btn-success" @click="search" style="position:relative;z-index:0;" v-show="showSearchBox">
              <i class="fas fa-search"></i>
            </button>
            <button id="searchBtn" type="button" class="btn btn-sm btn-danger" @click="refresh" style="position:relative;z-index:0;" v-show="showSearchBox">
              <i class="fas fa-refresh"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FilterBoxComponent",
  props: {
    showSearchBox: {
        type: Boolean,
        default: true
    },
    placeholder: {
        type: String,
        default: '',
    },
    showFilter: {
        type: Boolean,
        default: false
    },
    filterData: {
        type: Array,
        default: []
    }
  },
  data() {
    return {
      searchData: "",
    };
  },
  methods: {
    search() {
      this.$emit("search", this.searchData);
    },
    filter(data){
        this.$emit('filter',data);
    },
    refresh(){
        this.searchData = '';
        this.$emit('refresh');
    }
  }
};
</script>

<style scoped>
button {
  border-radius: 0px !important;
  height: 35px !important;
}
.searchFilter {
  margin-bottom: 20px;
}

.searchFilter .dropdown-menu .category_filters {
  min-width: 178px;
  width: 100%;
  margin: 15px 0 0 -25px;
}
.searchFilter .dropdown-menu-right {
  right: 170px;
  min-width: 175px;
  top: 90%;
}
.searchFilter .dropdown-menu .category_filters li {
  list-style-type: none;
  padding: 2px 10px;
  font-size: 18px;
}
.searchFilter .dropdown-menu .category_filters label {
  margin-left: 15px;
}
</style>

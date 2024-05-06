<template>
  <nav aria-label="Page navigation example" v-if="data.last_page != 1">
    <ul class="pagination justify-content-end mx-4">
      <li
        class="page-item"
        @click="pageClick(data.current_page-1)"
        v-if="data.current_page > 1"
        data-mdb-ripple-duration="0"
      >
        <a class="page-link" aria-label="Previous">
          <span aria-hidden="true">Previous</span>
        </a>
      </li>
      <div
        class="page-item"
        v-for="(d, index) in data.last_page"
        :key="index"
        :class="d == data.current_page? 'pagi-active' : ''"
        data-mdb-ripple-duration="0"
      >
        <li @click.stop="pageClick(d)" v-if="index + 1 == data.current_page" :class="ellipse = true">
          <a class="page-link">{{ d }}</a>
        </li>

        <li
          @click.stop="pageClick(d)"
          v-else-if="index <= end || (data.current_page && index >= data.current_page - middle && index <= data.current_page + middle) || index > Math.ceil(data.total / data.per_page) - end"
            :class="ellipse = true"
        >
          <a class="page-link">{{ d }}</a>
        </li>

        <li v-else-if="ellipse" :class="ellipse=false">&hellip;</li>
      </div>

      <li
        class="page-item"
        data-mdb-ripple-duration=" 0"
        @click="pageClick(data.current_page+1)"
        v-if="data.next_page_url != null"
      >
        <a class="page-link" aria-label="Next">
          <span aria-hidden="true">Next</span>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "PaginationComponent",
  props: ["data"],
  components: {},
  data() {
    return {
      end: 1,
      middle: 2,
      ellipse: false
    };
  },
  methods: {
    pageClick(page) {
      //   console.log(page);
      this.$emit("paginate", page);
    }
  }
};
</script>

<style scoped>
.pagi-active {
  border-radius: 5px !important;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%) !important;
  background: rgb(20, 164, 77, 0.3) !important;
  color: #14a44d !important;
}
</style>

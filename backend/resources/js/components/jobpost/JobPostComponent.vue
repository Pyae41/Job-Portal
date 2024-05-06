<template>
  <tr>
    <td>{{ index }}</td>
    <td>{{ jobpost.job_position }}</td>
    <td>{{ jobpost.hasOwnProperty('company') ? jobpost.company.name : jobpost.name }}</td>
    <td>{{ deadline }}</td>
    <td>
      <router-link :to="`/admin/jobpost/${jobpost.id}/edit`" class="btn btn-sm btn-primary">
        <i class="fas fa-info"></i>
      </router-link>
    </td>
    <td>
      <div class="form-check form-switch">
        <input
          class="form-check-input"
          type="checkbox"
          role="switch"
          id="flexSwitchCheckDefault"
          :checked="checked = jobpost.status == 'Active' ? true : false"
          @change="statusChange"
        />
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  name: "JobTypeComponent",
  props: ["jobpost", "index"],
  data() {
    return {
      checked: false,
      deadline: '',
    };
  },
  mounted() {
    this.deadline = `${new Date(this.jobpost.deadline).getDate()}/${new Date(
      this.jobpost.deadline
    ).toLocaleString("en", { month: "long" })}/${new Date(
      this.jobpost.deadline
    ).getFullYear()}`;

    // console.log(this.jobpost);
  },
  methods: {
    statusChange() {
      this.checked = this.checked ? false : true;

      // console.log(this.checked);
      this.$emit("statusChange", this.checked);
    }
  }
};
</script>

<style>
</style>

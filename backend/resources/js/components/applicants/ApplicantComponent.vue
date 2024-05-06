<template>
  <tr>
    <td>{{ index }}</td>
    <td>{{ applicant.user.name }}</td>
    <td>{{ applicant.user.email }}</td>
    <td>{{ applicant.user.personal_info.phone }}</td>
    <td>
      <div class="badge badge-success" v-if="applicant.status == 'Accept'">{{ applicant.status }}</div>
      <div class="badge badge-primary" v-else-if="applicant.status == 'Pending'">{{ applicant.status }}</div>
      <div class="badge badge-danger" v-else>{{ applicant.status }}</div>

    </td>
    <td>
      <button @click.prevent="openModal(applicant.user.id,applicant.status)" class="btn btn-sm btn-primary">
        <i class="fas fa-info"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  name: "ApplicantComponent",
  props: ["applicant", "index"],
  components: {
  },
//   data() {
//     return {
//       appliedStatus:''
//     };
//   },
  methods: {
    openModal(personalId,statusJob){
        this.$emit('openModal',personalId,statusJob);
    }
  }
};
</script>

<style>
</style>

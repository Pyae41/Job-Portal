<template>
  <div class="card mb-3">
    <div class="card-body" style="display:grid;place-items: center;">
      <img
        :src="`data:image/*;base64,${jobpost.company.company_logo}`"
        alt
        srcset
        style="width: 150px;height: 150px;"
      />
      <span class="text-muted mb-3">{{ jobpost.company.name }}</span>
      <small class="text-dark" style="font-size: medium;">{{ jobpost.job_position }}</small>
    </div>
  </div>
</template>

<script>
export default {
  name: "JobPostCardComponent",
  props: ["jobpost"]
};
</script>

<style>
</style>

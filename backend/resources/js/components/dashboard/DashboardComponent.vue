<template>
  <LayoutComponentVue>
    <div class="container">
      <h3>Dashboard</h3>
      <div class="card p-3">
        <div class="card-content">
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="card-box bg-danger">
                <div class="inner">
                  <h3>{{ reportAll.users }}</h3>
                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users" aria-hidden="true"></i>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="card-box bg-primary">
                <div class="inner">
                  <h3>{{ reportAll.companyCount }}</h3>
                  <p>Companies</p>
                </div>
                <div class="icon">
                  <i class="fas fa-newspaper" aria-hidden="true"></i>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="card-box bg-success">
                <div class="inner">
                  <h3>{{ reportAll.jobPostCount }}</h3>
                  <p>Job Posts</p>
                </div>
                <div class="icon">
                  <i class="fas fa-newspaper" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <table class="table text-center mt-3">
      <thead class="table-success">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Company Logo</th>
          <th scope="col">Company Name</th>
          <th scope="col">Job Post</th>
          <th scope="col">Pending</th>
          <th scope="col">Accept</th>
          <th scope="col">Reject</th>
        </tr>
      </thead>
      <tbody style="height: 300px;overflow-y:auto;">
        <tr  v-for="(company, index) in companies" :key="index">
            <td>{{ company.id }}</td>
            <td class="w-25">
                <img :src="`data:image/*;base64,${company.company_logo}`" alt="" class="img-fluid"  style="height: 50px;"/>
            </td>
            <td>
                {{ company.name }}
            </td>
            <td>
                {{ company.job_posts_count }}
            </td>
            <td>
                {{ company.pending }}
            </td>
            <td>
                {{ company.accept }}
            </td>
            <td>
                {{ company.reject }}
            </td>
        </tr>
      </tbody>
    </table>
  </LayoutComponentVue>
</template>

<script>
import LayoutComponentVue from "../Layouts/LayoutComponent.vue";
import ApiCalls from "../../api/index.js";

export default {
  name: "DashboardComponent",
  components: {
    LayoutComponentVue
  },
  data(){
    return {
        reportAll:'',
        companies:'',
    }
  },
  mounted(){
    this.getAllReport();
    this.getCompaniesReports();
  },
  methods:{
    getAllReport(){
        ApiCalls.get('admin/allReport')
        .then(response => {
            if(response.status == 200){
                this.reportAll = response.data;
            }
        })
        .catch(error => {
            console.log(error);
        })
    },
    getCompaniesReports(){
        ApiCalls.get('admin/companyReport')
        .then(response => {
            if(response.status == 200){
                this.companies = response.data.companies;
            }
        })
        .catch(error => {
            console.log(error);
        })
    }
  }
};
</script>
<style scoped>
.card-box {
  position: relative;
  color: #fff;
  padding: 20px 10px 40px;
  margin: 20px 0px;
}
.card-box:hover {
  text-decoration: none;
  color: #f1f1f1;
}
.card-box:hover .icon i {
  font-size: 100px;
  transition: 1s;
  -webkit-transition: 1s;
}
.card-box .inner {
  padding: 5px 10px 0 10px;
}
.card-box h3 {
  font-size: 27px;
  font-weight: bold;
  margin: 0 0 8px 0;
  white-space: nowrap;
  padding: 0;
  text-align: left;
}
.card-box p {
  font-size: 15px;
}
.card-box .icon {
  position: absolute;
  top: auto;
  bottom: 5px;
  right: 5px;
  z-index: 0;
  font-size: 72px;
  color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
  position: absolute;
  left: 0px;
  bottom: 0px;
  text-align: center;
  padding: 3px 0;
  color: rgba(255, 255, 255, 0.8);
  background: rgba(0, 0, 0, 0.1);
  width: 100%;
  text-decoration: none;
}
.card-box:hover .card-box-footer {
  background: rgba(0, 0, 0, 0.3);
}
</style>

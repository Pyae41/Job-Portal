<template>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <router-link to="/admin/dashboard" :class="path.includes('dashboard')? active : inactive">
            <i class="fas fa-tachometer-alt fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Dashboard</span>
          </router-link>
          <router-link to="/admin/category" :class="path.includes('category')? active : inactive">
            <i class="fas fa-list-alt fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Category</span>
          </router-link>
          <router-link to="/admin/company" :class="path.includes('company')? active : inactive">
            <i class="fas fa-building fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Company</span>
          </router-link>

          <router-link to="/admin/location" :class="path.includes('location')? active : inactive">
            <i class="fas fa-map-marker-alt fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Location</span>
          </router-link>

          <router-link to="/admin/jobtype" :class="path.includes('jobtype')? active : inactive">
            <i class="fas fa-stream fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Job Type</span>
          </router-link>

          <router-link to="/admin/jobpost" :class="path.includes('jobpost')? active : inactive">
            <i class="fas fa-newspaper fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Job Post</span>
          </router-link>

          <router-link to="/admin/applicants" :class="path.includes('applicants')? active : inactive">
            <i class="fas fa-users fa-fw me-3 nav-icon"></i>
            <span class="nav-text">Applicants</span>
          </router-link>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand fs-4" href="#">
          <strong class="me-1 text-success">Career</strong>
          <span>
                Next
          </span>
        </a>
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
              href="#"
              id="navbarDropdownMenuLink"
              role="button"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
            >
              <small class="me-2">{{ user.name }}</small>
              <div
                class="rounded-circle bg-danger text-white d-flex justify-content-center align-items-center"
                style="width: 25px; height:25px;"
              >{{ this.user.name.charAt(0) }}</div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <!-- <li>
                <a class="dropdown-item" href="#">Settings</a>
              </li> -->
              <li>
                <a class="dropdown-item" @click.prevent="logout">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->
</template>

<script>
import ApiCalls from "../../../api/index";
import Auth from "../../../auth";
import router from "../../../routes";

export default {
  name: "NavbarComponent",
  data() {
    return {
      path: "",
      active: "list-group-item list-group-item-action py-2 ripple active",
      inactive: "list-group-item list-group-item-action py-2 ripple",
      user: this.auth.user
    };
  },
  mounted() {
    this.path = window.location.pathname;
  },
  methods: {
    logout() {
      let message = confirm('Are you sure?');

      if(message){
        ApiCalls.post("admin/logout")
        .then(response => {
          if (response.status == 200) {
            Auth.logout();

            router.push("/login");
          }
        })
        .catch(error => {
          if (error.response.status == 401) {
            this.auth.logout();

            alert("Session timeout");

            router.push("/login");
          }
        });
      }
    }
  }
};
</script>

<style scoped>
/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0; /* Height of navbar */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}

.sidebar .active {
  border-radius: 5px !important;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%) !important;
  background: rgb(20, 164, 77, 0.3) !important;
  color: #14a44d !important;
}

/* .nav-text,.nav-icon{
    color: #111 !important;
} */
@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
/* .sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
} */

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
</style>

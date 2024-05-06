<template>
  <div>
    <nav :class="navFixed">
      <div class="container text-center">
        <a class="navbar-brand" href="/"
          ><strong class="me-1">Job</strong
          ><span class="text-success"><strong>Portal</strong></span></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#navbarColor01"
          aria-controls="navbarText"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mx-5 me-auto">
            <li class="nav-item mx-3">
              <router-link class="nav-link" to="/"
                >Home
                <span class="visually-hidden">(current)</span>
              </router-link>
            </li>
            <li class="nav-item mx-3">
              <router-link to="/jobs" class="nav-link">Job Posts</router-link>
            </li>
            <li class="nav-item mx-3">
              <router-link class="nav-link" to="/about">About</router-link>
            </li>
          </ul>
          <div class="dropdown" v-if="user">
            <a
              class="dropdown-toggle"
              role="button"
              id="dropdownMenuLink"
              data-mdb-toggle="dropdown"
              aria-expanded="false"
            >
            {{ user.name }}
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><router-link class="dropdown-item" to="/Accinfo">My Profile</router-link></li>
              <li><router-link class="dropdown-item" to="/AppliedJobs">My Jobs</router-link></li>
              <li><a class="dropdown-item" @click.prevent="logout">logout</a></li>
            </ul>
          </div>
          <router-link
            type="button"
            class="btn btn-success ms-5"
            data-mdb-ripple-color="dark"
            to="/login&register"
            v-else
          >
            <i class="fa-sharp fa-solid fa-right-to-bracket"></i> login
          </router-link>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>

import ApiCalls from '../../api/index';

export default {
  name: "NavComponent",
  data() {
    return {
      path: "",
      navFixed: "navbar autohide navbar-expand-lg bg-light py-3",
      user: this.auth.user,
    };
  },
  mounted() {
    if (!this.auth.check()) {
      this.user = null;
    }
    window.document.onscroll = () => {
      if (window.scrollY > 1) {
        this.navFixed =
          "navbar autohide navbar-expand-lg bg-light py-3 fixed-top";
      } else {
        this.navFixed = "navbar autohide navbar-expand-lg bg-light  py-3 ";
      }
    };
  },
  methods:{
    logout(){

      ApiCalls.post('frontend/logout')
      .then(response => {
        if(response.status == 200){
          this.user = '';
          this.auth.logout();
        }
      })
      .catch(error => {
        console.log(error);
      });
    }
  }
};
</script>

<style  scoped>
.navbar {
  transition: all 0.5s ease;
  z-index: 1000;
  color: #13b955;
}
/* .nav-transparent {
  background: transparent;
} */
ul li a {
  color: #111;
}
.active-link {
  color: #13b955;
}
.nav-link:hover {
  color: #13b955;
}
.modal {
  background-color: #a6e6c01f;
}
.dropdown-item:hover {
  background-color: #13b955;
}
.form-control:focus {
  border-color: #13b955;
}
.registerLink {
  text-decoration: none;
}
.dropdown-toggle:hover{
  color: #13b955;
}
</style>
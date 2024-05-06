<template>
  <div class="container-fluid bg-light" style="height: 100vh">
    <div class="login_register">
      <ul
        class="nav nav-tabs mb-3 display: grid;place-items: center;text-center text-success"
        id="ex-with-icons"
        role="tablist"
      >
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="ex-with-icons-tab-2"
            data-mdb-toggle="tab"
            href="#ex-with-icons-tabs-2"
            role="tab"
            aria-controls="ex-with-icons-tabs-2"
            aria-selected="false"
            ><i class="fa-sharp fa-solid fa-right-to-bracket me-2"></i>Login</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link"
            id="ex-with-icons-tab-3"
            data-mdb-toggle="tab"
            href="#ex-with-icons-tabs-3"
            role="tab"
            aria-controls="ex-with-icons-tabs-3"
            aria-selected="false"
            ><i class="fa-sharp fa-solid fa-file-pen"></i> Register</a
          >
        </li>
      </ul>
      <div class="tab-content" id="ex-with-icons-content">
        <div
          class="tab-pane show active fade"
          id="ex-with-icons-tabs-2"
          role="tabpanel"
          aria-labelledby="ex-with-icons-tab-2"
        >
          <LoginComponent />
        </div>
        <div
          class="tab-pane fade"
          id="ex-with-icons-tabs-3"
          role="tabpanel"
          aria-labelledby="ex-with-icons-tab-3"
        >
          <RegisterComponent />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoginComponent from "../components/login&register/LoginComponent.vue";
import RegisterComponent from "../components/login&register/RegisterComponent.vue";
import NavComponentVue from "@/components/Partials/NavComponent.vue";
export default {
  name: "LoginRegister",
  components: {
    LoginComponent,
    RegisterComponent,
    NavComponentVue,
  },
};
</script>

<style scoped>
.container {
  position: relative !important;
}
.login_register {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.nav-link:visted {
  color: #14a44d;
}
.nav-tabs .nav-link.active {
  border-color: #14a44d;
  color: rgb(102, 101, 101);
}

.nav-link {
  color: #14a44d;
}

@media (max-width: 767.98px) {
  .login_register {
    width: 90% !important;
  }
}

@media (min-width: 991.98px) {
  .login_register {
    width: 50% !important;
  }
}

</style>
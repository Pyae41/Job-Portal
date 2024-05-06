<template>
  <div
    class="container-fluid d-flex justify-content-center align-items-center"
    style="height: 100vh;"
  >
    <div class="card p-3" style="width: 40%;">
      <div class="card-title">
        <h3 class="text-center">
          <span class="text-success"><strong>Career</strong></span>
          <span class="ms-2">Next</span>
        </h3>
        <h5 class="text-center text-muted" style="font-size: smaller;">Admin Login</h5>
      </div>
      <div class="card-body">
        <!-- login error message -->
        <div class="alert alert-danger d-flex align-items-center" role="alert" v-if="errorLogin">
          <i class="fas fa-exclamation-triangle me-3 text-danger"></i>
          <div class="me-2">{{ loginErrorMessage }}</div>
        </div>
        <!-- login error message -->
        <form @submit.prevent="login">
          <div class="form-group mb-3">
            <label for class="form-label">Email</label>
            <input
              type="email"
              :class="errors.email ? errorStyle : normalStyle"
              placeholder="your-email@gmail.com"
              v-model="credential.email"
              @focus="errors.email = false"
            />

            <small v-if="errors.email" class="text-danger">{{ errorMessages.email }}</small>
          </div>

          <div class="form-group" id="pass-input">
            <label for class="form-label">Password</label>
            <input
              :type="passVisible ? 'text' : 'password'"
              :class="errors.password ? errorStyle : normalStyle"
              placeholder="your-password:*******"
              v-model="credential.password"
              @focus="errors.password = false"
            />
            <i :class="`${passEye} text-muted`" id="passEye" @click="passwordVisible"></i>
          </div>
          <small v-if="errors.password" class="text-danger mb-3">{{ errorMessages.password }}</small>

          <button class="btn btn-success w-100 mt-3" type="button" disabled v-if="loading">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="visually-hidden">Loading...</span>
          </button>
          <button class="btn btn-success w-100 mt-3" type="submit" v-else>Login</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import ApiCalls from "../../api/index";
import router from "../../routes";
import Auth from "../../auth";

export default {
  name: "LoginFormComponent",
  data() {
    return {
      passVisible: false,
      passEye: "fas fa-eye-slash",
      loading: false,
      errorLogin: false,
      loginErrorMessage: "",
      credential: {
        email: "",
        password: ""
      },
      normalStyle: "form-control",
      errorStyle: "form-control border-danger",
      errors: {
        email: false,
        password: false
      },
      errorMessages: {}
    };
  },
  methods: {
    passwordVisible() {
      this.passVisible = this.passVisible ? false : true;
      this.passEye = this.passVisible ? "fas fa-eye" : "fas fa-eye-slash";
    },
    login() {
      let formData = new FormData();
      formData.append("email", this.credential.email);
      formData.append("password", this.credential.password);
      formData.append("role", "admin");
      //   console.log(this.loading);

      this.loading = true;
      this.errorLogin = false;

      setTimeout(() => {
        ApiCalls.post("login", formData)
          .then(response => {
            if (response.status == 200) {
              this.loading = false;

              let data = response.data;
              // console.log(response.data);
              Auth.login(data.authorization.access_token, data.user);
              setTimeout(() => {
                router.push("/");
              }, 100);
            }
          })
          .catch(error => {
            let err = error.response.data;
            // console.log(error);

            if (err.status == 401) {
              this.errorLogin = true;
              this.loginErrorMessage = err.message;
            }
            if (err.status == 400) {
              console.log(err);
              if (err.message.hasOwnProperty("email")) {
                this.errors.email = true;
                this.errorMessages.email = err.message.email[0];
              }

              if (err.message.hasOwnProperty("password")) {
                this.errors.password = true;
                this.errorMessages.password = err.message.password[0];
              }
            }
          });
        this.loading = false;
        this.credential.email = "";
        this.credential.password = "";
      }, 1000);
    }
  }
};
</script>
<style scoped>
#pass-input {
  position: relative;
}
#passEye {
  position: absolute;
  right: 10px;
  bottom: 10px;
}
</style>

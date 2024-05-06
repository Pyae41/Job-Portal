<template>
  <div class="register">
    <form @submit.prevent="registration">
      <div
        class="alert alert-success alert-dismissible fade show"
        v-if="success"
        role="alert"
      >
        <strong>Register Success!</strong> Browse to login.
        <button
          type="button"
          class="btn-close"
          data-mdb-dismiss="alert"
          aria-label="Close"
        >
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="form-group">
        <label for="" class="form-label">Name</label>
        <input
          type="text"
          name=""
          class="mdbInput"
          :class="errorMessages.name == '' ? normalStyle : errorStyle"
          placeholder="Enter your Name"
          :value="userData.name"
          @input="userData.name = $event.target.value"
        />
        <small v-if="errorMessages.name != ''" class="text-danger">{{
          errorMessages.name
        }}</small>
      </div>
      <div class="form-group mt-2">
        <label for="" class="form-label">Email</label>
        <input
          type="email"
          name=""
          class="mdbInput"
          :class="errorMessages.email == '' ? normalStyle : errorStyle"
          placeholder="Enter your Email"
          :value="userData.email"
          @input="userData.email = $event.target.value"
        />
        <small v-if="errorMessages.email != ''" class="text-danger">{{
          errorMessages.email
        }}</small>
      </div>
      <div class="form-group mt-2">
        <label for="" class="form-label">Password</label>
        <input
          type="password"
          name=""
          class="mdbInput"
          :class="errorMessages.password == '' ? normalStyle : errorStyle"
          placeholder="Enter your Password"
          :value="userData.password"
          @input="userData.password = $event.target.value"
        />
        <small v-if="errorMessages.password != ''" class="text-danger">{{
          errorMessages.password
        }}</small>
      </div>
      <div class="form-group mt-2">
        <label for="" class="form-label">Confirm Password</label>
        <input
          type="password"
          name=""
          class="mdbInput"
          :class="
            errorMessages.confirmpassword == '' ? normalStyle : errorStyle
          "
          placeholder="Enter your Password agian"
          :value="userData.confirmpassword"
          @input="userData.confirmpassword = $event.target.value"
        />
        <small v-if="errorMessages.confirmpassword != ''" class="text-danger">{{
          errorMessages.confirmpassword
        }}</small>
      </div>
      <div class="mt-3 submit d-flex justify-content-between">
        <router-link to="/" class="mt-1"
          ><i class="fa-solid fa-arrow-left"></i> back</router-link
        >
        <button class="btn btn-success" type="submit">Register</button>
      </div>
    </form>
  </div>
</template>

<script>
import Apicalls from "@/api/index";
import router from "@/router";
export default {
  name: "RegisterComponent",
  data() {
    return {
      userData: {
        name: "",
        email: "",
        password: "",
        confirmpassword: "",
      },
      errorMessages: {
        name: "",
        email: "",
        password: "",
        confirmpassword: "",
      },
      normalStyle: "form-control",
      errorStyle: "form-control border border-danger",
      success: false,
    };
  },
  methods: {
    registration() {
      var formData = new FormData();

      formData.append("name", this.userData.name);
      formData.append("email", this.userData.email);
      formData.append("password", this.userData.password);
      formData.append("password_confirmation", this.userData.confirmpassword);

      Apicalls.post("register", formData)
        .then((response) => {
          if (response.status == 201) {
            // this.userData = {
            //   name: "",
            //   email: "",
            //   password: "",
            //   confirmpassword: "",
            // };
            this.success = true;
            let email = response.data.user.email;

            window.sessionStorage.setItem('verified_email',email);

            router.push({
              name: "Verification",
            });
          }
        })
        .catch((error) => {
          let err = error.response.data.messages;

          console.log(err);
          if (err.hasOwnProperty("name")) {
            this.errorMessages.name = err.name[0];
          }
          if (err.hasOwnProperty("email")) {
            this.errorMessages.email = err.email[0];
          }
          if (err.hasOwnProperty("password")) {
            this.errorMessages.password = err.password[0];
          }
          if (err.hasOwnProperty("password_confirmation")) {
            this.errorMessages.confirmpassword = err.password_confirmation[0];
          }
        });
    },
  },
};
</script>

<style scoped>
.mdbInput:focus {
  border-color: #14a44d;
  box-shadow: 0 0 0 0.1rem #14a44e4a;
}
</style>
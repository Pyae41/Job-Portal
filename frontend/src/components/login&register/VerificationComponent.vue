<template>
  <div class="OTPVerification">
    <h4 class="text-success text-center mb-3">OTP Verification</h4>
    <div class="form-gruop">
      <input
        type="text"
        maxlength="6"
        class="mdbInput"
        placeholder="Enter OTP"
        @input="limitInput"
        :class="error ? 'form-control border border-danger' : 'form-control'"
        @focus="error = false"
      />
      <small class="text-danger" v-if="error">{{ errorMsg }}</small>
      <br />
      <small class="text-muted" v-if="verify">Send OTP in {{ timer }}</small>
      <div class="text-center mt-3">
        <button class="btn btn-success" v-if="verify" @click="verifyOTP">
          
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
            v-if="isLoading"
          ></span>
          <span v-else>Verify OTP</span>
        </button>
        <button class="btn btn-success" v-else @click="requestOTP">
          Resend OTP
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Apicalls from "@/api/index";
import router from "@/router";
export default {
  name: "VerificationComponent",
  data() {
    return {
      verify: false,
      otp: "",
      email: window.sessionStorage.getItem("verified_email"),
      formData: new FormData(),
      error: false,
      errorMsg: "",
      timer: 0,
      isLoading: false,
    };
  },
  mounted() {
    if (window.sessionStorage.getItem("verified_email")) {
      this.requestOTP();
      this.countDown();
    } else {
      router.push({ name: "login&register" });
    }
  },
  methods: {
    countDown() {
      if (this.timer > 0) {
        setTimeout(() => {
          this.timer--;
          this.countDown();
        }, 1000);
      } else {
        this.verify = false;
        this.otp = "";
        this.error = false;
        this.errorMsg = "";
      }
    },
    requestOTP() {
      this.verify = true;
      this.timer = 60;
      this.countDown();

      if (window.sessionStorage.getItem("verified_email")) {
        this.formData.append("email", this.email);
        Apicalls.post("requestOTP", this.formData);
        this.verify = true;
      }
    },
    verifyOTP() {
      this.formData.append("email", this.email);
      this.formData.append("otp", this.otp);
      this.isLoading= true;

      if (this.otp == "") {
        this.error = true;
        this.errorMsg = "Enter Sended OTP";
      } else {
        setTimeout(() => {
          Apicalls.post("verifyOTP", this.formData)
            .then((response) => {
              if (response.status == 200) {
                router.push({ name: "login&register" });
                window.sessionStorage.removeItem("verified_email");
              }
            })
            .catch((error) => {
              this.isLoading = false;
              this.otp = "";
              this.error = true;
              this.errorMsg = error.response.data.message;
            });
        }, 1500);
      }
    },
    limitInput(e) {
      this.otp = Number(e.target.value);

      if (isNaN(this.otp)) {
        this.otp = "";
        alert("OTP must be number");
      }
    },
  },
};
</script>

<style scoped>
.OTPVerification {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.mdbInput:focus {
  border-color: #14a44d;
  box-shadow: 0 0 0 0.1rem #14a44e4a;
  /* class="mdbInput" */
}
</style>
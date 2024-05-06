<template>
  <LayoutComponent>
    <div class="container">
      <h3>Add Company</h3>
      <router-link to="/admin/company" class="btn btn-sm btn-success">Back</router-link>

      <div class="card w-50 mx-auto">
        <div class="card-body">
          <form action class="mt-3" @submit.prevent="addCompany" enctype="multipart/form-data">
            <div class="form-group mb-3">
              <label for class="form-label">Company Name</label>
              <input
                type="text"
                name
                id
                :class="errors.name ? errorStyle : normalStyle"
                placeholder="Enter Company Name"
                :value="company.name"
                @input="company.name = $event.target.value"
                @focus="errors.name = false"
              />
              <small v-if="errors.name" class="text-danger">{{ errorMessages.name }}</small>
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Company Email</label>
                  <input
                    type="email"
                    name
                    id
                    :class="errors.email ? errorStyle : normalStyle"
                    placeholder="Enter Company Email"
                    :value="company.email"
                    @input="company.email = $event.target.value"
                    @focus="errors.email = false"
                  />
                  <small v-if="errors.email" class="text-danger">{{ errorMessages.email }}</small>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group mb-3">
                  <label for class="form-label">Company Phone</label>
                  <input
                    type="text"
                    name
                    id
                    :class="errors.phone ? errorStyle : normalStyle"
                    placeholder="Enter Company Address"
                    :value="company.phone"
                    @input="company.phone = $event.target.value"
                    @focus="errors.phone = false"
                  />
                  <small v-if="errors.phone" class="text-danger">{{ errorMessages.phone }}</small>
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for class="form-label">Company Address</label>
              <textarea
                name
                id
                cols="10"
                rows="4"
                class="form-control"
                :class="errors.address ? errorStyle : normalStyle"
                placeholder="Enter Company Address"
                :value="company.address"
                @input="company.address = $event.target.value"
                @focus="errors.address = false"
              ></textarea>
              <small v-if="errors.address" class="text-danger">{{ errorMessages.address }}</small>
            </div>

            <div class="form-group mb-3">
              <div v-if="!company.company_logo">
                <div
                  :class="['dropZone', dragging ? 'dropZone-over' : '',errors.company_logo ? 'dropZone-error' : '']"
                  @dragenter="dragging = true"
                  @dragleave="dragging = false"
            >
                  <div class="dropZone-info" @drag="onChange">
                    <span class="fa fa-cloud-upload dropZone-title"></span>
                    <span class="dropZone-title">Drop file or click to upload</span>
                    <div class="dropZone-upload-limit-info">
                      <div>extension support: JPG,JPEG,PNG</div>
                      <div>maximum file size: 5 MB</div>
                    </div>
                  </div>
                  <input type="file" @change="onChange" />
                </div>
              </div>
              <div v-else class="dropZone-uploaded">
                <div class="dropZone-uploaded-info">
                  <span class="dropZone-title">{{ this.company.company_logo.name }}</span>
                  <button
                    type="button"
                    class="btn btn-success removeFile"
                    @click="removeFile"
                  >Remove File</button>
                </div>
              </div>
              <small class="text-danger" v-if="errors.company_logo">{{ this.errorMessages.company_logo }}</small>
            </div>
            <button type="submit" class="btn btn-success w-100">Create</button>
          </form>
        </div>
      </div>
    </div>
  </LayoutComponent>
</template>

  <script>
import LayoutComponent from "../Layouts/LayoutComponent.vue";
import ApiCalls from "../../api/index.js";
import router from "../../routes";

export default {
  name: "AddCategoryComponent",
  components: {
    LayoutComponent
  },
  data() {
    return {
      company: {
        name: "",
        email: "",
        phone: "",
        address: "",
        company_logo: ""
      },
      normalStyle: "form-control",
      errors: {
        name: false,
        email: false,
        phone: false,
        address: false,
        company_logo: false
      },
      errorMessages: {
        name: "",
        email: "",
        phone: "",
        address: "",
        company_logo: ""
      },
      errorStyle: "form-control border-danger",
      dragging: false
    };
  },
  computed:{
    extension(){
        return (this.company.company_logo) ? this.company.company_logo.split('.').pop() : '';
    }
  },
  methods: {
    onChange(e) {
      var files = e.target.files || e.dataTransfer.files;

      if (!files.length) {
        this.dragging = false;
        return;
      }
      this.errors.company_logo = false;
      this.createFile(files[0]);
    },
    createFile(file) {
        let allowExt = ['jpeg','jpg','png'];
      if (!allowExt.includes(file.name.split('.').pop())) {
        alert("Only support JPEG | JPG | PNG");
        this.dragging = false;
        return;
      }

      if (file.size > 5000000) {
        alert("please check file size no over 5 MB.");
        this.dragging = false;
        return;
      }

      this.company.company_logo = file;
    //   console.log(this.file);
      this.dragging = false;
    },
    removeFile(){
        this.company.company_logo = '';
    },
    addCompany() {
      var formData = new FormData();
      formData.append("name", this.company.name);
      formData.append("email", this.company.email);
      formData.append("phone", this.company.phone);
      formData.append("address", this.company.address);
      formData.append("company_logo", this.company.company_logo);

      //   formData.get("name");
      //   console.log(this.company);

      ApiCalls.post("admin/company", formData)
        .then(response => {
          if (response.data.status == 201) {
            // alert('hello');
            router.push("/admin/company");
          }
        })
        .catch(error => {
          let err = error.response.data.messages;

            console.log(err);
          if (err.hasOwnProperty("name")) {
            this.errors.name = true;
            this.errorMessages.name = err.name[0];
          }
          if (err.hasOwnProperty("email")) {
            this.errors.email = true;
            this.errorMessages.email = err.email[0];
          }
          if (err.hasOwnProperty("phone")) {
            this.errors.phone = true;
            this.errorMessages.phone = err.phone[0];
          }
          if (err.hasOwnProperty("address")) {
            this.errors.address = true;
            this.errorMessages.address = err.address[0];
          }
          if (err.hasOwnProperty("company_logo")) {
            this.errors.company_logo = true;
            this.errorMessages.company_logo = err.company_logo[0];
          }
        });
    }
  }
};
</script>

  <style scoped>
.dropZone {
  width: 100%;
  height: 200px;
  position: relative;
  border: 2px dashed #eee;
}

.dropZone:hover {
  border: 2px solid #14a44d !important;
}

.dropZone:hover .dropZone-title {
  color: #14a44d !important;
}

.dropZone-info {
  color: #a8a8a8;
  position: absolute;
  top: 50%;
  width: 100%;
  transform: translate(0, -50%);
  text-align: center;
}

.dropZone-error {
  border-color: #DC4C64;
}


.dropZone-title {
  color: #787878;
}

.dropZone input {
  position: absolute;
  cursor: pointer;
  top: 0px;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
}

.dropZone-upload-limit-info {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
}

.dropZone-over {
  background: #5c5c5c;
  opacity: 0.8;
}

.dropZone-uploaded {
  width: 100%;
  height: 200px;
  position: relative;
  border: 2px dashed #eee;
}

.dropZone-uploaded-info {
  display: flex;
  flex-direction: column;
  align-items: center;
  color: #a8a8a8;
  position: absolute;
  top: 50%;
  width: 100%;
  transform: translate(0, -50%);
  text-align: center;
}

.removeFile {
  width: 200px;
}
</style>

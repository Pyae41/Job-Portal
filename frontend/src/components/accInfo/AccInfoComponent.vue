<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-4 p-5">
          <div class="row">
            <div class="col-md-3">
              <img src="../../image/banner.png" style="width: 100%; height: 100%;" />
            </div>
            <div class="col-md-9 mt-3">
              <div class="d-flex">
                <h4>Arkar Nyein </h4><span class="text-muted float-left ms-1"> (Junior Developer)</span>
              </div>
              <button @click.prevent="addInfo" class="btn btn-success">
                <i class="fas fa-plus text-light me-2"></i>Add profile Section
              </button>
              <span class="badge badge-success me-auto" style="font-size: small; cursor: pointer;" @click="downCV">download cv</span>
            </div>
          </div>
          <hr class="d-lg-none" />
          <div class="row">
            <div class="col-md-3 d-none d-md-block"></div>
            <div class="col-md-9">
            </div>
          </div>
        </div>
        <div class="card mt-4 p-5">
          <div class="d-flex justify-content-between">
            <h4>Personal Profile</h4>
            <div>
              <a data-mdb-toggle="modal" data-mdb-target="#editPersonalprofile">
                <i class="fa-solid fa-pencil"></i>
              </a>
            </div>
          </div>
          <div class="">
            <p><i class="fas fa-user me-2 mt-3"></i>Male</p>
            <hr />
            <p><i class="fa-solid me-2 fa-cake-candles"></i>August 4, 2000</p>
            <hr />
            <p><i class="fas fa-id-card me-1"></i>13/TaKaNa(N)300384</p>
            <hr />
            <p><i class="fa-solid fa-heart me-1"></i>Single</p>
            <hr />
            <p><i class="fa-solid me-1 fa-phone"></i> 09793798369</p>
            <hr>
            <p><i class="fa-solid me-1 fa-envelope"></i> arkarnyein48@gmail.com</p>
            <hr>
            <p><i class="fas me-2 fa-home"></i>Yangon</p>
            <hr>
            <p><i class="fa-solid fa-sharp me-2 fa-chart-simple"></i> HTML,CSS,JavaScript</p>
            <hr>
          </div>
        </div>
        <div class="card mt-4 p-5">
          <div class="d-flex justify-content-between">
            <h4>Education</h4>
            <div>
              <a data-mdb-toggle="modal" data-mdb-target="#addEducation">
                <i class="fa-solid fa-plus me-5"></i>
              </a>
              <a data-mdb-toggle="modal" data-mdb-target="#editEducation">
                <i class="fa-solid fa-pencil"></i>
              </a>
            </div>
          </div>
          <div class="">
            <p>
              <i class="fas fa-graduation-cap me-2 mt-3"></i>Mandalay
              Technological University
            </p>
            <hr />
            <p><i class="fas me-2 fa-school"></i>No(1).Basic Education</p>
          </div>
        </div>
        <div
          class="modal p-3 fade"
          id="contactInfo"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Arkar Nyein</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-mdb-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <div class="d-flex justify-content-between">
                  <h5>Contact Info</h5>
                  <a data-mdb-toggle="modal" data-mdb-target="#editContact"
                    ><i class="fas fa-pencil"></i
                  ></a>
                </div>
                <h6><i class="fas fa-envelope me-2"></i>Email</h6>
                <small style="font-size: medium"> arkarnyein@gmail.com </small>
                <h6 class="mt-3"><i class="fas fa-phone me-2"></i>Phone</h6>
                <small style="font-size: medium"> arkarnyein@gmail.com </small>
              </div>
            </div>
          </div>
        </div>
        <div
          class="modal fade"
          id="editPersonalprofile"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Edit Personal Profile
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-mdb-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="" class="form-label">Gender</label><br>
                  <input type="radio" name="" id="" class="form-check-input" />
                  <label for="" class="form-check-label">Male</label>
                  <input type="radio" name="" id="" class="form-check-input ms-2" />
                  <label for="" class="form-check-label">Female</label>
                </div>
                <div class="form-group mt-2">
                  <label for="" class="form-label">Marital Status</label><br>
                  <input type="radio" name="" id="" class="form-check-input" />
                  <label for="" class="form-check-label">Single</label>
                  <input type="radio" name="" id="" class="form-check-input ms-2" />
                  <label for="" class="form-check-label">Married</label>
                </div>
                <div class="form-group mt-2">
                  <label for="" class="form-label">Profession</label>
                  <input type="date" name="" id="" class="form-control" />
                </div>
                <div class="form-group mt-2">
                  <label for="" class="form-label">Skills</label>
                  <input type="date" name="" id="" class="form-control" />
                </div>
                <div class="form-group mt-2">
                  <label for="" class="form-label">Date of birth</label>
                  <input type="date" name="" id="" class="form-control" />
                </div>
                <div class="form-group mt-2">
                  <label for="" class="form-label">Email</label>
                  <input type="email" name="" id="" class="form-control" />
                </div>
                <div class="form-group mt-2">
                  <label for="" class="form-label">Phone Number</label>
                  <input type="date" name="" id="" class="form-control" />
                </div>
                <div class="form-group mt-2 ">
                  <label for="" class="form-label">Address</label>
                  <div class="d-flex justify-content-between">
                    <input type="date" name="" id="" class="form-control" />
                    <input type="date" name="" id="" class="form-control mx-1" />
                    <input type="date" name="" id="" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-mdb-dismiss="modal"
                >
                  Close
                </button>
                <button type="button" class="btn btn-success">
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
        <div
          class="modal fade"
          id="addEducation"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Education
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-mdb-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="" class="form-label">Gender</label><br>
                  <input type="" name="" id="" class="form-check-input" />
                  <label for="" class="form-check-label">Male</label>
                  <input type="radio" name="" id="" class="form-check-input ms-2" />
                  <label for="" class="form-check-label">Female</label>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-mdb-dismiss="modal"
                >
                  Close
                </button>
                <button type="button" class="btn btn-success">
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-none">
      <div class="container p-5 border  mt-3 cover" id="cv">
        <div class="row w-80 mx-auto">
            <div class="col-12 mb-5">
                <div class="row w-75 mx-auto">
                    <div class="col-6 d-flex align-items-end">
                        <div class="name-group">
                            <h2><strong>Pyae Phyo Zan</strong></h2>
                            <small><strong>Software Developer</strong></small>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center">
                        <img src="../../image/banner2.jpg" alt="" srcset=""
                            style="width: 150px;height:150px;">
                    </div>
                </div>
                <hr class="w-25 mx-auto my-4 divider">
            </div>
            <div class="col-12 mb-5">
                <div class="row w-75 mx-auto">
                    <div class="col-12">
                        <h3><strong>Personal Profile</strong></h3>
                        <hr class="divider">
                    </div>
                    <div class="col-12 mt-3">
                        <div class="w-100 d-flex justify-content-between">
                            <div>
                                <small><strong>Date of birth</strong></small><br><br>
                                <small><strong>Nationality</strong></small><br><br>
                                <small><strong>NRC</strong></small><br><br>
                                <small><strong>Phone</strong></small><br><br>
                                <small><strong>Email</strong></small><br><br>
                                <small><strong>Address</strong></small><br><br>
                            </div>
                            <div style="display: grid;">
                                <small><strong>-</strong></small>
                                <small><strong>-</strong></small>
                                <small><strong>-</strong></small>
                                <small><strong>-</strong></small>
                                <small><strong>-</strong></small>
                                <small><strong>-</strong></small>
                            </div>
                            <div style="display: grid;">
                                <small><strong>20/12/2001</strong></small>
                                <small><strong>Myanmar(Burma)</strong></small>
                                <small><strong>9/KhaMaSa(N)009312</strong></small>
                                <small><strong>+959999999999</strong></small>
                                <small><strong>pyae@gmail.com</strong></small>
                                <small><strong>Mahaaungmyay,Mandalay</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5">
                <div class="row w-75 mx-auto">
                    <div class="col-12">
                        <h3><strong>Career Objective</strong></h3>
                        <hr class="divider">
                    </div>
                    <div class="col-12 mt-3">
                        <p class="font-size: medium;">
                            To leverage my knowledge in programming and web development to create
                            modern, secure applications with a high level of usability as a developer.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5 mt-5">
                <div class="row w-75 mx-auto mt-5">
                    <div class="col-12 mt-5">
                        <h3 class="mt-5"><strong>Educations</strong></h3>
                        <hr class="divider">
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-5">
                <div class="row w-75 mx-auto">
                    <div class="col-12">
                        <h3><strong>Skills</strong></h3>
                        <hr class="divider">
                    </div>
                    <div class="col-12">
                        <p><strong>Technical:</strong>&nbsp;&nbsp;PHP,Laravel,HTML,CSS,Javascript,Vuejs,SQL,<br>Python,Django,Java,Springboot
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-12 mb-5">
                <div class="row w-75 mx-auto">
                    <div class="col-12">
                        <h3><strong>Experiences</strong></h3>
                        <hr class="divider">
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-4">
                                <small style="font-size: medium;"><strong>[2018-2021]</strong></small>
                                <small style="font-size: medium;"><strong>System Creator</strong></small>
                                <small style="font-size: medium;"><strong>Metro IT & Japanese Language
                                        Center</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
import router from '@/router';
import html2pdf from 'html2pdf.js'
// import { saveAs } from 'file-saver'
export default {
  name: "AccInfoComponent",
  data(){
    return{
      img: "https://img.freepik.com/free-icon/user_318-159711.jpg"
    }
  },
  computed: {
    addInfo(){
      router.push('/Addinfo');
    }
  },
  methods: {
      downCV() {
        const element = document.getElementById('cv') 

        html2pdf()
          .set({ margin: 0, filename: 'formatCV.pdf', image: { type: 'jpeg', quality: 0.98 } })
          .from(element)
          .save()
          .then(() => {
            console.log('PDF successfully generated')
          })
          .catch(error => {
            console.error('Error generating PDF:', error)
          })
      }
    }
};
</script>

<style scoped>
.divider {
            border: none;
            height: 2px;
            background: #067e36;
            background: repeating-linear-gradient(90deg, #067e36, #067e36 10px, transparent 6px, transparent 12px);
        }
        .cover {
  width: 21cm;
  margin: 1cm auto;
  padding: 1cm;
}

@media print {
  .cover {
    margin: 0;
    padding: 0;
  }

  .cover * {
    line-height: 1.5;
  }
}
</style>
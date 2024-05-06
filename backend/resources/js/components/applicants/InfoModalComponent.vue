<style scoped>
    .vue-neat-modal {
        max-height: 80%;
    }
</style>
<template>
    <Modal
    v-model="isOpen"
    modal-transition="slide-up"
    teleportTarget="#p_info"
    alignX="right"
    maxWidth="1200px">
        <div class="card p-3">

            <div class="card-title d-flex justify-content-between">
                <div>
                    <button class="btn btn-sm btn-success" @click.prevent="accept(personal_info.user_id,this.$route.params.id,personal_info.email)" v-if="jobStatus == 'Pending'">Accept</button>
                    <button class="btn btn-sm btn-danger" @click.prevent="reject(personal_info.user_id,this.$route.params.id,personal_info.email)" v-if="jobStatus == 'Pending'">Reject</button>
                    <button class="btn btn-primary btn-sm" @click.prevent="downCV(personal_info.name)">Download CV</button>
                </div>
                <span class="" style="cursor: pointer;" @click="openModal(false)">X</span>
            </div>
            <div class="card-content" v-if="personal_info">
                <div class="" style="height: 500px; overflow: auto;">
                    <div class="container p-5 border  mt-3 cover" ref="cv">
                        <div class="row w-80 mx-auto">
                            <div class="col-12">
                                <div class="row w-75 mx-auto">
                                    <div class="col-6 d-flex align-items-end">
                                        <div class="name-group">
                                            <h2><strong>{{ personal_info.name }}</strong></h2>
                                            <small><strong>{{ personal_info.profession }}</strong></small>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center">
                                        <img :src="`data:image/*;base64,${personal_info.profile_pic}`" alt="" srcset=""
                                            style="width: 150px;height:150px;">
                                    </div>
                                </div>
                                <hr class="w-25 mx-auto my-4 divider">
                            </div>
                            <div class="col-12">
                                <div class="row w-75 mx-auto">
                                    <div class="col-12">
                                        <h3><strong>Personal Profile</strong></h3>
                                        <hr class="divider">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="w-100 d-flex justify-content-between">
                                            <div>
                                                <small><strong>Date of birth</strong></small><br><br>
                                                <!-- <small><strong>Nationality</strong></small><br><br> -->
                                                <small><strong>NRC</strong></small><br><br>
                                                <small><strong>Phone</strong></small><br><br>
                                                <small><strong>Email</strong></small><br><br>
                                                <small><strong>Address</strong></small><br><br>
                                            </div>
                                            <div style="display: grid;">
                                                <small><strong>-</strong></small>
                                                <!-- <small><strong>-</strong></small> -->
                                                <small><strong>-</strong></small>
                                                <small><strong>-</strong></small>
                                                <small><strong>-</strong></small>
                                                <small><strong>-</strong></small>
                                            </div>
                                            <div style="display: grid;">
                                                <small><strong>{{ personal_info.dob.split('-').reverse().join('/') }}</strong></small>
                                                <!-- <small><strong>Myanmar(Burma)</strong></small> -->
                                                <small><strong>{{ personal_info.nrc }}</strong></small>
                                                <small><strong>{{ personal_info.phone }}</strong></small>
                                                <small><strong>{{ personal_info.email }}</strong></small>
                                                <small><strong>{{ personal_info.address }},{{ personal_info.city }}</strong></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" v-if="personal_info.career_objective">
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

                            <div class="col-12" v-if="personal_info.educations">
                                <div class="row w-75 mx-auto">
                                    <div class="col-12">
                                        <h3 class="mt-5"><strong>Educations</strong></h3>
                                        <hr class="divider">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 d-flex mb-4" v-for="education in personal_info.educations" :key="education.index">
                                                <small style="font-size: medium;"><strong>[ {{ education.start_date.split('-')[0] }} - {{ education.end_date.split('-')[0] }} ]</strong></small>
                                                <small style="font-size: medium;"><strong></strong></small>
                                                <small style="font-size: medium;" class="ms-5"><strong>{{ education.degree_name }}</strong></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row w-75 mx-auto">
                                    <div class="col-12">
                                        <h3><strong>Skills</strong></h3>
                                        <hr class="divider">
                                    </div>
                                    <div class="col-12">
                                        <p><strong>Technical:</strong>&nbsp;&nbsp;{{ personal_info.skill }}
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12" v-if="personal_info.experiences">
                                <div class="row w-75 mx-auto">
                                    <div class="col-12">
                                        <h3><strong>Experiences</strong></h3>
                                        <hr class="divider">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between mb-4" v-for="experience in personal_info.experiences" :key="experience.index">
                                                <small style="font-size: medium;"><strong>[ {{ experience.start_date.split('-')[0] }} - {{ experience.end_date.split('-')[0] }} ]</strong></small>
                                                <small style="font-size: medium;"><strong>{{ experience.position }}</strong></small>
                                                <small style="font-size: medium;"><strong>{{ experience.company }}</strong></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script>
import { ref } from 'vue';
import { Modal } from 'vue-neat-modal';
import 'vue-neat-modal/dist/vue-neat-modal.css';
import ApiCalls from "../../api/index";
import html2pdf from 'html2pdf.js'

export default{
    name: 'InfoModalComponent',
    components: {
        Modal
    },
    props: {
        job_post_id: {
            type: Number,
        }
    },
    setup(){
        const isOpen = ref(false);
        const personal_info = ref();
        const jobStatus = ref();
        const cv = ref();

        function openModal(status,personalId = null,statusJob){
            isOpen.value = status;
            jobStatus.value = statusJob;

            console.log(jobStatus.value);

            if(personalId != null){
                getPersonalInfo(personalId);
            }

        }

        function getPersonalInfo(personalId){
            ApiCalls.get(`admin/applicants/getPersonalInfo/${personalId}`)
            .then(response => {
                // console.log(response);
                if(response.data.status == 200){
                    personal_info.value = response.data.personalInfos;
                    console.log(personal_info.value);
                }
            })
            .catch(error  => {
                console.log(error);
            });
        }

        function downCV(name){
            const element = cv.value;

            html2pdf()
            .set({ margin: 0, filename: `${name}.pdf`, image: { type: 'jpeg', quality: 0.98 } })
            .from(element)
            .save()
            .then(() => {
                console.log('PDF successfully generated')
            })
            .catch(error => {
                console.error('Error generating PDF:', error)
            })
        }
        return {
            isOpen,
            personal_info,
            cv,
            openModal,
            downCV,
            jobStatus
        }
    },
    methods: {
        accept(user_id,job_post_id,email){
            let message = confirm();
            if(message){
                let data = {
                    'user_id' : user_id,
                    'job_post_id': job_post_id,
                    'email' : email,
                    'status' : 'Accept',
                };

                ApiCalls.post("admin/applicants/acceptReject",data)
                .then(response => {
                    // console.log(response);
                    if(response.data.status == 200){
                        this.openModal(false);
                        this.$emit('success');
                    }
                })
                .catch(error  => {
                    console.log(error);
                });
            }
        },
        reject(user_id,job_post_id,email){
            let message = confirm();
            if(message){

                let data = {
                    'user_id' : user_id,
                    'job_post_id': job_post_id,
                    'email' : email,
                    'status' : 'Reject',
                };

                ApiCalls.post("admin/applicants/acceptReject",data)
                .then(response => {
                    // console.log(response);
                    if(response.data.status == 200){
                        this.openModal(false);
                        this.$emit('success');
                    }
                })
                .catch(error  => {
                    console.log(error);
                });
            }
        }
    }
}
</script>

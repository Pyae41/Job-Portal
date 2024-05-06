<template>
    <div class="contain">
        <VerificationComponent/>
    </div>
</template>

<script>
import VerificationComponent from '@/components/login&register/VerificationComponent.vue'
export default {
    name:"VerificationView",
    components:{
        VerificationComponent
    },
    data(){
        return {
            email: ''
        }
    },  
}
</script>

<style scoped>

</style>
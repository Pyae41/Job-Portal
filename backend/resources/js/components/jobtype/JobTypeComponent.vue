<template>
    <tr>
        <td>
            {{ index }}
        </td>
        <td>
            {{ jobtype.job_type }}
        </td>
        <td>
            <router-link :to="`/admin/jobtype/${jobtype.id}/edit`" class="btn btn-sm btn-primary"><i class="fas fa-info"></i></router-link>
            <button class="btn btn-sm btn-danger" @click="deleteJobType"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'JobTypeComponent',
    props: ['jobtype','index'],
    methods:{
        deleteJobType(){
            this.$emit('deleteJT');
            console.log()
        }
    }
}
</script>

<style>

</style>

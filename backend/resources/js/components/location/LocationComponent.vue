<template>
    <tr>
        <td>
            {{ index }}
        </td>
        <td>
            {{ location.city }}
        </td>
        <td>
            {{ location.country }}
        </td>
        <td>
            <router-link :to="`/admin/location/${location.id}/edit`" class="btn btn-sm btn-primary"><i class="fas fa-info"></i></router-link>
            <button class="btn btn-sm btn-danger" @click="deleteLocation"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'JobTypeComponent',
    props: ['location','index'],
    methods:{
        deleteLocation(){
            this.$emit('deleteLocation');
            console.log()
        }
    }
}
</script>

<style>

</style>

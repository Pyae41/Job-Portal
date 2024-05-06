<template>
    <tr>
        <td>
            {{ index  }}
        </td>
        <td class="w-25">
            <img :src="`data:image/*;base64,${company.company_logo}`" alt="" class="img-fluid"  style="height: 50px;"/>
        </td>
        <td>
            {{ company.name }}
        </td>
        <td>
            {{ company.email }}
        </td>
        <td>
            {{ company.phone }}
        </td>
        <td>
            <router-link :to="`/admin/company/${company.id}/edit`" class="btn btn-sm btn-primary">
                <i class="fas fa-info"></i>
            </router-link>
            <button class="btn btn-sm btn-danger" @click="deleteCompany">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'CompanyComponent',
    props: ['company','index'],
    methods:{
        deleteCompany(){
            this.$emit('deleteCom');
        }
    }
}
</script>

<style>

</style>

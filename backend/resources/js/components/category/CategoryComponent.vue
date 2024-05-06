<template>
    <tr>
        <td>
            {{ index }}
        </td>
        <td>
            {{ category.name }}
        </td>
        <td>
            <router-link :to="`/admin/category/${category.id}/edit`" class="btn btn-sm btn-primary"><i class="fas fa-info"></i></router-link>
            <button class="btn btn-sm btn-danger" @click="deleteCategory"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
</template>

<script>
export default {
    name: 'CategoryComponent',
    props: ['category','index'],
    methods:{
        deleteCategory(){
            this.$emit('deleteCate');
            console.log()
        }
    }
}
</script>

<style>

</style>

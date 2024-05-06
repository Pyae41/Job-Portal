import CategoryView from '../../views/category/CategoryView.vue';
import AddCategoryView from '../../views/category/AddCategoryView.vue';
import EditCategoryView from '../../views/category/EditCategoryView.vue';

export const category = [
    {
        path: '',
        component: CategoryView,
        name: 'category.index',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/add',
        component: AddCategoryView,
        name: 'category.add',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/:id/edit',
        component: EditCategoryView,
        name: 'category.edit',
        meta: {
            requiresAuth: true,
        }
    }
];

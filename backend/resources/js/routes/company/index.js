// Company
import CompanyView from '../../views/company/CompanyView.vue';
import AddCompanyView from '../../views/company/AddCompanyView.vue';
import EditCompanyView from '../../views/company/EditCompanyView.vue';


export const company = [
    {
        path: '',
        component: CompanyView,
        name: 'company.index',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/add',
        component: AddCompanyView,
        name: 'company.add',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/:id/edit',
        component: EditCompanyView,
        name: 'company.edit',
        meta: {
            requiresAuth: true,
        }
    }
];

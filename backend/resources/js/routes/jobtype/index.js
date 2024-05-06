import JobTypeView from '../../views/jobtype/JobTypeView.vue';
import AddJobTypeView from '../../views/jobtype/AddJobTypeView.vue';
import EditJobTypeView from '../../views/jobtype/EditJobTypeView.vue';

export const jobtype = [
    {
        path: '',
        component: JobTypeView,
        name: 'jobtype.index',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/add',
        component: AddJobTypeView,
        name: 'jobtype.add',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/:id/edit',
        component: EditJobTypeView,
        name: 'jobtype.edit',
        meta: {
            requiresAuth: true,
        }
    }

];

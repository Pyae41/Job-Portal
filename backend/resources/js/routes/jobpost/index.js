// Job Post
import JobPostView from '../../views/jobpost/JobPostView.vue';
import AddJobPostView from '../../views/jobpost/AddJobPostView.vue';
import EditJobPostView from '../../views/jobpost/EditJobPostView.vue';

export const jobpost = [
    {
        path: '',
        component: JobPostView,
        name: 'jobpost.index',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/add',
        component: AddJobPostView,
        name: 'jobpost.add',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/:id/edit',
        component: EditJobPostView,
        name: 'jobpost.edit',
        meta: {
            requiresAuth: true,
        }
    }
];

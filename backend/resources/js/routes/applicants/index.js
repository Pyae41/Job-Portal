import ApplicantsView from '../../views/applicants/ApplicantsView.vue';
import JobApplicantsView from '../../views/applicants/JobApplicantsView.vue';

export const applicants = [
    {
        path: '',
        component: ApplicantsView,
        name: 'applicants.index',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/jobPosts/:id/applicants',
        component: JobApplicantsView,
        name: 'applicants.jobApplicants',
        meta: {
            requiresAuth: true,
        }
    }
]

import { createRouter, createWebHistory } from "vue-router";

// login form
import LoginFormView from '../views/LoginFormView.vue';
import Auth from "../auth";

// dashboard
import DashboardView from '../views/dashboard/DashboardView.vue';


// admin category routes
import { category } from "./category";

// admin jobtype route
import { jobtype } from "./jobtype";

// admin company routes
import { company } from "./company";

// admin jobpost route
import { jobpost } from "./jobpost";

// admin location route
import { location } from "./location";

// admin applicant route
import { applicants } from "./applicants";

const adminRoutes = [
    {
        path: '/dashboard',
        component: DashboardView,
        name: 'admin.dashboard',
        meta: {
            requiresAuth: true,
        }
    },
    ...prefixRoutes('/category', category),
    ...prefixRoutes('/company', company),
    ...prefixRoutes('/jobtype', jobtype),
    ...prefixRoutes('/jobpost', jobpost),
    ...prefixRoutes('/location', location),
    ...prefixRoutes('/applicants',applicants),
];


const routes = [
    {
        path: '',
        redirect: '/admin/dashboard'
    },
    {
        path: '/login',
        component: LoginFormView,
        name: 'login',
    },
    ...prefixRoutes('/admin', adminRoutes),

];

function prefixRoutes(prefix, routes) {
    return routes.map(route => {
        route.path = prefix + '' + route.path;
        return route;
    });
}
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (Auth.check()) {
            next();
            return;
        }
        else {
            router.push('/login');
        }
    }
    else {
        next();
    }
});


export default router;

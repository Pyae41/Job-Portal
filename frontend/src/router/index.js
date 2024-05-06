import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginRegisterView from '../views/LoginRegisterView.vue'
import JobsView from '../views/JobsView.vue'
import AccInfoView from '../views/AccInfoView.vue'
import JobDetailView from '../views/JobDetailView.vue';
import AddaccInfoView from '../views/AddaccInfoView.vue';
import VerificationView from '../views/VerificationView.vue';
import AppliedJobsView from '../views/AppliedJobsView.vue';
import Auth from '@/auth/index';
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    component: function () {
      return import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
    }
  },
  {
    path: '/login&register',
    name: 'login&register',
    component: LoginRegisterView
  },
  {
    path: '/verification',
    name: 'Verification',
    component: VerificationView
  },
  {
    path:'/jobs',
    name: 'jobs',
    component:JobsView
  },
  {
    path:'/Accinfo',
    name: 'Accinfo',
    component:AccInfoView,
    // meta:{
    //   requiresAuth: true,
    // }
  },
  {
    path:'/Addinfo',
    name: 'Addinfo',
    component:AddaccInfoView,
    meta:{
      requiresAuth: true,
    }
  },
  {
    path:'/AppliedJobs',
    name: 'AppliedJobs',
    component:AppliedJobsView,
  },
  {
    path:'/jobs/jobDetail/:id',
    name:'jobDetail',
    component:JobDetailView,
    meta:{
      requiresAuth: true,
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: 'active-link'
});

router.beforeEach((to,from,next) => {
    if(to.matched.some(record => record.meta.requiresAuth)){
      if(Auth.check()){
          next();
          return;
      }
      else{
        router.push('/login&register');
      }
    }
    else{
      next();
    }
});

export default router

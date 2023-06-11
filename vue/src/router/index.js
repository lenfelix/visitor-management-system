import {createRouter, createWebHistory} from 'vue-router'
import Dashboard from '../views/Dashboard.vue';
import Login from '../views/Login.vue'
import CheckIn from '../views/CheckIn.vue'
import store from '../store'
import DefaultLayout from '../components/DefaultLayout.vue'
import AuthLayout from '../components/AuthLayout.vue'

const routes = [
    {
        path: '/',
        redirect: '/dashboard',
        component: DefaultLayout,
        meta: {requiresAuth: true},
        children: [
            {path: '/dashboard', name: 'Dashboard', component: Dashboard},
            {path: '/checkin', name: 'CheckIn', component: CheckIn}
        ]
    },
    {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: {isGuest: true},
        children: [
            {
                path: '/login',
                name: 'Login',
                component: Login
            },
        ]
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
      next({ name: "Login" });
    } else if (store.state.user.token && (to.meta.isGuest)) {
      next({ name: "Dashboard" });
    } else {
      next();
    }
  });

export default router;
import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';
import Dashboard from "./views/Dashboard";
import Login from "./views/Login";
import Employee from "./views/Employee";
import EmployeeLogin from "./views/EmployeeLogin";
import CompanyLogin from "./views/CompanyLogin";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/company/login',
        name: 'CompanyLogin',
        component: CompanyLogin,
        meta: {
            auth: false
        }
    },
    {
        path: '/employee/login',
        name: 'EmployeeLogin',
        component: EmployeeLogin,
        meta: {
            auth: false
        }
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {requiresAuth: true}
    },
    {
        path: '/employee',
        name: 'Employee',
        component: Employee,
        meta: {requiresAuth: true}
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'Login' })
        return
    }

    // if logged in redirect to dashboard
    if((to.path === '/') && store.state.isLoggedIn && store.state.guard === 'user') {
        next({ name: 'Dashboard' })
        return
    }

    if((to.path === '/employee/login') && store.state.isLoggedIn && store.state.guard === 'employee') {
        next({ name: 'Dashboard' })
        return
    }

    if((to.path === '/company/login') && store.state.isLoggedIn && store.state.guard === 'company') {
        next({ name: 'Dashboard' })
        return
    }

    next()
});

export default router

import Vue from 'vue';
import VueRouter from 'vue-router'
import Dashboard from "./views/Dashboard";
import Login from "./views/Login";
import Employee from "./views/Employee";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
        meta: {requiresAuth: true}
    },
    {
        path: '/employee',
        name: 'Employee',
        component: Employee,
        meta: {requiresAuth: true}
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            auth: false
        }
    }
];

const router = new Router({
    history: true,
    mode: 'history',
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
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'Dashboard' })
        return
    }

    next()
});

export default router

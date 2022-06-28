import {createWebHistory,createRouter} from 'vue-router';

import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Dashboard from '../pages/Dashboard.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';

import Customers from '../components/Customers.vue';
import AddCustomer from '../components/AddCustomer.vue';
import EditCustomer from '../components/EditCustomer.vue';

export const routes =[
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component:Dashboard
    },
    {
        name: 'customers',
        path: '/customers',
        component: Customers
    },
    {
        name: 'storecustomer',
        path: '/customers/store',
        component: AddCustomer
    },
    {
        name: 'editCustomer',
        path: '/customers/edit/:id',
        component: EditCustomer
    },

];
const router =createRouter({
  history:createWebHistory(),
  routes:routes,
});

export default router;
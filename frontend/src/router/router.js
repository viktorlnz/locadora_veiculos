import { createWebHistory, createRouter } from "vue-router";

import Home from '../pages/Home.vue';
import Vehicle from '../pages/Vehicle.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Rentals from '../pages/Rentals.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path:'/vehicle/:id',
        name: 'Vehicle',
        component: Vehicle
    },
    {
        path: '/rentals',
        name: 'Rentals',
        component: Rentals
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
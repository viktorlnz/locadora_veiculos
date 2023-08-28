import { createWebHistory, createRouter } from "vue-router";

import Home from '../pages/Home.vue';
import Vehicle from '../pages/Vehicle.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Rentals from '../pages/Rentals.vue';
import Admin from '../pages/admin/Admin.vue';
import HomeAdmin from '../pages/admin/Home.vue';
import VehiclesAdmin from '../pages/admin/vehicles/Vehicles.vue';
import LoginAdmin from '../pages/admin/Login.vue';
import RegisterVehicle from '../pages/admin/vehicles/Register.vue';
import api from "../utils/api";

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
    },
    {
        path: '/admin',
        component: Admin,
        name: 'Admin',
        beforeEnter(to, from, next) {verifyLoginAdmin(to, from, next);} ,
        children: [
          {
            path: '',
            name: 'AdminHome',
            component: HomeAdmin
          },
          {
            path: 'vehicles',
            name: 'AdminVehicles',
            component: VehiclesAdmin
          },
          {
            path: 'vehicles/register',
            name: 'registerVehicle',
            component: RegisterVehicle
          },
          {
            path: 'vehicles/register/:id',
            name: 'updateVehicle',
            component: RegisterVehicle
          },
        ]
    },
    {
        path: '/admin/login',
        component: LoginAdmin,
        name:'AdminLogin'
    }
];

async function verifyLoginAdmin(to, from, next) {
    try {
        console.log('teste');
        const  authenticated = await api('/authenticated');
        
        if(authenticated.data.category === 'Administrador'){
            next();
        }
        
        else next({
            path: '/admin/login'
        });
    } catch (error) {
        next({
            path: '/admin/login'
        });
    }
  }

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
<script setup>
import { ref } from 'vue';
import Header from '../components/header/Header.vue';
import VehicleCard from '../components/home/VehicleCard.vue';
import SearchVehicle from '../components/home/SearchVehicle.vue';

const vehicles = ref([
    {
        id: 1,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 2,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 3,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 4,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 5,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 6,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 7,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 8,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    },
    {
        id: 9,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88'
    }
]);


</script>

<template>
    <Header />
    <main class="container">
        <h2>Reserve já o seu veículo preferido!</h2>
        <div class="container-xxl">
            <div>
                <SearchVehicle />
            </div>
            <div class="container-lg d-flex flex-wrap justify-content-evenly">
                <VehicleCard v-for="v of vehicles" :key="v.id" :vehicle="v"/>
            </div>
        </div>
    </main>
    
</template>
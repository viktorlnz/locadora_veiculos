<script setup>
import { onMounted, ref } from 'vue';
import Header from '../components/header/Header.vue';
import VehicleCard from '../components/home/VehicleCard.vue';
import SearchVehicle from '../components/home/SearchVehicle.vue';
import api from '../utils/api';

const loaded = ref(false);

const vehicles = ref([
    {
        id: 1,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88',
        rented: false
    }
]);

onMounted(() =>{
    getVehicles();
});

function getVehicles(search = ''){
    loaded.value = false;
    
    api('/vehicles' + (search === '' ? '' : '?filter='+search))
    .then(res =>{
        console.log(res);
        vehicles.value = res.data;
        loaded.value = true;
    })
    .catch(error => {
        console.error(error);
    });
}

</script>

<template>
    <Header />
    <main class="container">
        <h2>Reserve já o seu veículo preferido!</h2>
        <div class="container-xxl">
            <div>
                <SearchVehicle :search-function="getVehicles" />
            </div>
            <div class="container-lg d-flex flex-wrap justify-content-evenly">
                <VehicleCard v-show="loaded" v-for="v of vehicles" :key="v.id" :vehicle="v"/>
            </div>
        </div>
    </main>
    
</template>
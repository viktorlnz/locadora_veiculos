<script setup>
import { onMounted, ref } from 'vue';
import api from '../../../utils/api';

import Table from '../../../components/admin/vehicles/Table.vue';
import SearchVehicle from '../../../components/home/SearchVehicle.vue';

const loaded = ref(false);

const vehicles = ref([
{
            "id": 1,
            "brand": "rerum",
            "model": "facilis blanditiis",
            "img": "vehicle.jpg",
            "price": "6529.88",
            "plate": "UFC-4461",
            "category": "SUV",
            "vehicleDescritive": {
                "id": 1,
                "color": "PaleGreen",
                "ports": 6,
                "transmission": "Automatizada",
                "createdAt": "2023-08-25 21:35:24",
                "updatedAt": "2023-08-25 21:35:24"
            },
            "rented": true,
            "createdAt": "2023-08-25 21:35:25",
            "updatedAt": "2023-08-25 21:35:25"
        }
]);

onMounted(() => {
    getVehicles();
})


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

function deleteVehicle(id){
    vehicles.value = vehicles.value.filter(v => v.id !== id);
}
</script>


<template>
    <div class="d-flex justify-content-between m-3">
        <h2>Veículos</h2>
        <router-link to="vehicles/register" class="btn btn-primary">Novo</router-link>
    </div>
    
    <div class="my-2">
        <SearchVehicle :search-function="getVehicles" />
    </div>
    <Table v-show="loaded" :vehicles="vehicles" @delete-vehicle="id => deleteVehicle(id)" />
</template>
<script setup>
    import { onMounted, ref } from 'vue';
    import Header from '../components/header/Header.vue';

    import {useRoute} from 'vue-router';
    import api from '../utils/api';
    import serverUrl from '../utils/serverUrl';

    const loaded = ref(false);

    const vehicle = ref({
        id: 1,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88',
        category: 'SUV',
        plate: 'ABCD123',
        rented: false,
        vehicleDescritive: {
            color: 'Vermelho',
            ports: 4,
            transmission: 'Automático'
        }
    });

    function getVehicle(){
        const route = useRoute();

        const id = route.params.id;

        api('/vehicles/' + id)
        .then(res => {
            console.log(res);
            vehicle.value = res.data

            loaded.value = true;
        })
        .catch(error => console.error(error));
    }

    onMounted(()=>{
        getVehicle();
    });
</script>

<template>
    <Header />
    <div class="container my-3">
        <router-link class="btn btn-secondary text-white" to="/">Retornar</router-link>
    </div>
    <div v-show="loaded" class="card p-4 m-2 m-md-5">
        <h2 class="ms-4">{{vehicle.brand}} - {{vehicle.model}}</h2>
        <div class="row gx-5">
            <div class="col-md col-12">
                <img :src="serverUrl() + '/' + vehicle.img" class="card-img-top" :alt="vehicle.brand + ' ' + vehicle.model">
            </div>
            <div class="col-md col-12 d-flex flex-column justify-content-space-between">
                <div class="card bg-light p-1 m-2 m-md-5">
                    <p class="text-secondary">Categoria: {{vehicle.category}}</p>
                    <p class="text-secondary">Placa: {{vehicle.plate}}</p>
                    <p class="text-secondary">Marca: {{vehicle.brand}}</p>
                    <p class="text-secondary">Modelo: {{vehicle.model}}</p>
                    <p class="text-secondary">Cor: {{vehicle.vehicleDescritive.color}}</p>
                    <p class="text-secondary">Portas: {{ vehicle.vehicleDescritive.ports }}</p>
                    <p class="text-secondary">Cambio: {{vehicle.vehicleDescritive.transmission}}</p>
                    <p class="text-secondary">{{Number(vehicle.price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}}</p>
                </div>
                
                <div class="container-md d-flex">
                    <button v-if="!vehicle.rented" class="btn btn-success btn-lg">Reservar</button>
                    <p class="text-center text-danger" v-else>Veículo já reservado</p>
                </div>
            </div>
        </div>
    </div>
</template>
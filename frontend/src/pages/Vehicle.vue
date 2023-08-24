<script setup>
    import { ref } from 'vue';
    import Header from '../components/header/Header.vue';

    const vehicle = ref({
        id: 1,
        brand: 'Fiat',
        model: 'Palio',
        img: '#',
        price: '500.88',
        category: 'SUV',
        plate: 'ABCD123',
        descritive: {
            color: 'Vermelho',
            ports: 4,
            transmission: 'Automático'
        }
    });

    async function getVehicle(){

    }
</script>

<template>
    <Header />
    <div class="card p-4 m-2 m-md-5">
        <h2 class="ms-4">{{vehicle.brand}} - {{vehicle.model}}</h2>
        <div class="row gx-5">
            <div class="col-md col-12">
                <img src="https://via.placeholder.com/150" class="card-img-top" :alt="vehicle.brand + ' ' + vehicle.model">
            </div>
            <div class="col-md col-12 d-flex flex-column justify-content-space-between">
                <div class="card bg-light p-1 m-2 m-md-5">
                    <p class="text-secondary">Categoria: {{vehicle.category}}</p>
                    <p class="text-secondary">Placa: {{vehicle.plate}}</p>
                    <p class="text-secondary">Marca: {{vehicle.brand}}</p>
                    <p class="text-secondary">Modelo: {{vehicle.model}}</p>
                    <p class="text-secondary">Cor: {{vehicle.descritive.color}}</p>
                    <p class="text-secondary">Portas: {{ vehicle.descritive.ports }}</p>
                    <p class="text-secondary">Cambio: {{vehicle.descritive.transmission}}</p>
                    <p class="text-secondary">{{Number(vehicle.price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}}</p>
                </div>
                
                <div class="container-md d-flex">
                    <button class="btn btn-success btn-lg">Reservar</button>
                </div>
            </div>
        </div>
    </div>
</template>
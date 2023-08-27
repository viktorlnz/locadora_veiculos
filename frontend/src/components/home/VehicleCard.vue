<script setup>
import { ref } from 'vue';
import serverUrl from '../../utils/serverUrl';
defineProps({
  vehicle: Object,
})

const url = ref(serverUrl());
</script>

<template>
    <div class="card m-2 flex-fill">
      <img :src="url + '/' + vehicle.img" class="card-img-top" :alt="vehicle.brand + ' ' + vehicle.model">
      <div class="card-body text-center">
        <h5 class="card-title">{{vehicle.brand}} {{ vehicle.model }}</h5>
        <p class="text-center text-secondary my-1">{{Number(vehicle.price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}}</p>
        <button class="btn btn-primary"><router-link :to="'/vehicle/'+vehicle.id">Ver veículo</router-link></button>
        <p v-if="vehicle.rented" class="text-warning">Veículo já reservado</p>
      </div>
    </div>
</template>


<style scoped>
    div.card{
        max-width: 400px;

        .btn a{
            text-decoration: unset;
            color: white;
        }
    }
</style>
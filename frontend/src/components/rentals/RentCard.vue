<script setup>
import { computed } from 'vue';

import convertDateToLocale from '../../utils/convertDateToLocale';

const props = defineProps({
  rent: Object,
});

const createdAt = computed(() => convertDateToLocale(props.rent.created_at));
const rentEndingDate = computed(() => convertDateToLocale(props.rent.rent_ending_date));
const isReservationCompleted = computed(() =>{
    if (props.rent.cancelled_at === null) {
        const rentEndingDateObj = new Date(props.rent.rent_ending_date);
        const currentDate = new Date();
        return rentEndingDateObj < currentDate;
    }
    return false;
});
</script>

<template>
    <div class="card m-2 flex-fill">
      <img src="https://via.placeholder.com/150" class="card-img-top" :alt="rent.vehicle.brand + ' ' + rent.vehicle.model">
      <div class="card-body text-center">
        <h5 class="card-title">{{rent.vehicle.brand}} {{ rent.vehicle.model }}</h5>
        <p class="text-center text-secondary my-1">Data da reserva: {{createdAt}}</p>
        <p class="text-center text-secondary my-1">Fim da reserva: {{rentEndingDate}}</p>
        <p class="text-center text-secondary my-1">Valor mensal: {{Number(rent.vehicle.price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}}</p>
    
        <p v-if="rent.cancelled_at != null" class="text-danger">Reserva cancelada</p>
        <p v-else-if="isReservationCompleted" class="text-success">Reserva concluída</p>
        <button v-else class="btn btn-danger">Cancelar reserva</button>
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
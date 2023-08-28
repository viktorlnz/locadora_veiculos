<script setup>
import { computed } from 'vue';

import convertDateToLocale from '../../utils/convertDateToLocale';
import api from '../../utils/api';
import serverUrl from '../../utils/serverUrl';

const props = defineProps({
  rent: Object,
});

const emit = defineEmits(['cancelRent']);

const createdAt = computed(() => convertDateToLocale(props.rent.createdAt));
const rentEndingDate = computed(() => convertDateToLocale(props.rent.expiresAt));

const isReservationCompleted = computed(() =>{
    if (props.rent.deletedAt === null) {
        const rentEndingDateObj = new Date(props.rent.expiresAt);
        const currentDate = new Date();
        return rentEndingDateObj < currentDate;
    }
    return false;
});

function cancelRent(){
  api('/rents/' + props.rent.id, 'DELETE')
  .then(() => {
    emit('cancelRent', props.rent.id);
  })
  .catch(error => console.error(error));
}
</script>

<template>
    <div class="card m-2 flex-fill">
      <img :src="serverUrl() + '/' + rent.vehicle.img" class="card-img-top" :alt="rent.vehicle.brand + ' ' + rent.vehicle.model">
      <div class="card-body text-center">
        <h5 class="card-title">{{rent.vehicle.brand}} {{ rent.vehicle.model }}</h5>
        <p class="text-center text-secondary my-1">Data da reserva: {{createdAt}}</p>
        <p class="text-center text-secondary my-1">Fim da reserva: {{rentEndingDate}}</p>
        <p class="text-center text-secondary my-1">Valor mensal: {{Number(rent.vehicle.price).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}}</p>
    
        <p v-if="rent.deletedAt != null" class="text-danger">Reserva cancelada</p>
        <p v-else-if="isReservationCompleted" class="text-success">Reserva concluída</p>
        <button @click="cancelRent" v-else class="btn btn-danger">Cancelar reserva</button>
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
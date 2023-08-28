<script setup>
import api from '../../../utils/api';

defineProps({
    vehicles: Array
});

const emit = defineEmits(['deleteVehicle']);

function deleteVehicle(id){
    api('/vehicles/' + id, 'DELETE')
    .then(() => emit('deleteVehicle', id))
    .catch(error => console.error(error));
}
</script>

<template>
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Reservado</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tr-hover" v-for="v of vehicles">
                    <th scope="row">{{ v.plate }}</th>
                    <td>{{ v.brand }}</td>
                    <td>{{ v.model }}</td>
                    <td>{{ v.rented ? 'Reservado' : 'Disponível' }}</td>
                    <td>
                        <router-link :to="'vehicles/register/'+v.id" class="btn btn-sm btn-info" type="button">
                            <i class="bi bi-pencil text-white"></i>
                        </router-link>
                    </td>
                    <td>
                        <button @click="deleteVehicle(v.id)" class="btn btn-sm btn-danger" type="button">
                            <i class="bi bi-trash text-white"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        
        </table>
    </div>
</template>

<style scoped>

tbody tr.tr-hover:hover{
    background-color: #ddd !important;
}
</style>
<script setup>
import { onMounted, ref } from 'vue';
import api from '../../../utils/api';

import Table from '../../../components/admin/users/Table.vue';

const loaded = ref(false);

const users = ref([]);

onMounted(() => {
    getUsers();
})


function getUsers(search = ''){
    loaded.value = false;

    api('/users' + (search === '' ? '' : '?filter='+search))
    .then(res =>{
        console.log(res);
        users.value = res.data;
        loaded.value = true;
    })
    .catch(error => {
        console.error(error);
    });
}

</script>


<template>
    <div class="d-flex justify-content-between m-3">
        <h2>Usuários</h2>
        <router-link to="users/register" class="btn btn-primary">Novo</router-link>
    </div>
    
    <Table v-show="loaded" :users="users"/>
</template>
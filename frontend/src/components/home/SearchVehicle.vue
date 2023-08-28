<script setup>
import { ref } from 'vue';

const props = defineProps({
    searchFunction: Function
});

const search = ref('');
</script>

<template>
    <div class="input-group">
        <input type="text" v-model="search" class="form-control" placeholder="Pesquisar..." />
        <button @click="searchFunction(search)" class="btn btn-primary" type="button">
            <i class="bi bi-search"></i>
        </button>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import api from '../../utils/api';
import { useRouter } from 'vue-router';
import { removeToken } from '../../utils/tokenStorage';

const loginName = ref(null);

const router = useRouter();

onMounted(() => {
    getName();
})

function getName(){
    api('/authenticated')
    .then( res =>{
        console.log(res.data);

        loginName.value = res.data.firstName;
    });
}

function logoff(){
    api('/logout', 'POST')
    .then(() => {
        removeToken();
        router.push('/');
    })
    .catch( error => console.error());
}
</script>

<template>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-primary d-flex justify-content-between" data-bs-theme="dark">
            <h1 class="navbar-brand mx-2 ms-3"><router-link class="link-underline link-underline-opacity-0 text-white" to="/admin">Administração</router-link></h1>
            <ul class="navbar-nav me-3">
                    <li class="nav-item">
                        <span class="text-white nav-link">Olá {{ loginName }}. <span @click="logoff" class="text-warning logoff">Logoff</span></span>
                    </li>
                  </ul>
        </nav>
    </header>
    <div class="container-fluid">
        <router-view></router-view>
    </div>
    
</template>

<style lang="scss" scoped>
    span.logoff{
        cursor: pointer;
        font-weight: bold;

        &:hover{
            color: rgb(232, 135, 38);
        }    
    }
    
</style>
<script setup>
import { ref } from 'vue';
import api from '../../utils/api';
import {addToken} from '../../utils/tokenStorage';
import { useRouter } from 'vue-router';
import Notification from '../../components/notification/Notification.vue';
    const form = ref({
        'email': '',
        'password': ''
    });

    const showErrorFunc = ref(null);

    const router = useRouter();

    function login(){
        api('/login', 'POST', form.value)
        .then(res => {
            console.log(res);
            addToken(res.data.token);
            router.push('/admin');
        })
        .catch(error => {
            console.error(error);

            if(error.response.data.status === 403){
                showErrorFunc.value();
            }
        });
    }
</script>

<template>
    <div>
        <Notification 
            message="Verifique se não errou nenhum dos dados" 
            title="Erro ao autenticar"
            @setup-turn-on-notification="func => showErrorFunc = func"
        />
    </div>
    <form @submit.prevent="login" class="container-md d-flex flex-column" id="form">
        <h1 class="text-center my-4">Login</h1>
        <div class="input-group my-4">
            <span class="input-group-text px-1 px-md-4" id="inputGroup-email">E-mail</span>
            <input 
                type="email" 
                class="form-control" 
                aria-label="E-mail" 
                aria-describedby="inputGroup-email" 
                v-model="form.email"    
            />
        </div>
        <div class="input-group my-4">
            <span class="input-group-text px-1 px-md-4" id="inputGroup-password">Senha</span>
            <input 
                type="password" 
                class="form-control" 
                aria-label="Senha" 
                aria-describedby="inputGroup-password" 
                v-model="form.password"    
            />
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg mx-5">Login</button>
    </form>
</template>
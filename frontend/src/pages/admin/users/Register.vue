<script setup>
import { onMounted, ref } from 'vue';

import api from '../../../utils/api';
import { useRouter } from 'vue-router';

const form = ref({
    name: '',
    email: '',
    password: '',
    rememberPassword: '',
    category: ''
});

const errors = ref({
    name: '',
    email: '',
    password: '',
    rememberPassword: '',
    category: ''
})

const router = useRouter();

function submit(){
    if(form.value.password !== form.value.rememberPassword){
        errors.value.rememberPassword = 'As senhas não conferem';
        return;
    }

    if(form.value.category === ''){
        errors.value.category = 'Selecione um tipo de usuário';
        return;
    }

    api('/users' + (form.value.category === 'ADMIN' ? '/admin' : ''), 'POST', form.value)
    .then( res => {router.push('/admin/users')})
    .catch(error => {
        console.error(error);

        const data = error.response.data;

        if(data.status == 422){
            for (const col in data.errors) {
                errors.value[col] = data.errors[col][0];
            }
        }
    });
}

</script>

<template>
    <div class="container-fluid">
        <h1 class="text-center">Registro de usuário</h1>
        <form @submit.prevent="submit" class="container-md d-flex flex-column">
            <select class="form-select" aria-label="Category" v-model="form.category">
                <option value="">Selecione o tipo de usuário</option>
                <option value="ADMIN">Administrador</option>
                <option value="COMMON">Usuário comum</option>
            </select>
            <p class="text-danger">{{ errors.category }}</p>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" aria-describedby="Name" v-model="form.name" required/>
                <p class="text-danger">{{ errors.name }}</p>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" aria-describedby="E-mail" v-model="form.email" required/>
                <p class="text-danger">{{ errors.email }}</p>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" required v-model="form.password"/>
                <p class="text-danger">{{ errors.password }}</p>
            </div>
            <div class="mb-3">
                <label for="remember-password" class="form-label">Re-digite a Senha</label>
                <input type="password" class="form-control" id="remember-password" v-model="form.rememberPassword" required/>
                <p class="text-danger">{{ errors.rememberPassword }}</p>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mx-5">Registrar</button>
            <p class="text-secondary me-5 text-end"><router-link to="/admin/users">Clique aqui</router-link> para retornar</p>
        </form>
    </div>
    
</template>
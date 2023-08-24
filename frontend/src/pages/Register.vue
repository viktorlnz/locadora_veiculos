<script setup>
import Header from '../components/header/Header.vue';
</script>

<template>
    <Header />
    <div class="container-fluid">
        <h1 class="text-center">Registro de usuário</h1>
        <form class="container-md d-flex flex-column">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" aria-describedby="E-mail" required/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" required/>
            </div>
            <div class="mb-3">
                <label for="remember-password" class="form-label">Re-digite a Senha</label>
                <input type="password" class="form-control" id="remember-password" required/>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mx-5">Registrar</button>
            <p class="text-secondary me-5 text-end">Já tem uma conta? <router-link to="/login">Autentique-se</router-link></p>
        </form>
    </div>
    
</template>
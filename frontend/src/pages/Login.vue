<script setup>
    import Header from '../components/header/Header.vue';
</script>

<template>
    <Header />
    <form class="container-md d-flex flex-column" id="form">
        <h1 class="text-center my-4">Login</h1>
        <div class="input-group my-4">
            <span class="input-group-text px-1 px-md-4" id="inputGroup-email">E-mail</span>
            <input type="email" class="form-control" aria-label="E-mail" aria-describedby="inputGroup-email" />
        </div>
        <div class="input-group my-4">
            <span class="input-group-text px-1 px-md-4" id="inputGroup-password">Senha</span>
            <input type="password" class="form-control" aria-label="Senha" aria-describedby="inputGroup-password" />
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg mx-5">Login</button>
        <p class="text-secondary me-5 text-end">Não tem uma conta? <router-link to="/register">Registre-se</router-link></p>
    </form>
</template>
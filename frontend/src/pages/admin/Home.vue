<template>
    <p class="text-center text-secondary my-4">Selecione a opção desejada:</p>
    <div class="row my-5">
        <div class="card col-md-6 p-3 btn-col">
            <router-link to="/admin/vehicles" class="btn btn-success py-5">Gerenciar Veículos</router-link>
        </div>

        <div class="card col-md-6 p-3 btn-col">
            <router-link to="/admin/users" class="btn btn-success py-5 m-0">Gerenciar Usuários</router-link>
        </div>
    </div>
</template>

<style scoped>
    div.card.btn-col{
        padding: 0;
    }
</style>
<script setup>

defineProps({
    users: Array
});

</script>

<template>
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Categoria</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tr-hover" v-for="u of users">
                    <td>{{ u.name }}</td>
                    <td>{{ u.email }}</td>
                    <td>{{ u.category }}</td>
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
<script setup>
    import { onMounted, ref } from 'vue';

    import {useRoute} from 'vue-router';
    import api from '../../../utils/api';
    import serverUrl from '../../../utils/serverUrl';

    const form = ref({
        id: 0,
        brand: '',
        model: '',
        img: '',
        price: '',
        categoryId: 1,
        plate: '',
        rented: false,
        vehicleDescritive: {
            color: '',
            ports: 0,
            transmission: ''
        }
    });

    function getVehicle(){
        const route = useRoute();

        const id = route.params.id ?? 0;

        if(id === 0) {
            return;
        }

        api('/vehicles/' + id)
        .then(res => {
            console.log(res);
            form.value = res.data

        })
        .catch(error => console.error(error));
    }

    onMounted(()=>{
        getVehicle();
    });
</script>

<template>
    <div class="container-fluid">
        <h1 class="text-center">Registro de usuário</h1>
        <form class="container-md d-flex flex-column">
            <div class="mb-3">
                <label for="brand" class="form-label">Marca</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="brand" 
                    aria-describedby="Marca" 
                    required
                    v-model="form.brand"
                    maxlength="50"    
                />
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Modelo</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="model" 
                    aria-describedby="Modelo" 
                    required
                    v-model="form.model"
                    maxlength="80"    
                />
            </div>

            <div class="mb-3">
                <label for="plate" class="form-label">Placa</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="plate" 
                    aria-describedby="Placa" 
                    required
                    v-model="form.plate"
                    placeholder="ABC-3D44"
                    maxlength="8"    
                />
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Valor por mês R$</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="price" 
                    aria-describedby="Preco" 
                    required
                    placeholder="R$ 500,99"
                    v-model="form.price"    
                />
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
            <p class="text-secondary me-5 text-end"><router-link to="/admin/vehicles">Clique aqui</router-link> para retornar</p>
        </form>
    </div>
</template>
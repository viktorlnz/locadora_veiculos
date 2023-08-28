<script setup>
    import { onMounted, ref } from 'vue';

    import {useRoute, useRouter} from 'vue-router';
    import api from '../../../utils/api';
    import serverUrl from '../../../utils/serverUrl';
    import convertStringMoneyToFloat from '../../../utils/convertStringMoneyToFloat';
    import convertFloatToMoney from '../../../utils/convertFloatToMoney';

    const form = ref({
        id: 0,
        brand: '',
        model: '',
        img: '',
        price: '',
        categoryId: 0,
        plate: '',
        rented: false,
        vehicleDescritive: {
            color: '',
            ports: 0,
            transmission: ''
        }
    });

    const errors = ref({
        brand : '',
        model : '',
        img : '',
        price: '',
        categoryId: '',
        plate: '',
        color: '',
        ports: '',
        transmission: ''
    });

    const categories = ref([{
        id: 1,
        name: 'test'
    }]);

    const imageFile = ref(null);

    const router = useRouter();

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

            form.value.price = convertFloatToMoney(form.value.price); 

        })
        .catch(error => console.error(error));
    }

    function getCategories(){
        api('/categories')
        .then(res => categories.value = res.data)
        .catch(error => console.error(error));
    }

    function handleFileUpload( event ){
        imageFile.value = event.target.files[0];
    }

    function submit(){
        const formData = new FormData();

        formData.append('brand', form.value.brand);
        formData.append('model', form.value.model);
        formData.append('price', convertStringMoneyToFloat(form.value.price) );
        formData.append('plate', form.value.plate);
        formData.append('color', form.value.vehicleDescritive.color);
        formData.append('ports', form.value.vehicleDescritive.ports);
        formData.append('transmission', form.value.vehicleDescritive.transmission);
        formData.append('categoryId', form.value.categoryId);

        if(imageFile.value !== null){
            formData.append('img', imageFile.value);
        }

        api('/vehicles' + (form.value.id !== 0 ? '/'+ form.value.id:''), 'POST', formData, 'multipart/form-data')
        .then( res => router.push('/admin/vehicles'))
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

    onMounted(()=>{
        getVehicle();
        getCategories();
    });
</script>

<template>
    <div class="container-fluid">
        <h1 class="text-center">{{ form.id === 0 ? 'Cadastrar Veículo' : 'Edição de veículo' }}</h1>
        <form @submit.prevent="submit" class="container-md d-flex flex-column">
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
                <span class="text-danger">{{ errors.brand }}</span>
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
                <span class="text-danger">{{ errors.model }}</span>
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
                <span class="text-danger">{{ errors.plate }}</span>
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
                <span class="text-danger">{{ errors.price }}</span>
            </div>

            <select class="form-select my-3" v-model="form.categoryId" aria-label="Categoria">
                <option value="0">Selecione uma categoria</option>
                <option v-for="c of categories" :value="c.id">{{c.name}}</option>
            </select>
            <span class="text-danger">{{ errors.categoryId }}</span>

            <div class="mb-3">
                <label for="color" class="form-label">Cor</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="color" 
                    aria-describedby="Cor" 
                    required
                    v-model="form.vehicleDescritive.color"
                    maxlength="100"    
                />
                <span class="text-danger">{{ errors.color }}</span>
            </div>

            <div class="mb-3">
                <label for="ports" class="form-label">Portas</label>
                <input 
                    type="number" 
                    class="form-control" 
                    id="ports" 
                    aria-describedby="Ports" 
                    required
                    v-model="form.vehicleDescritive.ports"
                    max="100"    
                />
                <span class="text-danger">{{ errors.ports }}</span>
            </div>

            <div class="mb-3">
                <label for="transmission" class="form-label">Câmbio</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="transmission" 
                    aria-describedby="Transmission" 
                    required
                    v-model="form.vehicleDescritive.transmission"
                    maxlength="80"    
                />
                <span class="text-danger">{{ errors.transmission }}</span>
            </div>
            
            <div class="mb-3">
                <label for="formFile" class="form-label">Imagem do veículo</label>
                <input class="form-control" type="file" id="formFile" @change="handleFileUpload( $event )">
                <span class="text-danger">{{ errors.img }}</span>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mx-5">Enviar</button>
            <p class="text-secondary me-5 text-end"><router-link to="/admin/vehicles">Clique aqui</router-link> para retornar</p>
        </form>
    </div>
</template>
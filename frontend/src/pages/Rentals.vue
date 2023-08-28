<script setup>
    import { onMounted, ref } from 'vue';
    import Header from '../components/header/Header.vue';
    import RentCard from '../components/rentals/RentCard.vue';
import api from '../utils/api';
import Notification from '../components/notification/Notification.vue';

    const loaded = ref(false);
    const loggedIn = ref(false);

    const notificationFunc = ref(null);

    const rents = ref([
        {
            id: 1,
            vehicle: {
                id: 1,
                brand: 'Fiat',
                model: 'Palio',
                img: '#',
                price: '500.88',
                category: 'SUV',
                plate: 'ABCD123',
                vehicleDescritive: {
                    color: 'Vermelho',
                    ports: 4,
                    transmission: 'Automático'
                }
            },
            createdAt: '2023-08-24',
            deletedAt: null,
            rentalDuration: 60,
            rentEndingDate: '2023-10-24'
        }
    ]);

    onMounted(() => {
        verifyAuth();
    });

    function verifyAuth(){
        api('/authenticated')
        .then(async res => {
            console.log(res);

            await getRents(res.data.id);

            loggedIn.value = true;
        })
        .catch(error => {
            console.error(error);

        })
        .finally(() => loaded.value = true);
    }

    async function getRents(id){
        try{
            const res = await api('/rents/user/' + id);
            console.log(res);
            rents.value = res.data;
        }
        catch(error){
            console.error(error);
        }
    }

    function cancelRent(id){
        for (const rent of rents.value) {
            if(id == rent.id){
                const now = Date.now();

                const date = new Date(now);

                const formattedDate = date.toLocaleString("en-US", {
                    timeZone: "UTC",
                    format: "yyyy-MM-dd HH:mm:ss",
                });

                rent.deletedAt = formattedDate;

                notificationFunc.value();
            }
        }
    }
</script>

<template>
    <Header />
    <div class="container">
        <div>
            <Notification 
                message="Reserva cancelada" 
                title="Sucesso" 
                @setup-turn-on-notification="func => notificationFunc = func"    
            />
        </div>
        <h3 class="text-center">Reservas</h3>
        <div v-show="loaded">
            <div v-if="loggedIn" class="container-lg d-flex flex-wrap justify-content-evenly">
                <RentCard 
                    v-for="r of rents" 
                    :key="r.id" 
                    :rent="r" 
                    @cancel-rent="id => cancelRent(id)"    
                />
            </div>
            <div v-else>
                <p class="text-center text-secondary">Para ver suas reservas você precisa se autenticar. <router-link class="text-info" to="/login">Clique aqui para autenticar.</router-link></p>
            </div>
        </div>
        
    </div>    
</template>
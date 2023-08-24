<script setup>
    import { ref } from 'vue';
    import Header from '../components/header/Header.vue';
    import RentCard from '../components/rentals/RentCard.vue';
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
                descritive: {
                    color: 'Vermelho',
                    ports: 4,
                    transmission: 'Automático'
                }
            },
            created_at: '2023-08-24',
            cancelled_at: null,
            rental_duration: 60,
            rent_ending_date: '2023-10-24'
        },
        {
            id: 2,
            vehicle: {
                id: 2,
                brand: 'Fiat',
                model: 'Palio',
                img: '#',
                price: '500.88',
                category: 'SUV',
                plate: 'ABCD123',
                descritive: {
                    color: 'Vermelho',
                    ports: 4,
                    transmission: 'Automático'
                }
            },
            created_at: '2023-08-24',
            cancelled_at: '2023-08-24',
            rental_duration: 60,
            rent_ending_date: '2023-10-24'
        },
        {
            id: 3,
            vehicle: {
                id: 3,
                brand: 'Fiat',
                model: 'Palio',
                img: '#',
                price: '500.88',
                category: 'SUV',
                plate: 'ABCD123',
                descritive: {
                    color: 'Vermelho',
                    ports: 4,
                    transmission: 'Automático'
                }
            },
            created_at: '2023-06-24',
            cancelled_at: null,
            rental_duration: 60,
            rent_ending_date: '2023-08-24'
        },
        {
            id: 4,
            vehicle: {
                id: 4,
                brand: 'Fiat',
                model: 'Palio',
                img: '#',
                price: '500.88',
                category: 'SUV',
                plate: 'ABCD123',
                descritive: {
                    color: 'Vermelho',
                    ports: 4,
                    transmission: 'Automático'
                }
            },
            created_at: '2023-06-24',
            cancelled_at: '2023-08-24',
            rental_duration: 60,
            rent_ending_date: '2023-08-24'
        },
    ]);
</script>

<template>
    <Header />
    <div class="container">
        <h3 class="text-center">Reservas</h3>
        <div class="container-lg d-flex flex-wrap justify-content-evenly">
            <RentCard v-for="r in rents" :key="r.id" :rent="r" />
        </div>
    </div>    
</template>
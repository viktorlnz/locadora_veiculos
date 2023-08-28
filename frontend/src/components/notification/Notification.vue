<script setup>
import {onMounted} from 'vue';
import {Toast} from 'bootstrap';

const props = defineProps({
    title: String,
    message: String
});

const emit = defineEmits(['setupTurnOnNotification']);

onMounted( () => {
    const showFunc = () => {
       const toast = document.getElementById('liveToast');

        const toastBootstrap = Toast.getOrCreateInstance(toast);
        toastBootstrap.show();
    }

    emit('setupTurnOnNotification', showFunc);
})


</script>

<template>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">{{title}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{message}}
            </div>
        </div>
    </div>
</template>

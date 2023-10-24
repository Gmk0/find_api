
import { toValue } from 'vue';


<script setup>


import { ref, computed, onMounted, watch } from "vue";
import { cartStore } from '../../../store';
import { useRoute, useRouter } from 'vue-router';

const usecartStore = cartStore();
const route = useRoute();
const router = useRouter();


const responseStatus= ref([]);
const items = computed(() => usecartStore.items);

const totalPrice = computed(() => usecartStore.totalCost);

//const status = ref(null);
const reference = ref(null);
const method = ref(null);

const response =ref({
    status:'',
    reference:'',
    method:''
})

onMounted(async () => {
     const query = { ...route.query };

       if (Object.keys(query).length === 0) {
        router.push({ name: 'Checkout.service' });
        return;
    }

    response.value.status = query.status;
    response.value.reference = query.reference;
   response.value.method = query.Method;

    if (response.value.status === 'success' && response.value.reference) {

        handleSuccess(response.value);


    } else if (response.value.status === 'failed' && response.value.reference) {

        delete query.status;
        delete query.reference;
         delete query.Method;
        router.replace({ query });

        handleSuccess(response.value);


    } else {
          router.push({ name: 'Checkout.service' });

     // Naviguer vers la page précédente
    }
});

function handleSuccess(data) {




   responseStatus.value =  usecartStore.handleMaxiStatus(data);


    //usecartStore.responsePaiment({ reference , status.value,methode})
}

function handleFailure(reference) {
    // Gérer le paiement échoué avec la référence spécifiée
}

</script>
<template>
    <WebLayout>

        <div class="pt-16">
             <div class="" v-if="usecartStore.statusError.message">
                {{ usecartStore.statusError.message }}
            </div>
        </div>

        <div v-if="responseStatus">
            {{ responseStatus }}

        </div>

    </WebLayout>
</template>

<style scoped>
.loader-dots div {
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

.loader-dots div:nth-child(1) {
    left: 8px;
    animation: loader-dots1 0.6s infinite;
}

.loader-dots div:nth-child(2) {
    left: 8px;
    animation: loader-dots2 0.6s infinite;
}

.loader-dots div:nth-child(3) {
    left: 32px;
    animation: loader-dots2 0.6s infinite;
}

.loader-dots div:nth-child(4) {
    left: 56px;
    animation: loader-dots3 0.6s infinite;
}

@keyframes loader-dots1 {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes loader-dots3 {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(0);
    }
}

@keyframes loader-dots2 {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(24px, 0);
    }
}
</style>



<script setup>


import { ref, computed, watch } from "vue";
import { cartStore }  from '../../../store';
import { useRoute, useRouter } from 'vue-router';

const usecartStore = cartStore();
const route = useRoute();
const router = useRouter();

const form =ref({
    name: '',
    numero: '',
})


const items = computed(() => usecartStore.items);

const totalPrice = computed(() => usecartStore.totalCost);

const isShow = ref(false);
const isCard= ref(false);
const isOther = ref(false);

const checkoutMaxi = async ()=>{



    if(items.value)
    {
       const response = await  usecartStore.checkoutMaxi(form.value);

       window.location.href = response

    }
}

watch(() => route.query, (newQuery, oldQuery) => {
    // Réagit aux changements dans les paramètres de l'URL
    console.log('Nouveaux paramètres de l\'URL :', newQuery);
    console.log('Anciens paramètres de l\'URL :', oldQuery);

    // Ajoutez votre logique pour réagir aux changements ici
    if (newQuery.status === 'success') {
        console.log('Paiement réussi');
    } else if (newQuery.status === 'failed') {
        console.log('Paiement échoué');
    }
});
</script>
<template>
    <WebLayout>
    <div>
        <div class="min-h-screen py-5 pt-16 custom overflow-y-auto-scrollbar bg-gray-50 min-w-screen dark:bg-gray-900">

        <div class="px-6 md:px-12">
            <div>
                 <div class="mb-2">

                </div>
                <div class="mb-2">
                    <h1 class="text-5xl font-bold text-gray-600 md:text-2xl dark:text-gray-200">Panier</h1>
                </div>

            </div>
            <div>





            </div>




            <div v-if="items.length > 0"
                class="w-full px-5 py-10 mx-0 text-gray-800 bg-white border-t border-b border-gray-200 rounded-md dark:bg-gray-800">
                <div class="w-full">
                    <div class="items-start -mx-3 md:flex">

                        <div class="px-3 md:w-7/12 lg:pr-10">
                            <ul class="flex flex-col divide-y divide-gray-700">

                                <li v-for="item in items" class="flex flex-col py-6 sm:flex-row sm:justify-between">
                                    <div class="flex w-full space-x-2 sm:space-x-4">
                                        <img class="flex-shrink-0 object-cover w-20 h-20 rounded outline-none dark:border-transparent sm:w-32 sm:h-32 dark:bg-gray-500"
                                            :src="item.image" alt="service">
                                        <div class="flex flex-col justify-between w-full pb-4">
                                            <div class="flex justify-between w-full pb-2 space-x-2">
                                                <div class="space-y-1">
                                                    <h3 class="text-lg font-semibold leading-snug sm:pr-8">
                                                        {{ item.name }}
                                                    </h3>
                                                    <p class="text-sm dark:text-gray-400">{{item.basic}}</p>
                                                </div>

                                                <div class="text-right">
                                                    <p class="text-lg font-semibold">${{ item.price *
                                                        item.quantity }}</p>
                                                    <p class="text-sm line-through dark:text-gray-600">
                                                        $</p>
                                                </div>
                                            </div>
                                            <div class="flex text-sm divide-x">
                                                <button type="button" @click="usecartStore.removeItem(item.id)"
                                                    class="flex items-center px-2 py-1 pl-0 space-x-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        class="w-4 h-4 fill-current">
                                                        <path
                                                            d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z">
                                                        </path>
                                                        <rect width="32" height="200" x="168" y="216"></rect>
                                                        <rect width="32" height="200" x="240" y="216"></rect>
                                                        <rect width="32" height="200" x="312" y="216"></rect>
                                                        <path
                                                            d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z">
                                                        </path>
                                                    </svg>
                                                    <span>Retirer</span>
                                                </button>


                                                <div>

                                                    <div x-data="{ productQuantity: @json($item['quantity']) }">
                                                        <label for="Quantity" class="sr-only"> Quantity </label>

                                                        <div class="flex items-center gap-1">
                                                            <button type="button"  :disabled="item.quantity === 1"
                                                                @click="usecartStore.updateItemQuantity(item.id, item.quantity--)"
                                                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75">
                                                                &minus;
                                                            </button>


                                                            <input disabled type="number" id="Quantity" :value="item.quantity"

                                                                class="h-10 w-16 rounded border-gray-200 dark:bg-gray-700 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none" />

                                                            <button type="button"
                                                                @click="usecartStore.updateItemQuantity(item.id, item.quantity++)"
                                                                class="w-10 h-10 leading-10 text-gray-600 transition hover:opacity-75">
                                                                &plus;
                                                        </button>


                                                        </div>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>





                            <div class="pb-6 mb-6 border-b border-gray-200">

                                <button @click="isShow = !isShow" class="">
                                    <label
                                        class="flex gap-1 mb-2 ml-1 text-sm font-semibold text-gray-600 dark:text-gray-200">Coupon
                                        de reduction
                                        code <span class="py-1.5">
                                            <svg v-show="!isShow" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>

                                        </span>
                                        <span class="py-1.5">
                                            <svg v-show="isShow" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>

                                        </span>
                                    </label>






                                </button>


                                <div class="flex items-end justify-end " v-show="isShow">


                                    <div class="flex-grow px-2 lg:max-w-md">

                                        <div class="p-2">
                                            <TextInput />
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <button
                                            class="block w-full max-w-xs px-5 py-2 mx-auto font-semibold text-white bg-gray-400 border border-transparent rounded-md hover:bg-gray-500 focus:bg-gray-500">APPLIQUER</button>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-6 mb-6 text-gray-800 border-b border-gray-200">
                                <div class="flex items-center w-full mb-3">
                                    <div class="flex-grow">
                                        <span class="text-gray-600 dark:text-gray-200">Sous total</span>
                                    </div>
                                    <div class="pl-3">
                                        <span
                                            class="font-semibold dark:text-gray-50">{{ totalPrice}} $</span>
                                    </div>
                                </div>
                                <div class="flex items-center w-full">
                                    <div class="flex-grow">
                                        <span class="text-gray-600 dark:text-gray-200">Taxes(GST)</span>
                                    </div>
                                    <div class="pl-3">
                                        <span class="font-semibold dark:text-gray-50">$0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-6 mb-6 text-xl text-gray-800 border-b border-gray-200 md:border-none">
                                <div class="flex items-center w-full">
                                    <div class="flex-grow">
                                        <span class="text-gray-600 dark:text-gray-200">Total</span>
                                    </div>
                                    <div class="pl-3">
                                        <span class="text-sm font-semibold text-gray-400 dark:text-gray-20"></span> <span
                                            class="font-semibold">{{ totalPrice }} $</span>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="px-3 md:w-5/12">

                            <div class="w-full p-4 mb-4 font-semibold bg-white border border-gray-200 rounded-md dark:bg-gray-900">
                                <div class='flex flex-col gap-4'>

                                    <TextInput />
                                      <TextInput />
                                        <TextInput />


                                </div>


                            </div>


                            <div
                                class="w-full mx-auto mb-6 text-gray-800 bg-white border border-gray-200 rounded-lg top-8 dark:bg-gray-900">
                                <div class="w-full p-3 border-b border-gray-200 ">
                                    <div class="mb-5">
                                        <label for="type1" class="flex items-center cursor-pointer">
                                            <input type="checkbox" class="w-5 h-5 text-indigo-500 form-radio" id="type1"
                                                v-model="isCard" @click="isOther = false">
                                            <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                                class="h-6 ml-3">
                                        </label>
                                    </div>
                                    <div  class="px-2"  v-if="isCard">
                                        <div class="relative grid grid-cols-3 gap-2 mb-3 ">
                                        </div>

                                        <div class="mt-4">

                                            <button
                                                class=" block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle
                                                                                                                                                                font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all
                                                                                                                                                                hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none
                                                                                                                                                                active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50
                                                                                                                                                                disabled:shadow-none"
                                                data-ripple-light="true">
                                                <span >PAYER
                                                    ($)</span>

                                            </button>

                                        </div>

                                    </div>

                                </div>


                                <div class="w-full p-6 border-b border-gray-200">
                                    <div class="mb-5">
                                        <label for="type2" class="flex items-center cursor-pointer">
                                            <input type="checkbox" class="w-5 h-5 text-indigo-500 form-radio"
                                                id="type2" v-model="isOther" @click="isCard = false">

                                            <img src="/images/icon/maxicash.png" class="h-6 ml-3">

                                        </label>
                                    </div>
                                    <div v-if="isOther">

                                        <form @submit.prevent="checkoutMaxi">

                                             <TextInput v-model="form.name" />
                                            <TextInput v-model="form.numero" />



                                        <div class="flex flex-col gap-4 px-3 mb-3">
                                            <button type="submit"
                                                class="
                                                block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle
                                                font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all
                                                hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none
                                                active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50
                                                disabled:shadow-none">
                                                payer

                                            </button>

                                        </div>
                                        </form>

                                    </div>
                                </div>

                            </div>


                        </div>





                    </div>
                </div>
            </div>



            <div v-else class="flex flex-col items-center justify-center gap-4 py-8">

                <h1 class="text-2xl">Votre panier est vide</h1>




            </div>


        </div>




        <div v-if="false">
            <div>

                <div class="fixed top-0 left-0 z-50 flex items-center justify-center w-screen h-screen"
                    style="background: rgba(0, 0, 0, 0.3);">
                    <div class="flex flex-col items-center px-5 py-2 bg-white border rounded-lg">
                        <div class="relative block w-20 h-5 mt-2 loader-dots">
                            <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                            <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                            <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                            <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="mt-2 text-xs font-medium text-center text-gray-500">
                            Paiement en cours...
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

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

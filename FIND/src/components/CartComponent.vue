

<template>
    <div class="flex card justify-content-center">
        <Sidebar v-model:visible="visible" position="right">
            <h2>CART</h2>
             <div class="flex-1 max-h-full p-4 soft-scrollbar">
                <div v-if="items" class="flex-1 overflow-x-hidden overflow-y-auto ">

                    <div v-for="item in items" class="flex items-center p-4 space-x-4">

                        <img class="object-cover w-16 h-16 rounded-lg"
                            :src="item.image" alt="Service 1">
                        <div class="flex-1">
                            <h3 class="mb-2 font-semibold text-gray-800 break-before-auto dark:text-gray-100">{{ item.name }}</h3>
                            <p class="text-gray-500 dark:text-gray-100">{{ item.price }} $</p>

                            <div class="mt-4">
                                <label for="Quantity" class="sr-only"> Quantity </label>

                                <div class="flex items-center gap-1">
                                    <button type="button"  :disabled="item.quantity === 1"
                                        @click="usecartStore.updateItemQuantity( item.id, item.quantity--)"
                                        class="w-8 h-8 leading-10 text-gray-600 transition hover:opacity-75">
                                        &minus;
                                    </button>


                                    <input disabled type="number" id="Quantity" :value="item.quantity"

                                        class="h-8 w-10 rounded border-gray-200 dark:bg-gray-700 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none" />

                                    <button type="button" x-on:click=""
                                        @click="usecartStore.updateItemQuantity(item.id, item.quantity++)"
                                        class="w-8 h-8 leading-10 text-gray-600 transition hover:opacity-75">
                                        &plus;
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button @click="usecartStore.removeItem(item.id)"
                            class="text-gray-500 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor">

                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>


                    </div>


                </div>
                <div v-else>

                    la carte est vide

                </div>
                <div class="flex flex-col gap-4 p-4 border-t border-gray-200">

                    <router-link :to="{name:'Checkout.service'}" class="block w-full px-2 py-2 text-center text-white align-middle rounded-lg select-none bg-amber-600">
                        Paiement  {{ totalPrice }} $
                    </router-link >


                    <button @click="usecartStore.clearCart()">Clear</button>





                </div>


            </div>
        </Sidebar>

         <div class="site-cart lg:mr-2">
            <a @click="visible = true" href="#" class="site-header__cart" title="Cart">

                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="hidden w-5 h-5 dark:text-white lg:block">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>

                <span id="CartCount" class="site-header__cart-count"
                    data-cart-render="item_count">{{ usecartStore.totalItems }}</span>
            </a>

        </div>
    </div>
</template>

<script setup>
import Sidebar from 'primevue/sidebar';


import { ref, computed } from "vue";
import { cartStore } from '../store';

const usecartStore = cartStore();


const items =computed(()=> usecartStore.items);

const totalPrice= computed(() => usecartStore.totalCost);

const visible = ref(false);
</script>



<style lang="sass" scoped>

</style>

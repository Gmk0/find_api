<script setup>

import Navbar from './Partials/Navbar.vue';

import Footer from './Partials/Footer.vue';

import { useCategoryStore,useAuthStore } from '../store/index';

import { onMounted } from 'vue';


const categoryStore = useCategoryStore();
 const userStore = useAuthStore();

 const fetchElement=async ()=>{
     categoryStore.fetchServicesBest();
    categoryStore.fetchServicesPopulars();

 }

onMounted( async () => {

    if(userStore.token != null){
          userStore.getUser();
    }


    categoryStore.getCategories();
    fetchElement();


});

</script>

<template>
    <div class="overflow-x-hidden bg-white dark:bg-gray-800">


        <div class="pageWrapper">
            <Navbar :categories="categoryStore.categories" />

            <div id="">


                <main class="min-h-screen">
                    <slot />
                </main>


            </div>


            <Footer :categories="categoryStore.categories" />
        </div>


    </div>
</template>




<style ></style>

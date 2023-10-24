
<script setup>
import WebLayout from '../../../Layouts/WebLayout.vue';

import { useCategoryStore } from '../../../store';

import { onMounted, ref } from 'vue';


const categoryStore = useCategoryStore();

const categories = ref([]);

const url = import.meta.env.VITE_VUE_APP_BACKEND_URI;

onMounted(async ()=>{

    categories.value= categoryStore.categories;

})


</script>
<template>
    <WebLayout>
         <div>

            <div class="min-h-screen px-4 py-20 bg-gray-100 md:px-8">

                <div class="mx-2">

                </div>


                <div class="grid grid-cols-2 gap-4 md:gap-6 md:grid-cols-4 xl:gap-8">



                    <router-link v-for="category in categories" :to="{ name: 'Category.name', params: { name: category.name } }"
                        class="flex flex-col items-center px-2 py-4 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
                    <img :src="url + category.illustration " class="w-20 h-20 rounded-md" alt="">
                    <h4
                        class="mt-3 mb-1 md:text-[20px] text-[16px]   font-semibold text-slate-600 duration-200 group-hover:text-white">
                        {{ category.name }}</h4>

                    </router-link>




                </div>
            </div>


        </div>

    </WebLayout>


</template>


<style lang="scss" scoped>

</style>

<script setup>


import { onMounted, ref, computed } from 'vue';

import { Swiper, SwiperSlide } from 'swiper/vue';

import { useCategoryStore } from '../../../store';

import { Navigation, Pagination, Autoplay, EffectFade, Scrollbar, A11y, EffectCube } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import 'swiper/css/autoplay';

const categoryStore= useCategoryStore();

const servicesBest= computed(() => categoryStore.serviceBestGet);
const freelances = ref([]);
const categories =computed(()=> categoryStore.categories);



const servicesPopular = computed(() => categoryStore.servicePopularGet);


const swiperInstance = ref(null);
const swiperInstanceFreelances = ref(null);
const swiperInstanceServices = ref(null);
const onSwiperInitializedService = (swiper) => {
    swiperInstanceServices.value = swiper;

}

const onSwiperInitialized = (swiper) => {
    swiperInstance.value = swiper;
};
const onSwiperInitializedFreelance = (swiper) => {

    swiperInstanceFreelances.value = swiper;
};

const navigateFreelance = (direction) => {
    if (swiperInstanceFreelances.value) {
        if (direction === 'prev') {
            swiperInstanceFreelances.value.slidePrev();
        } else if (direction === 'next') {
            swiperInstanceFreelances.value.slideNext();
        }
    }
};


const navigateService = (direction) => {
    if (swiperInstanceServices.value) {
        if (direction === 'prev') {
            swiperInstanceServices.value.slidePrev();
        } else if (direction === 'next') {
            swiperInstanceServices.value.slideNext();
        }
    }
};


const navigate = (direction) => {
    if (swiperInstance.value) {
        if (direction === 'prev') {
            swiperInstance.value.slidePrev();
        } else if (direction === 'next') {
            swiperInstance.value.slideNext();
        }
    }
};



</script>

<template>
    <WebLayout>
        <div>
      <div class="flex flex-col min-h-screen pt-16 mb-6">

             <div x-show="!isLoading" x-cloak class="flex flex-col p-2 mx-6 my-8 bg-white rounded-lg md:min-h-64 dark:bg-gray-800">
                    <div class="mb-2">
                        <h3 class="text-xl leading-snug text-center dark:text-gray-400 text-slate-800">
                            Découvrez une communauté de freelances talentueux prêts à donner vie à vos projets.
                            Trouvez le service parfait pour vous, choisissez parmi une large sélection de compétences et laissez
                            notre
                            communauté de professionnels vous aider à réaliser vos rêves.
                        </h3>
                    </div>
                    <div class="">
                    <div class="py-4 mx-6">

                        <div class="flex items-end justify-end mb-2">
                            <div class="flex gap-4">



                                <button @click="navigate('prev')"
                                    class="w-10 h-10 p-0 rounded-full btn2 prev-btn hover:bg-slate-300/20 focus:bg-slate-300/20 dark:active:bg-slate-300/25 active:bg-slate-100/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button @click="navigate('next')"
                                    class="w-10 h-10 p-0 rounded-full btn2 next-btn hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                        </div>



                     <swiper class="flex py-8 mb-4"
                        :modules="[Navigation, Pagination, Scrollbar, EffectCube, A11y]"

                        :spaceBetween="30"

                        :space-between="25"
                        :breakpoints="{ 300: { slidesPerView: 1 }, 900: { slidesPerView: 3, } }"
                        @swiper="onSwiperInitialized"
                        >
                        <swiper-slide v-for="category in categories" class="m-2">
                             <router-link :to="{ name: 'Category.name', params: { name: category.name } }"
                                        class="flex flex-col items-center px-4 py-2.5 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
                                        <h4
                                            class="mt-3 mb-1 md:text-[12px] text-[10px] font-semibold text-slate-600 duration-200 group-hover:text-white">
                                            {{ category.name }}
                                        </h4>
                                    </router-link>

                        </swiper-slide>

                        </swiper>



                    </div>
                    </div>
             </div>

             <div class="py-8 mx-6">
                        <div class="flex items-center justify-between px-4">
                            <p class="text-xl font-medium text-slate-700 dark:text-navy-100">
                                Les Services populaire
                            </p>
                            <div class="flex gap-4">
                                <button @click="navigateService('prev')"
                                    class="w-10 h-10 p-0 rounded-full btn2 prev-btn hover:bg-slate-300/20 focus:bg-slate-300/20 dark:active:bg-slate-300/25 active:bg-slate-100/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button  @click="navigateService('next')"
                                    class="w-10 h-10 p-0 rounded-full btn2 next-btn hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-5">

                             <swiper class="flex py-8"
                                :modules="[Navigation, Pagination, Scrollbar, EffectCube, A11y]"

                                :spaceBetween="30"
                                :slides-per-view="4"
                                :space-between="25"
                                :breakpoints="{ 600: { slidesPerView: 1 }, 768: { slidesPerView: 2, }, 992: { slidesPerView: 4, } }"
                                @swiper="onSwiperInitializedService"
                                >
                                <swiper-slide v-for="service in servicesBest" class="py-4">

                                <ServiceCard :service="service" :key="service.id" />
                                </swiper-slide>

                                </swiper>




                        </div>
                    </div>

               <div class="py-8 mx-6">
                    <div class="flex items-center justify-between px-4">
                        <p class="text-xl font-medium text-slate-700 dark:text-navy-100">
                            Les Freelance populaire
                        </p>
                        <div class="flex gap-4">
                            <button @click="navigateFreelance('prev')"
                                class="w-10 h-10 p-0 rounded-full btn2 prev-btn hover:bg-slate-300/20 focus:bg-slate-300/20 dark:active:bg-slate-300/25 active:bg-slate-100/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button  @click="navigateFreelance('next')"
                                class="w-10 h-10 p-0 rounded-full btn2 next-btn hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-5">

                         <swiper class="flex py-8"
                            :modules="[Navigation, Pagination, Scrollbar, EffectCube, A11y]"

                            :spaceBetween="30"
                            :slides-per-view="4"
                            :space-between="25"
                            @swiper="onSwiperInitializedFreelance"
                            >
                            <swiper-slide v-for="freelance in freelances" class="">

                            <FreelanceCard :freelance="freelance" />
                            </swiper-slide>

                            </swiper>




                    </div>
                </div>

                 <div class="flex flex-col p-2 mx-4 mt-4 bg-white rounded-lg dark:bg-gray-800 md:mx-6 justify-beetwen">

                    <div class="mb-4">
                        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">Services que vous pourriez aimer</h1>
                    </div>



                    <div
                        class="grid grid-cols-1 gap-4 mx-auto lg:max-6-5xl lg:mx-auto lg:p-4 md:grid-cols-3 lg:md:grid-cols-4 md:gap-4">


                        <div v-for="service in servicesBest">
                              <ServiceCard :service="service" :key="service.id" />


                        </div>








                    </div>

                </div>

                <div
                    class="flex flex-col items-center justify-center p-6 mx-6 mt-4 bg-white rounded-lg shadow-lg dark:bg-gray-800 min-h-64 lg:flex-row lg:justify-start">
                    <img src="/images/hero/team.svg" alt="Illustration de projet"
                        class="hidden w-1/2 h-64 mb-4 rounded-md lg:mr-6 md:block lg:mb-0">
                    <div class="text-center lg:text-left">
                        <h2 class="mb-2 text-xl font-semibold text-gray-800">Vous ne trouvez pas ce que vous cherchez ?</h2>
                        <p class="mb-4 dark:text-gray-300">Si vous avez besoin d'un service particulier, n'hésitez pas à
                            soumettre
                            votre projet et
                            notre communauté de freelances
                            talentueux sera ravie de vous aider..</p>

                            <router-link :to="{name:'Create.mission'}"
                            class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">Soumettre un
                            projet</router-link>


                    </div>
                </div>


        </div>
        </div>
    </WebLayout>
</template>




<style lang="scss" scoped></style>

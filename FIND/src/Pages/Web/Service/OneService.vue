
<script setup>
import WebLayout from '../../../Layouts/WebLayout.vue';
import { onMounted, computed, ref , watch, reactive } from 'vue';

import Galleria from 'primevue/galleria';

import Image from 'primevue/image';
import { useRoute } from 'vue-router';
import { useCategoryStore } from '../../../store';

import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Autoplay, EffectFade, Scrollbar, A11y, EffectCube } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import 'swiper/css/scrollbar';
import 'swiper/css/effect-cube';
import 'swiper/css/autoplay';

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';




const useCategory= useCategoryStore();
const route = useRoute();





const otherService = ref([]);

const like = ref(false);
const level = ref('basic');
const service = computed(() => useCategory.service);

const images =  ref([]);


// Créez un effet réactif qui surveille les changements de service
watch(service, (newService) => {

    console.log(newService)
    images.value = [];

    if (newService.image) {
        for (let i = 0; i < newService.image.length; i++) {
            images.value.push({
                itemImageSrc: '/storage/' + newService.image[i],
                thumbnailImageSrc: '/storage/' + newService.image[i],
                alt: `Description for Image ${i + 1}`,
                title: `Title ${i + 1}`
            });
        }
    }
});
const serviceNumber =ref('');

onMounted(() => {

    serviceNumber.value = route.params.service_numero;

    useCategory.fetchServices(serviceNumber.value);



});


const responsiveOptions = ref([
    {
        breakpoint: '991px',
        numVisible: 4
    },
    {
        breakpoint: '767px',
        numVisible: 3
    },
    {
        breakpoint: '575px',
        numVisible: 1
    }
]);

</script>
<template>
    <WebLayout>
         <div class="min-h-screen py-2 pt-16 bg-gray-100 md:px-6 dark:bg-gray-900">
             <div class="hidden px-2">
                  All/Service
            </div>
            <div class="px-8">
                <button class="px-4 py-2 text-gray-800 transition-all border rounded-lg hover:bg-amber-500 hover:text-white border-amber-500" onclick="history.back()">Retour</button>
            </div>





        </div>

    </WebLayout>
</template>


<style lang="scss" scoped></style>

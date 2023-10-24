
<script setup>
import WebLayout from '../../../Layouts/WebLayout.vue';

import { useRoute, useRouter } from 'vue-router';
import { ref, onMounted, computed, watch } from 'vue';
import { useAuthStore, useCategoryStore } from '../../../store';

import axiosClient from '../../../axios';

import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';

const route = useRoute();
const router = useRouter();
const name = ref('');

const useCategory = useCategoryStore();



const categories = computed(() => useCategory.categories);


const updateSearch = () => {
    router.push({ name: 'Search', params: { search: searchTerm.value } });
};



const form = ref({
    search: '',
    sub_categorie: '',
    price: '',
    level: '',
    tag: '',
    deliveryTime: '',
    orderBy: '',

});
const pageP = ref(null)


const url = import.meta.env.VITE_VUE_APP_BACKEND_URI;

const showDeliveryFilter = ref(false);
const showCategoryFilter = ref(true);
const showTagFilter = ref(true);
const showFiltre = ref(false);
const sous_category = ref(null);

const category =ref('');


const setCategory = (name) => {
    if (form.value.sub_categorie === name) {

        form.value.sub_categorie = '';
    } else {
        form.value.sub_categorie = name;
    }
};

const tags = computed(() => useCategory.tags);

const clearPrice = () => {
    form.value.price = null;

}

const cities = ref([
    { name: 'Nouveau 1', code: '1' },
    { name: 'Nouveau 2', code: '2' },
    { name: 'Nouveau 3', code: '3' },
    { name: 'Nouveau 4', code: '4' },

]);

const deliveryTime = ref([
    {
        name: '1-5 jours', code: '1-5'
    },
    {
        name: '5-10 jours', code: '5-10'
    },
    {
        name: ' +10 jours', code: '10-100'
    },
]);

const trieElement = ref([
    {
        name: 'Plus recent', code: 'created_at-asc'
    },
    {
        name: 'Plus ancient', code: 'created_at-desc'
    },
    {
        name: 'Prix descendant', code: 'basic_price-desc'
    },
    {
        name: 'Prix ascendant', code: 'basic_price-asc'
    },
    {
        name: 'populaire', code: 'populaire-asc'
    }
])

const subcategories = ref([]);
const services = ref([]);

const isLoadingSubcategorie = ref(false);

const fetchSubcategories = async () => {
    try {
        if (category.value) {
            const response = await axiosClient.get(`/subcategoriesByname/${category.value}`);
            subcategories.value = response.data.subcategories;
            isLoadingSubcategorie.value = true;

        } else {
            subcategories.value = [];
        }
    } catch (error) {
        console.error('An error occurred while fetching subcategories:', error);
    }
};
const fetchServices = async () => {
    try {
        const params = form.value;
        const response = await axiosClient.get('/getServicesBySub/' + name.value, {
            params, // Utilisez l'objet params comme paramètres de requête
        });
        services.value = response.data;
        isLoadingSubcategorie.value = true;
    } catch (error) {
        console.error('An error occurred while fetching subcategories:', error);
    }
};

const getResults=async  (page = 1) =>{
        pageP.value={
            page:page
        };

       let newParams ={};

       if (pageP.value) {
        newParams.page = pageP.value.page;
    }

    router.push({ name: route.name, query: newParams });
}


const getWithPagination= async()=>{
    try {

        const response = await axiosClient.get('/getServicesBySub/' + name.value, {
            params: {
                page: pageP.value.page, // Définissez un nom de paramètre pour "page" dans les paramètres de requête
            },// Utilisez l'objet params comme paramètres de requête
        });

        services.value = response.data;

    } catch (error) {
        console.error('An error occurred while fetching subcategories:', error);
    }

}


onMounted(async () => {

    name.value = route.params.sub;
    category.value = route.params.name;

    fetchSubcategories();
    fetchServices();

    useCategory.fetchTagsSubactegory(name.value);
    syncQueryParamsWithForm();
});

const updateRouteWithSearch = () => {
    // Construisez un nouvel objet de paramètres basé sur le formulaire actuel
   const newParams = {};
    if (form.value.search) {
        newParams.search = form.value.search;
    }
    if (form.value.deliveryTime) {
        newParams.deliveryTime = form.value.deliveryTime;
    }
    if (form.value.sub_categorie) {
        newParams.sub_categorie = form.value.sub_categorie;
    }
    if (form.value.price) {
        newParams.price = form.value.price;
    } if (form.value.orderBy) {
        newParams.orderBy = form.value.orderBy;
    } if (form.value.level) {
        newParams.level = form.value.level;
    } if (form.value.tag) {
        newParams.tag = form.value.tag;
    }

    // Utilisez `router.push` pour mettre à jour l'URL avec les nouveaux paramètres
    router.push({ name: route.name, query: newParams });
};
const syncQueryParamsWithForm = () => {
    if (route.query.search) {
        form.value.search = route.query.search;
    }
    if (route.query.sub_categorie) {
        form.value.sub_categorie = route.query.sub_categorie;
    }
    if (route.query.price) {
        form.value.price = route.query.price;
    }
    if (route.query.orderBy) {
        form.value.orderBy = route.query.orderBy;
    }
};
watch(
    form,
    throttle(() => {
        updateRouteWithSearch();
        fetchServices();
    }, 3000),
    { deep: true }
);

watch(
    pageP,
    throttle(() => {
      getWithPagination();
    }),
    { deep: true }
);



watch(() => route.params, () => {
    name.value = route.params.sub;
    category.value = route.params.name;
    fetchSubcategories();
    fetchServices();

    syncQueryParamsWithForm();
});

</script>
<template>
    <WebLayout>
        <div class="relative w-full min-h-screen py-16 pb-12 ">

                <div>
                    <div class="relative h-24 bg-skin-fill">
                            <img class="hidden object-cover w-full h-full opacity-70" src="" alt="Women"
                                title="" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <h1 class="text-lg font-bold text-white lg:text-4xl">{{ name }}</h1>
                            </div>
                    </div>

                    <div class="relative mt-4 ">

                          <div class="sticky top-0 z-30 grid h-auto grid-cols-12 px-4 py-2 bg-white lg:z-0 lg:bg-transparent lg:relative">
                                <div class="lg:col-span-3"></div>

                               <div class="grid col-span-12 gap-4 lg:col-span-9 lg:grid-cols-12 lg:gap-2 ">
                                    <div class="px-4 lg:col-span-9">
                                        <TextInput v-model="form.search" class="!rounded-full w-full   !shadow-md" placeholder="recherche"
                                            icon='search' />
                                    </div>
                                    <div class="flex flex-row justify-between gap-2 px-4 lg:col-span-3">
                                        <div class="">
                                            <div class="block lg:hidden">
                                                <button @click="showFiltre = !showFiltre" class="border py-1.5 px-4 rounded-md ">
                                                    filtre
                                                </button>
                                            </div>
                                        </div>
                                        <div class="flex gap-2 lg:hidden ">
                                            <div>
                                                  <Dropdown v-model="form.orderBy" optionValue="code" :options="trieElement" showClear optionLabel="name" placeholder="Trier par" size="small" class="w-full md:w-14rem" />

                                            </div>
                                        </div>


                                    </div>

                                </div>


                        </div>

                        <div class="grid grid-cols-12 px-4">

                             <div class="relative col-span-3 p-2">

                                    <div :class="showFiltre ? 'fixed inset-0   top-0  bottom-0  dark:bg-gray-800 bg-white z-50 p-4 transition-all duration-200 w-full' : 'hidden w-full mt-0   z-20'"
                                        class="overflow-x-hidden overflow-y-auto rounded-md lg:h-auto lg:block">
                                        <div class="flex flex-col p-2">
                                            <h1 class="mb-2 text-lg font-bold text-gray-800">Filtres</h1>

                                            <div class="flex flex-wrap gap-2 lg:grid lg:grid-cols-1">



                                            </div>

                                            <div class="mt-4">

                                                <h1 class="mb-4 text-lg font-bold text-gray-800">Prix</h1>
                                               <div class="w-full space-y-1 dark:text-gray-100">
                                                    <div aria-hidden="true" class="flex justify-between px-1">
                                                        <div class="flex justify-between gap-4 p-2 border">
                                                        <TextInput value="10 $" disabled class="w-1/2 rounded-md dark:bg-gray-900 "  />
                                                          <TextInput v-model.number="form.price" placeholder="a" class="w-1/2 rounded-md dark:bg-gray-900 "  />
                                                        </div>
                                                    </div>

                                                     <button v-if="form.price != null" @click="clearPrice" class="p-2 text-gray-800 bg-gray-200 rounded-md">
                                                             Clear
                                                    </button>
                                                </div>

                                            </div>


                                            <div
                                                class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                                <button @click="showCategoryFilter = !showCategoryFilter"
                                                    class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                                    <span class="text-base dark:text-gray-100"> Niveau Freelannce</span>
                                                    <svg v-show="!showCategoryFilter" class="w-4 h-4 fill-current"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path
                                                            d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                                    </svg>
                                                    <svg v-show="showCategoryFilter" class="w-4 h-4 fill-current"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path
                                                            d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                                    </svg>
                                                </button>

                                                <Collapse :when="showCategoryFilter">

                                                     <Dropdown v-model="form.level" optionValue="code" :options="cities" showClear optionLabel="name" placeholder="Choisir un niveau" class="w-full md:w-14rem" />
                                                </Collapse>

                                                <div
                                                    class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                                    <button @click="showDeliveryFilter = !showDeliveryFilter"
                                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                                        <span class="text-base dark:text-gray-100"> Temps de livraison</span>
                                                        <svg v-show="!showDeliveryFilter" class="w-4 h-4 fill-current"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                                        </svg>
                                                        <svg v-show="showDeliveryFilter" class="w-4 h-4 fill-current"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                                        </svg>
                                                    </button>
                                                    <Collapse :when="showDeliveryFilter">

                                                        <div class="m-2">

                                                             <Dropdown v-model="form.deliveryTime" :options="deliveryTime" showClear optionLabel="name" optionValue="code" placeholder="Choisir un le temps" class="w-full md:w-14rem" />

                                                        </div>





                                                    </Collapse>
                                                </div>

                                                <div
                                                    class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                                    <button @click="showTagFilter = !showTagFilter"
                                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                                        <span class="text-base dark:text-gray-100"> Tag de recherche</span>
                                                        <svg v-show="!showTagFilter" class="w-4 h-4 fill-current"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                                        </svg>
                                                        <svg v-show="showTagFilter" class="w-4 h-4 fill-current"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path
                                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                                        </svg>
                                                    </button>
                                                    <Collapse :when="showTagFilter">



                                                <div class="flex flex-wrap gap-2">
                                                            <div v-for="(tag, index) in tags" class="">
                                                            <button @click="setTag(tag)"

                                                                :class="{ 'border-2 border-amber-500 bg-amber-100 text-amber-700 translate-x-4': form.tag == tag, 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200': form.tag != tag }"


                                                                class="flex gap-2 p-2 transition-all transform rounded-lg shadow-sm bg-gray-50 ">

                                                                <span class="text-gray-700 dark:text-gray-50">{{ tag }}</span>
                                                                <!-- Adjusted span for the number -->

                                                            </button>
                                                        </div>

                                                        </div>


                                                    </Collapse>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="flex gap-4 lg:hidden">
                                            <button class="btn btn-sm" @click="showFiltre = !showFiltre">
                                                appliquer

                                            </button>
                                            <button class="btn" @click="showFiltre = !showFiltre">
                                                    Fermer

                                                </button>
                                        </div>

                                    </div>
                                    <!--End Sidebar-->
                                    <!--Main Content-->


                                </div>

                                   <div class="col-span-12 pt-8 lg:col-span-9">

                                    <div class="flex-row-reverse justify-between hidden px-4 py-4 lg:flex">
                                        <!--

                                <div class="flex gap-4 p-2 mb-4 rounded">

                                    <span class="text-sm text-amber-600">Filtres appliqués : {{ $count }}</span>


                                    <x-button.circle icon="x" wire:click='resetAll' />
                                </div>
                                -->



                                        <div class=" lg:block">

                                                <Dropdown v-model="form.orderBy" optionValue="code" :options="trieElement" showClear optionLabel="name" placeholder="Trier par" size="small" class="w-full md:w-14rem" />

                                        </div>
                                        <div class=" lg:block">
                                              <TailwindPagination
                                                :data="services"
                                             @pagination-change-page="getResults" />

                                            </div>


                                    </div>

                                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                                        <div v-for="service in services?.data">
                                               <ServiceCard :service="service" :key="service.id"/>

                                        </div>

                                        <div v-if="services.length == 0" class="flex items-center justify-center h-64">
                                            <span class="text-lg font-medium text-gray-500">
                                                Aucun élément trouvé.
                                            </span>
                                        </div>






                                    </div>

                                    <div class="py-4">


                                        <div>
                                             <TailwindPagination
                                                    :data="services"
                                                 @pagination-change-page="getResults" />


                                        </div>


                                    </div>

                                </div>

                        </div>
                        <div class="grid px-4 pt-16 lg:grid-cols-12 ">
                                <div class="hidden lg:col-span-3 lg:block">

                                </div>
                                <div class="lg:col-span-9">

                                    <div class="items-center mb-4">
                                        <h1 class="text-lg font-semibold text-center">Du meme Categories</h1>
                                    </div>
                                    <div class="flex flex-wrap gap-4">

                                        <div v-for="subcategory in subcategories">
                                            <router-link :to="{ name: 'sub.name', params: { name: category, sub: subcategory.name } }"
                                                class="flex gap-2 p-2 transition-all transform bg-gray-200 rounded-lg shadow-sm dark:bg-gray-700 hover:scale-95 active:bg-amber-400 focus:bg-amber-400 focus:text-gray-50 ">

                                                    <img :src="'/storage/' + subcategory.illustration" class="object-fill w-8 p-1 rounded-md" alt="">


                                                <span class="">{{ subcategory.name }}</span>


                                                <div
                                                    class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                                                    {{ category.service_count }}</div>
                                            </router-link>
                                        </div>


                                    </div>



                                </div>
                         </div>






                    </div>



                </div>
            </div>

    </WebLayout>
</template>


<style lang="scss" scoped></style>

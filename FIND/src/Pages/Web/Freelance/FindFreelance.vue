

<script setup>
import WebLayout from '../../../Layouts/WebLayout.vue';

import TextInput from '../../../components/TextInput.vue';
import FreelanceCard from '../../../components/FreelanceCard.vue';
import SecondaryButton from '../../../components/SecondaryButton.vue';
import { ref, onMounted, computed } from 'vue';

import { useCategoryStore, useFreelanceStore } from '../../../store/index';

import { Collapse } from 'vue-collapsed';


const freelanceStore = useFreelanceStore();



const form = ref({
    search: '',
    category:'',
    price: '',
    level: '',
    localisation: '',
    disponible: '',
    sub_category:'',

});
const showFilters = ref(false);

const showCategoryFilter = ref(false);
const Specialite = ref(false);
const experience = ref(false);
const showPriceFilter = ref(false);
const disponibilteFilter = ref(false);
const niveauFilter = ref(false);
const localisationFilter = ref(false);

const freelances = computed(() => {
    return freelanceStore.freelances;
});

onMounted(async() => {

    freelanceStore.getAllFreelances();




});

</script>

<template>
    <WebLayout>
        <div class="min-h-screen pt-16">
        <div class="relative flex flex-col pb-8 bg-gray-100 dark:bg-gray-900">
             <div class="relative h-20 bg-green-500 ">

                    <div class="absolute inset-0 flex items-center justify-center">
                        <h1 class="text-4xl font-bold text-white">Trouver un freelance</h1>
                    </div>
                </div>
                <div  class="sticky top-0 z-30 grid h-auto grid-cols-12 py-2 bg-white lg:z-0 lg:bg-transparent lg:relative ">
                    <div class="hidden lg:col-span-3 lg:flex">

                    </div>


                    <div class="relative grid col-span-12 gap-4 py-4 lg:grid-cols-12 lg:col-span-9 lg:gap-2 ">
                        <div class="px-4 lg:col-span-9">

                            <TextInput v-model="form.search" class="!rounded-full w-full !shadow-sm" placeholder="recherche"
                                 />
                        </div>
                        <div class="sticky top-0 flex flex-row justify-between gap-2 px-4 lg:col-span-3">

                            <div class="block lg:hidden">

                                <SecondaryButton  label="filtre">

                                </SecondaryButton>
                            </div>


                            <div class="flex gap-2">

                                <div>

                                </div>
                                <div class="z-40">
                                    <select placeholder="Trier par" class=" z-30 !rounded-xl !shadow-md"
                                        >

                                        <option value="">Trier par</option>
                                        <option value="level-asc">Niveau ascendant</option>
                                        <option  value="level-desc">Niveau Descendant</option>
                                        <option  value="populaire-desc">Populaire</option>
                                        <option  value="nouveau-desc">Nouveau</option>

                                    </select>

                                </div>


                            </div>


                        </div>

                    </div>


                </div>
            <div  class="grid grid-cols-12 px-2">

                 <div class="w-full col-span-3 mt-4 leading-normal text-gray-800 lg:px-2">

                        <div :class="showFilters ? 'fixed inset-0  top-0  bottom-0  dark:bg-gray-800 bg-white z-[600] p-4 transition-all duration-200 w-full' : 'hidden w-full h-auto mt-0  md:top-[6rem]  inset-0 z-20'"
                            class="overflow-x-hidden overflow-y-auto border border-gray-400 rounded-md shadow lg:h-auto lg:block lg:border-transparent lg:shadow-none lg:bg-transparent custom-scrollbar"
                            id="menu-content">

                            <nav class="overflow-y-auto">
                                <!-- Filtres -->
                                <div
                                    class="w-full p-4 overflow-y-auto bg-white rounded-lg custom-scrollbar dark:bg-gray-800">
                                    <h3 class="mb-6 font-bold text-gray-700 dark:text-gray-100">Filtres</h3>
                                    <div class="mt-4 mb-4 border-t py-2.5 border-b relative border-gray-400 ">
                                        <button @click="setCategory()"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100"> Catégorie</span>
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
                                         <Collapse :when="showCategoryFilter" class="overflow-hidden leading-normal collapse">

                                            <div class="m-2">
                                                 <SelectCategory
                                                  id="select-category"
                                                  v-model="form.category"
                                                  />

                                            </div>

                                        </Collapse>

                                    </div>


                                    <div class="py-3 mb-4 border-b border-gray-400">
                                        <button @:click="Specialite = !Specialite"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 dark:text-gray-100 focus:outline-none">
                                            <span class="text-base dark:text-gray-100">Specialite</span>
                                            <svg v-show="!Specialite" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg v-show="Specialite" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <Collapse :when="Specialite" class="overflow-hidden leading-normal collapse">

                                                 <div class="m-2">
                                                    <label for="subcategories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a subcategory</label>
                                                    <select id="subcategories" v-model="form.sub_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="" selected>Choose a subcategory</option>
                                                    <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.name }}</option>
                                                    </select>
                                                </div>
                                          </Collapse>
                                    </div>



                                    <div class="py-3 mb-4 border-b border-gray-400">
                                        <button @click="experience = !experience"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 dark:text-gray-100 focus:outline-none">
                                            <span class="text-base dark:text-gray-100">Experience</span>
                                            <svg v-show="!experience" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg v-show="experience" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <Collapse :when="experience">

                                            <div class="m-2">
                                                <select class="w-full max-w-xs select select-ghost">
                                                    <option disabled selected>Pick the best JS framework</option>
                                                    <option>O-1</option>
                                                    <option>5 ans</option>
                                                    <option>7 ans</option>
                                                    </select>

                                                </div>




                                        </Collapse>
                                    </div>



                                    <div class="py-3 mb-4 border-b border-gray-400">
                                        <button @click="showPriceFilter = !showPriceFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100">Taux Journalier</span>
                                            <svg v-show="!showPriceFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg v-show="showPriceFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <Collapse :when="showPriceFilter" class="mt-2">
                                            <div class="m-2">


                                            </div>




                                        </Collapse>
                                    </div>



                                   <div class="relative py-3 mt-4 mb-4 border-gray-400 ">
                                        <button @click="disponibilteFilter = !disponibilteFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100">Disponibilte</span>
                                            <svg v-show="!disponibilteFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg v-show="disponibilteFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <Collapse :when="disponibilteFilter" class="">

                                                <div>

                                                <Checkbox id="terms" name="terms"/>

                                                </div>
                                        </Collapse>
                                    </div>


                                    <div class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                        <button @click="niveauFilter = !niveauFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100"> Niveau Freelannce</span>
                                            <svg v-show="!niveauFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg v-show="niveauFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <Collapse :when="niveauFilter">

                                            <div class="m-2">




                                            </div>
                                        </Collapse>
                                    </div>



                                    <div class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                        <button @click="localisationFilter = !localisationFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100"> Localisation</span>
                                            <svg v-show="!localisationFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg v-show="localisationFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <Collapse :when="localisationFilter">
                                            <div class="m-2">

                                            </div>


                                        </Collapse>
                                    </div>



                                </div>
                             </nav>




                                <div class="flex w-full gap-4 md:hidden ">


                                     <button  @click="showFilters = !showFilters">appliquer</button>

                                    <button @click="showFilters = !showFilters" >Fermer</button>-

                                </div>




                        </div>



                </div>

                   <div class="col-span-12 pt-2 lg:col-span-9">



                        <div class="px-4 py-4">
                            <!--
                        @if($count = $this->countFiltersApplied())
                        <div class="flex items-center gap-4 p-2 mb-4 rounded">

                            <span class="text-sm text-amber-600">Filtres appliqués : {{ $count }}</span>


                            <x-button.circle icon="x" wire:click='resetAll' />
                        </div>
                        @
                         -->


                            <div class="hidden ">
                                <!--
                                <pagination class="mt-6" :links="props.freelances.links" />
                                    -->
                            </div>


                        </div>





                        <div class="z-0 grid gap-4 p-2 md:grid-cols-2 lg:grid-cols-3">




                            <div v-for="freelance in freelances.data" class="mx-auto lg:mx-0  w-[80%]">
                                <FreelanceCard :freelance="freelance" />
                            </div>
                             <!--



                            <h1 v-if="props.freelances.data.length === 0" class="text-lg text-gray-800 md:text-2xl">Pas de Resultat</h1>

                                -->

                        </div>

                        <div class="mt-4">
                            <!--

                            <pagination class="mt-6" :links="props.freelances.links" />

                            -->
                        </div>



                    </div>

            </div>
        </div>
        </div>

    </WebLayout>

</template>

<style>
.collapse {
    transition: height var(--vc-auto-duration) cubic-bezier(0.3, 0, 0.6, 1);
}
</style>




import { useCategoryStore } from '@/store';
<script setup>
import Steps from 'primevue/steps';


import FileUpload from 'primevue/fileupload';
import Button from 'primevue/button';



import { ref, onMounted, computed } from 'vue';
import { useToast } from "primevue/usetoast";

import {useCategoryStore} from '../../../store'

const category = ref();

const useCategory = useCategoryStore();


const categories = computed(() => useCategory.categories);




const toast = useToast();

const onAdvancedUpload = () => {
    toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 });
};

const step = ref(1);








const changeStep = (newStep) => {
    step.value = newStep;
};


</script>

<template>
    <WebLayout>
    <div>
        <div class="min-h-screen pt-16 border-t border-gray-100 bg-gray-50 dark:bg-gray-900">

            <div class="mx-4">
                    Mission/Create
            </div>

            <div class="grid grid-cols-2 px-2 py-3 ">

                <div class="hidden col-span-1 p-4 lg:block">
                        <img src="/images/hero/team.svg" class="object-cover w-full h-full p-2 bg-white rounded-md " alt="">
                </div>

                <div class="flex flex-col w-full col-span-1 mx-auto lg:mx-0 ">

                    <div class="">

                        <div class="p-4 border rounded-lg ">
                            <ol class="flex items-center justify-around w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0">

                                 <li :class="{ 'flex items-center text-blue-600 dark:text-blue-500 space-x-2.5': step === 1, 'flex items-center text-gray-500 dark:text-gray-400 space-x-2.5': step !== 1 }">

                                <span :class="{ 'flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500': step === 1, 'flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400': step !== 1 }">
                                    1
                                </span>
                                <span>
                                    <h3 class="font-medium leading-tight">User info</h3>
                                    <p class="text-sm">Step details here</p>
                                </span>
                             </li>
                                <li :class="{ 'flex items-center text-blue-600 dark:text-blue-500 space-x-2.5': step === 2, 'flex items-center text-gray-500 dark:text-gray-400 space-x-2.5': step !== 2 }">
                                   <span :class="{ 'flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500': step === 2, 'flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400': step !== 2 }">
                                        2
                                    </span>
                                    <span>
                                        <h3 class="font-medium leading-tight">Company info</h3>
                                        <p class="text-sm">Step details here</p>
                                    </span>
                                </li>
                            </ol>
                        </div>
                        <div class="">

                             <transition name="fade">
                            <div v-if="step === 1" class="flex flex-col mt-4 ">
                                <div>
                                    <InputLabel for="name" value="Titre" />
                                    <TextInput
                                        id="name"

                                        type="text"
                                        class="block w-full mt-1"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                </div>
                                <div class="mt-4">
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                                    <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Decrivez..."></textarea>
                                </div>
                                <div>
                                    <div class="card">
                                    <Toast />
                                    <FileUpload name="demo[]"  @upload="onAdvancedUpload($event)" :multiple="true" accept="image/*" :maxFileSize="1000000">
                                        <template #empty>
                                            <p>Drag and drop files to here to upload.</p>
                                        </template>
                                    </FileUpload>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <Dropdown  optionValue="id" :options="categories" showClear optionLabel="name" placeholder="Categories"  class="w-full md:w-14rem" />

                                </div>

                            </div>
                            </transition>

                            <transition name="fade">
                             <div v-if="step === 2" class="flex flex-col w-full mt-4">
                                    <div>
                                        <InputLabel for="name" value="Titre" />
                                        <TextInput
                                            id="name"

                                            type="text"
                                            class="block w-full mt-1"
                                            required
                                            autofocus
                                            autocomplete="name"
                                        />

                                    </div>
                                    <div class="mt-4">
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Decrivez..."></textarea>
                                    </div>
                                    <div>
                                        <div class="card">
                                        <Toast />
                                        <FileUpload name="demo[]"  @upload="onAdvancedUpload($event)" :multiple="true" accept="image/*" :maxFileSize="1000000">
                                            <template #empty>
                                                <p>Drag and drop files to here to upload.</p>
                                            </template>
                                        </FileUpload>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <Dropdown  optionValue="id" :options="props.categories" showClear optionLabel="name" placeholder="Categories"  class="w-full md:w-14rem" />

                                    </div>

                                </div>
                            </transition>

                        </div>
                        <div class="flex justify-between mt-6">
                            <div>

                                <button  v-if="step === 2" @click="changeStep(1)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Retour
                                </button>

                            </div>
                            <div>
                                 <button v-if="step === 1" @click="changeStep(2)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Continuer
                                </button>

                                <button  v-if="step === 2" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Soumettre
                                </button>

                            </div>

                        </div>

                    </div>


                    <div>

                        <div>

                     </div>

                    </div>


                </div>

            </div>

        </div>
    </div>
    </WebLayout>
</template>




<style lang="scss" scoped>

</style>

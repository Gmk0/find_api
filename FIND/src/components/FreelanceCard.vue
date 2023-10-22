
<script setup>

import { computed , onMounted, reactive, watch, ref } from 'vue';





const toogleFavorite=()=>{

}




const props = defineProps({
    freelance:Object,
})





const like = ref(props.freelance.like);


</script>

<template>

    <div class="m-1 lg:mx-0">
        <div class="relative flex w-full min-w-[18rem] flex-col rounded-xl bg-white dark:bg-gray-900 bg-clip-border text-gray-700 shadow-lg">
            <div
                class="relative h-48 mx-4 mt-2 overflow-hidden text-white shadow-lg rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40">




                <img v-if="props.freelance.user.profile_photo_path != null" src="" alt=""
                    class="object-cover w-full h-48">

                <img v-else class="object-cover w-full h-48" :src="props.freelance.user.profile_photo_url" alt="">




                <div v-if="false"  class="flex items-center">
                    <button class="absolute top-2 right-2"
                        @click="toogleFavorite()">


                        <span  v-show="!like" class="">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </span>
                        <span  v-show="like">
                            <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </span>


                    </button>



                </div>


            </div>
            <div class="p-3">
                <div class="flex items-center justify-between mb-2">
                    <h5 class="block font-sans text-base antialiased leading-snug tracking-normal text-gray-800">
                    {{ props.freelance.user.name }}
                    </h5>
                    <p
                        class="flex items-center gap-1.5 font-sans text-sm font-normal leading-relaxed text-gray-800 dark:text-white  antialiased">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            class="-mt-0.5 h-3 w-3 text-yellow-400">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                clip-rule="evenodd"></path>
                        </svg>

                        ({{ props.freelance.level }})

                    </p>
                </div>
                <p class="block font-sans text-sm antialiased leading-relaxed text-gray-700 dark:text-gray-200">
                         ({{ props.freelance.category.name }})
                </p>
                <div class="inline-flex flex-wrap items-center h-20 gap-3 mt-2 group">

                    <span v-for="(sub , index) in props.freelance.sub_categorie" class="items-center py-1 cursor-default px-2 rounded-md text-[10px] lg:text-[10px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                            {{sub.name }}
                    </span>


                     <!--
                    @empty(!$subCategories)

                    @forelse ($subCategories as $subCategory)
                    @if ($loop->index < 4)
                    <span x-tooltip='"{{$subCategory->name}}"'
                        class="items-center py-1 cursor-default px-2 rounded-md text-[10px] lg:text-[10px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                        {{ $subCategory -> name }}
                        </span>

                        @endif
                        @if ($loop->last && $loop->remaining > 0)
                        <span class="ml-2 text-sm text-gray-500">(+{{ $loop -> remaining }} de plus)</span>                        @endif

                        @empty

                        @endforelse

                        @endempty
                        -->


                </div>



            </div>
            <div class="flex flex-row justify-between gap-2 p-3 pt-auto">
                <button type="button"
                    class="block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-amber-500/20 transition-all hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                     data-ripple-light="true">
                    Contacter
                </button>
                <router-link to="/"
                    class="block w-full select-none rounded-lg  py-2 px-2 text-center align-middle font-sans text-sm font-bold uppercase dark:text-white shadow-md dark:shadow-white-500/20 text-amber-600 transition-all hover:shadow-lg  focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    profile
           </router-link>
            </div>
        </div>
    </div>



</template>


<style lang="scss" scoped>

</style>

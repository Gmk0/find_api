<template>

         <div class="w-full min-h-screen">


    <div  class="p-2">
        <div
            class="flex flex-col min-h-screen gap-6 mx-auto bg-gray-100 md:p-6 md:max-w-7xl md:container px-auto dark:bg-gray-900">

            <div  class="grid grid-cols-2 gap-4 px-auto lg:grid-cols-4">
                <a href=""
                    class="px-4 py-6 bg-white rounded-lg shadow-xl cursor-pointer lg:px-6 lg:py-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-indigo-600">Total Depense</span>
                        <span
                            class="hidden px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default md:flex hover:bg-gray-500 dark:text-gray-900 hover:text-gray-200">Today</span>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <svg class="w-8 h-8 p-1 text-indigo-600 bg-indigo-400 border border-indigo-600 rounded-full md:w-12 md:h-12 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-end">
                                <span class="text-xl font-bold text-gray-800 2xl:text-3xl">250</span>
                                <div class="flex items-center hidden mb-1 ml-2">

                                    <svg class="w-12 h-12 p-1 text-green-600 bg-green-400 border border-green-600 rounded-full 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="font-bold text-sm text-gray-500 ml-0.5">2</span>


                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="px-6 py-6 bg-white rounded-lg shadow-xl cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-green-600">Commande</span>
                        <span
                            class="hidden px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default md:hidden dark:text-gray-900 hover:bg-gray-500 hover:text-gray-200">7
                            days</span>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <svg class="w-8 h-8 p-1 text-green-600 bg-green-400 border border-green-600 rounded-full md:w-12 md:h-12 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-end">
                                <span class="text-2xl font-bold text-gray-800 2xl:text-4xl">36</span>
                                <div class="flex items-center mb-1 ml-2">
                                    <!--
                                    @if ($orderEvolution > 0)
                                    <svg class="w-12 h-12 p-1 text-green-600 bg-green-400 border border-green-600 rounded-full 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="font-bold text-sm text-gray-500 ml-0.5">{{ $orderEvolution }}</span>
                                    @elseif ($orderEvolution < 0) <svg class="w-5 h-5 text-red-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6">
                                        </path>
                                        </svg>
                                        <span class="font-bold text-sm text-gray-500 ml-0.5">{{ $orderEvolution }}</span>
                                        @else
                                        <svg class="hidden w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.6 3.6a9 9 0 1 1-12.8 0 9 9 0 0 1 12.8 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                        </svg>
                                        <span
                                            class="font-bold text-sm hidden text-gray-500 ml-0.5">{{ $orderEvolution }}</span>
                                        @endif
                                        -->

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href=""
                    class="px-6 py-6 bg-white rounded-lg shadow-xl cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-blue-600">Transaction</span>
                        <span
                            class="hidden px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default md:flex dark:text-gray-900 hover:bg-gray-500 hover:text-gray-200">7
                            days</span>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <svg class="w-8 h-8 p-1 text-blue-600 bg-blue-400 border border-blue-600 rounded-full md:w-12 md:h-12 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-col ">
                            <div class="flex items-end ">
                                <span class="text-2xl font-bold text-gray-800 2xl:text-4xl">24</span>
                                <div class="items-center hidden mb-1 ml-2 ">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span class="font-bold text-sm text-gray-500 ml-0.5">7%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href=""
                    class="px-6 py-6 bg-white rounded-lg shadow-xl cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-800">Mission en attente</span>
                        <span
                            class="hidden px-2 py-1 text-xs text-gray-500 transition duration-200 bg-gray-200 rounded-lg cursor-default md:flex dark:text-gray-900 hover:bg-gray-500 hover:text-gray-200">30
                            days</span>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <svg class="w-8 h-8 p-1 text-yellow-600 bg-yellow-400 border border-yellow-600 rounded-full md:w-12 md:h-12 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-end">
                                <span class="text-2xl font-bold text-gray-800 2xl:text-4xl">Test</span>
                                <div class="flex items-center hidden mb-1 ml-2">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                    <span class="font-bold text-sm text-gray-500 ml-0.5">-1%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



        </div>

    </div>




        </div>



</template>

<script setup>

</script>
<script>

import UserLayout from '../../../Layouts/UserLayout.vue'


export default{
    layout: UserLayout,
}

</script>

<style lang="scss" scoped>

</style>

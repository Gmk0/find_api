<template>

   <div class="z-[100]">
    <div class="flex header-wrap !z-[100] classicHeader animated"
            :class="[
                isSticky ? 'stickyNav fadeInDown  dark:text-white fadeInDown dark:bg-gray-800' : '',
                route.fullPath === '/' ? '' : 'dark:bg-gray-800 bg-white'
            ]"


            @scroll="handleScroll">
        <div class="w-full px-4 lg:px-12">
            <div class="grid items-center justify-between w-full grid-cols-12 lg:mx-auto">
                <!--Desktop Logo-->
                <div class="hidden logo md:col-span-2 lg:block">
                    <a href="">
                        <img src="/images/logo/find_02.png" class="hidden w-20 lg:block" alt="FInd" title="Find" />
                    </a>
                </div>
                <!--End Desktop Logo-->
                <div class="col-span-3 lg:col-span-8">
                    <div class="block lg:hidden">
                    <button @click="navOpen = !navOpen"
                            class="inline-flex items-center justify-center p-2 text-gray-700 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
                            v-bind:aria-label="navOpen ? 'Close main menu' : 'Main menu'" v-bind:aria-expanded="navOpen">
                            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': navOpen, 'inline-flex': !navOpen }" class="inline-flex" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !navOpen, 'inline-flex': navOpen }" class="hidden" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!--Desktop Menu-->
                    <nav class="relative grid__item" id="AccessibleNav"><!-- for mobile -->
                        <ul id="siteNav" class="site-nav medium center hidearrow">
                            <li class="lvl1 parent megamenu">


                                <router-link to="/">
                                        <span class="dark:!text-white"
                                        :class="{ 'text-white ': !isSticky && !isNotHome, 'lg:hidden dark:!text-white': isNotHome && !isSticky, 'hidden': isSticky && isNotHome }">Accueil</span>

                                        <span  class="dark:!text-white"  :class="{ 'hidden dark:!text-white': !isNotHome }">Accueil</span>




                                </router-link>




                            </li>
                            <li class="lvl1 parent z-[60]  megamenu">

                                     <a href="">
                                            <span class="dark:!text-white" :class="{ 'lg:text-white': !isSticky && !isNotHome, 'lg:hidden': isNotHome && !isSticky, 'hidden': isSticky && isNotHome }">Categories</span>

                                            <span class="dark:!text-white" :class="{ 'hidden': !isNotHome }">Categories</span>



                                     </a>

                                <div class="megamenu z-50 hidden lg:block  !dark:bg:gray-800 !pb-12 style4 soft-scrollbar">
                                        <div>
                                                <router-link :to="{name:'category'}"
                                                 class="mb-2 font-bold Text-lg">Toutes les categories </router-link>
                                            </div>
                                    <ul class="grid grid-cols-4 rounded-md grid--uniform mmWrapper">


                                        <li  v-for="category in categories" :key="category.id" class="grid__item lvl-1 col-md-3 col-lg-3">
                                          <router-link :to="{ name: 'Category.name', params: { name: category.name } }" class="site-nav lvl-1">{{ category.name }}</router-link>
                                            <ul class="subas">
                                                <li v-for="subcategory in category.sub_categories" class="lvl-2">
                                                    <router-link :to="{name:'sub.name', params :{name: category.name , sub: subcategory.name }}" class="site-nav lvl-2">{{ subcategory.name }}</router-link>
                                                </li>

                                            </ul>
                                        </li>



                                    </ul>
                                </div>
                            </li>
                            <li class="lvl1 parent dropdown">
                                     <a href="">
                                        <span  class="dark:!text-white"  :class="{ 'lg:text-white': !isSticky && !isNotHome, 'lg:text-black lg:hidden': isNotHome && !isSticky, 'hidden': isSticky && isNotHome }">Freelance</span>

                                        <span class="dark:!text-white"  :class="{ 'hidden': !isNotHome }">Freelance</span>

                                     </a>



                                    <ul class="dropdown">
                                            <li>
                                                <router-link :to="{name:'registration'}">

                                                Devenir Freelance
                                            </router-link>


                                            </li>
                                            <li>
                                               <router-link :to="{ name: 'FindFreelance' }"
                                                    >
                                                    Trouver Freelance
                                                </router-link>

                                            </li>


                                    </ul>
                        </li>
                        <li class="lvl1 parent dropdown">
                             <a href="#">
                                            <span class="dark:!text-white"  :class="{ 'lg:text-white': !isSticky && !isNotHome, 'lg:hidden': isNotHome && !isSticky, 'hidden': isSticky && isNotHome }">Mission</span>

                                            <span class="dark:!text-white"  :class="{ 'hidden': !isNotHome }">Mission</span>

                             </a>
                             <ul class="dropdown">

                                <li><router-link :to="{name:'Create.mission'}">Soumettre une Mission</router-link></li>
                            </ul>
                        </li>
                            <li class="lvl1 parent dropdown">
                                <router-link :to="{name:'ServiceAll' }">

                                                <span  class="dark:!text-white"  :class="{ 'lg:text-white': !isSticky && !isNotHome, 'lg:hidden': isNotHome && !isSticky, 'hidden': isSticky && isNotHome }">Services</span>

                                                <span class="dark:!text-white"  :class="{ 'hidden': !isNotHome }">Services</span>

                                    </router-link>

                            </li>
                        <li class="lvl1 parent dropdown">
                                           <a  href="route('home')">
                                                    <span class="dark:!text-white"  :class="{ 'lg:text-white': !isSticky && !isNotHome, 'lg:hidden': isNotHome && !isSticky, 'hidden': isSticky && isNotHome }">Services</span>

                                                    <span class="dark:!text-white"  :class="{ 'hidden': !isNotHome }">Services</span>

                                            </a>
                            <ul class="dropdown">
                                 <li>
                                     <router-link :to="{ name: 'Contact' }">Contact</router-link>

                                </li>
                                <li>
                                    <router-link :to="{ name: 'Feedback' }">Feedback</router-link>

                                </li>
                                <li>
                                    <router-link :to="{ name: 'About' }">A propos de nous</router-link>

                                    </li>
                                <li>
                                        <router-link :to="{ name: 'Faq' }">Faq</router-link>



                                </li>
                            </ul>
                        </li>

                        </ul>
                    </nav>
                    <!--End Desktop Menu-->
                </div>
                <!--Mobile Logo-->
                <div class="block col-span-6 mx-auto lg:col-span-2 lg:hidden mobile-logo">
                    <div class="logo">
                        <a href="/">


                                <img  src="/images/logo/find_02.png" alt="logo-find" class="w-24">
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-end col-span-3 gap-2 lg:col-span-2 ">
                    <div v-if="currentUser">
                             <CartComponent />
                    </div>
                    <div v-else>

                        <router-link class="text-white" to="/login">
                            connexion

                        </router-link>

                    </div>


                    <!--
                    <div v-if="$page.props.auth.user"  class="site-cart">
                          <button @click="isSearchBoxOpen = !isSearchBoxOpen" type="button" class="search-trigger">

                                    <svg v-show="isNotHome" class="hidden w-5 h-5 lg:block " :class="isSticky ? 'dark:!text-white' : '!text-white dark:!text-white'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <svg  v-show="!isNotHome" class="hidden w-5 h-5 lg:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <svg  class="block w-5 h-5 text-gray-700 dark:text-white lg:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>


                            </button>


                    </div>
                    -->

                     <div v-if="currentUser" class="hidden lg:block">
                        <userInfo />
                    </div>



                    <div v-if="!currentUser">

                            <router-link  :to="{ name: 'register' }"  class="relative items-center justify-center hidden w-full h-12 px-8 mx-auto rounded-full lg:flex bg-skin-fill group dark:bg-skin-fill hover:scale-105 active:duration-75 active:scale-95 sm:w-max">

                                 <span
                                        class="relative text-base font-semibold text-white dark:text-white underline-none">S'inscrire</span>

                            </router-link  >

                            <router-link :to="{name: 'register'}"  class="relative flex items-center justify-center h-10 px-4 mx-auto mr-4 text-sm duration-300 rounded-md lg:hidden bg-gray-50 before:absolute before:inset-0 before:transition hover:scale-105 active:duration-75 active:scale-95 sm:w-max">

                                      <span class="relative text-base font-semibold text-amber-600">S'inscrire</span>

                            </router-link>

                    </div>

                </div>
            </div>
        </div>
    </div>

   </div>
</template>

<script setup>

import { ref, watch, computed } from 'vue';
import { useRoute } from 'vue-router';
import  userInfo from '../../Components/userInfo.vue';

import { useAuthStore } from '../../store';

defineProps(['categories'])

const route = useRoute();

const userStore = useAuthStore();

const currentUser = computed(() => userStore.user);



const navOpen = ref(false);
const isSearchBoxOpen = ref(false);
const isSticky = ref(false);
const isNotHome = ref(false);



const isNotHomeFunt =()=>{

    if(route.fullPath ==='/'){
        isNotHome.value=false;
    }else{
        isNotHome.value=true;
    }
}

isNotHomeFunt();







function handleScroll() {
    if (window.innerWidth > 1199) {
        if (window.scrollY > 145) {
            isSticky.value = true;
            // Ajoutez d'autres modifications nécessaires ici
        } else {
            isSticky.value = false;
            // Ajoutez d'autres modifications nécessaires ici
        }
    }
}

// Attachez l'événement de défilement au composant
window.addEventListener('scroll', handleScroll);
</script>

<style lang="scss" scoped>

</style>

<template>
    <div>
         <Dropdown align="right" width="48">
                    <template #trigger>

                        <span  class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                {{ currentUser.name }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Account
                            </div>
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                   {{ currentUser.email}}
                                </div>
                              <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ userStore.freelance }}
                            </div>

                             <DropdownLink href="user.dashboard">
                                        Dashboard user
                            </DropdownLink>







                            <div class="border-t border-gray-200" />

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    Log Out
                                </DropdownLink>
                            </form>
                        </template>
            </Dropdown>

    </div>
</template>

<script setup>
import { ref, watch, computed, onMounted } from 'vue';

import Dropdown from '../Components/Dropdown.vue';
import DropdownLink from '../Components/DropdownLink.vue';
import NavLink from '../Components/NavLink.vue';
import ResponsiveNavLink from '../Components/ResponsiveNavLink.vue';

import { useAuthStore } from '../store';

//import { useDark ,useToggle } from '@vueuse/core';

import { usePrimeVue } from 'primevue/config';

const PrimeVue = usePrimeVue();

const userStore = useAuthStore();

const currentUser = computed(() => userStore.user);


// isDark = useDark();

const logout=()=>{

    userStore.HandleLogout();

}


//const dark= useToggle(isDark);

const ToggleDark =()=>{

        dark();

    if(isDark.value){


        toggleTheme("lara-light-blue")
    }else{
         toggleTheme("lara-dark-blue")
    }
} ;


const toggleTheme = (current) => {

    let nextTheme = 'lara-light-blue';
    let linkElement ='light';

    if (current === 'lara-light-blue') nextTheme = 'lara-dark-blue';
    else if (current === 'lara-dark-blue') nextTheme = 'lara-light-blue';

    PrimeVue.changeTheme(current, nextTheme, 'light', () => { });

    console.log(current ,nextTheme);


}

onMounted(() => {

});

</script>

<style lang="scss" scoped>

</style>

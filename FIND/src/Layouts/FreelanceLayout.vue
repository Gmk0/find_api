<script setup>

import { useCategoryStore, useAuthStore, useLayoutStore } from '../store';

import { onMounted } from 'vue';
import MainSidebarF from './Partials/MainSidebarF.vue';
import SidebarPanelF from './Partials/SidebarPanelF.vue';
import PartialHeaderF from './Partials/PartialHeaderF.vue';

import OtherPanelF from './Partials/OtherPanelF.vue';

const categoryStore = useCategoryStore();
const layoutStore = useLayoutStore();
const userStore = useAuthStore();




function resize() {
    if (window.innerWidth < 768) {
        layoutStore.ToogleFalse();

    } else {



    }
}

resize();


</script>

<template>
    <div class="" :class="{ 'is-sidebar-open': layoutStore.SidebarExpanded }">





        <!-- Page Wrapper -->
        <div id="root" class="flex min-h-100vh grow bg-slate-50 dark:bg-navy-900">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Main Sidebar -->
                <MainSidebarF />


                <!-- Sidebar Panel -->

                <SidebarPanelF />
            </div>

            <!-- App Header -->
            <PartialHeaderF />

            <!-- Mobile Searchbar -->




            <OtherPanelF />

            <div class="main-content pt-4 w-full px-[var(--margin-x)] pb-8">
                <router-view></router-view>

            </div>



        </div>











    </div>
</template>




<style >
@import url('../assets/css/new.css');
</style>

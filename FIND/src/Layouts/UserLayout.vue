<script setup>

import { useCategoryStore, useAuthStore , useLayoutStore } from '../store';

import { onMounted } from 'vue';
import MainSidebarUser from './Partials/MainSidebarUser.vue';
import SidebarPanelUser from './Partials/SidebarPanelUser.vue';
import PartialHeaderUser from './Partials/PartialHeaderUser.vue';

import OtherPanelUser from './Partials/OtherPanelUser.vue';

const categoryStore = useCategoryStore();
const layoutStore=useLayoutStore();
const userStore = useAuthStore();




function resize() {
    if (window.innerWidth < 768) {
        layoutStore.ToogleFalse();

    }else{



    }
}

resize();


</script>

<template>
    <div class="is-header-not-sticky" :class="{'is-sidebar-open': layoutStore.SidebarExpanded }">





        <!-- Page Wrapper -->
        <div id="root" class="flex min-h-100vh grow bg-slate-50 dark:bg-navy-900">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Main Sidebar -->
                <MainSidebarUser />


                <!-- Sidebar Panel -->

               <SidebarPanelUser />
            </div>

            <!-- App Header -->
           <PartialHeaderUser />

            <!-- Mobile Searchbar -->




            <OtherPanelUser />

            <div class="main-content pt-4 w-full px-[var(--margin-x)] pb-8">
                <router-view></router-view>

            </div>



        </div>











    </div>
</template>




<style >

@import url('../assets/css/app3.css');

</style>

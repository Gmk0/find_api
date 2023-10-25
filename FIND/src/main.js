import { createApp, markRaw } from 'vue'
import './index.css';

//import { breakpoints } from './utils/breakpoints';

import 'aos/dist/aos.css';
import AOS from 'aos';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import Popper from "vue3-popper";

import Dropdown from 'primevue/dropdown';

import InputText from 'primevue/inputtext';

import ServiceCard from './components/ServiceCard.vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { Collapse } from 'vue-collapsed';
import TextInput from './components/TextInput.vue';
import Slider from 'primevue/slider';
import WebLayout from './Layouts/WebLayout.vue';
import UserLayout from './Layouts/UserLayout.vue';
import FreelanceCard from './components/FreelanceCard.vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import CartComponent from './components/CartComponent.vue';

import NotificationComponent from './components/NotificationComponent.vue';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';

import MultiSelect from 'primevue/multiselect';


import 'nprogress/nprogress.css';
import NProgress from 'nprogress';

//import DataTable from 'laravel-vue-datatable';

NProgress.configure({ color: 'red' });

const pinia = createPinia();

pinia.use(({ store }) => {
    store.router = markRaw(router)

}).use(piniaPluginPersistedstate);

const app = createApp(App);

app.use(pinia)
    .use(router)
    .use(VueSweetalert2)
    .use(PrimeVue)
    .use(ToastService)
    //.use(DataTable)
    .component('Collapse', Collapse)
    .component('ServiceCard', ServiceCard)
    .component('Dropdown', Dropdown)
    .component('TextInput', TextInput)
    .component('InputText', InputText)
    .component('Slider', InputText)
    .component('WebLayout', WebLayout)
    .component('CartComponent', CartComponent)
    .component("Popper", Popper)
    .component('FreelanceCard', FreelanceCard)
    .component('UserLayout', UserLayout)
    .component('TailwindPagination', TailwindPagination)
    .component('NotificationComponent', NotificationComponent)
    .component('MultiSelect', MultiSelect)

    .mount('#app');

AOS.init();




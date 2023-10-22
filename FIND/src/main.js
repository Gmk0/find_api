import { createApp, markRaw } from 'vue'
import './index.css';

import 'aos/dist/aos.css';
import AOS from 'aos';
import App from './App.vue';
import router from './router';
import { createPinia } from 'pinia';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';

import Dropdown from 'primevue/dropdown';

import InputText from 'primevue/inputtext';

import ServiceCard from './components/ServiceCard.vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { Collapse } from 'vue-collapsed';
import TextInput from './components/TextInput.vue';

const pinia = createPinia();

pinia.use(({ store }) => {
    store.router = markRaw(router)

});

const app = createApp(App);

app.use(pinia)
    .use(router)
    .use(VueSweetalert2)
    .use(PrimeVue)
    .use(ToastService)
    .component('Collapse', Collapse)
    .component('ServiceCard', ServiceCard)
    .component('Dropdown', Dropdown)
    .component('TextInput', TextInput)
    .component('InputText', InputText)
    .mount('#app');

AOS.init();





import { defineStore } from "pinia";

import axiosClient from "../axios";

export const useCategoryStore = defineStore(
    'categories', {
    state: () => ({
        categorieElement: null,
        authErrors: [],
        subCategoriesbyId: [],
        authStatus: null,
        OneService: [],
        tagsSearch: [],
        sameCategoryFetch: null,
        serviceBest: [],
        servicePopular: [],
    }),
    getters: {
        categories: (state) => state.categorieElement,
        subCategoriesbyCategory: (state) => state.subCategoriesbyId,
        service: (state) => state.OneService,
        tags: (state) => state.tagsSearch,
        sameCategory: (state) => state.sameCategoryFetch,
        serviceBestGet: (state) => state.serviceBest,
        servicePopularGet: (state) => state.servicePopular

    }, actions: {

        async getCategories() {

            const response = await axiosClient.get('/getAllCategories');
            this.categorieElement = response.data
        },

        async fetchSubcategories(id) {
            const response = await axiosClient.get(`/subcategories/${id}`);
            this.subCategoriesbyId = response.data;

        },
        async fetchServices(service) {

            try {
                const response = await axiosClient.get(`/oneService/${service}`);
                this.OneService = response.data.data;
                this.sameCategoryFetch = response.data.sameCategory;

            } catch (err) {
                if (err.response.status === 422) {
                    this.router.push('/');

                }
            }


        },
        async fetchTags(service) {

            try {
                const response = await axiosClient.get(`/getServices/${service}`);
                this.tagsSearch = response.data.tags;

            } catch (err) {
                console.error(err);
            }
        },
        async fetchTagsSubactegory(category) {
            try {
                const response = await axiosClient.get(`/getServicesBySub/${category}`);
                this.tagsSearch = response.data.tags;

            } catch (err) {
                console.error(err);
            }

        },
        async fetchServicesBest() {

            try {
                const response = await axiosClient.get(`/bestServices`);
                this.serviceBest = response.data.data;


            } catch (err) {
                if (err.response.status === 422) {


                }
            }

        },
        async fetchServicesPopulars() {

            try {
                const response = await axiosClient.get(`/popularServices`);
                this.servicePopular = response.data.data;


            } catch (err) {
                if (err.response.status === 422) {


                }
            }

        }
    }

});

export const useFreelanceStore = defineStore('freelance', {
    state: () => ({
        Allfreelance: [],
    }),
    getters: {
        freelances: (state) => state.Allfreelance
    },
    actions: {
        async getAllFreelances() {
            const response = await axiosClient.get('/getAllFreelance');
            this.Allfreelance = response.data;
        },
        async storeFreelance(data) {
            try {
                const response = await axiosClient.post('/storeFreelance', data);

                return Promise.resolve(response.data); // Renvoie la réponse de l'API
            } catch (err) {
                console.log(err.response.status);
                return Promise.reject(err); // Renvoie une promesse rejetée en cas d'erreur
            }


        }
    }

});

export const useAuthStore = defineStore(
    'auth', {
    state: () => ({
        authUser: null,
        authErrors: [],
        tokenAuth: sessionStorage.getItem('TOKEN'),
        authStatus: null,
        isLoandig :false,
            isFreelance :false,
    }),

    getters: {
        user: (state) => state.authUser,
        error: (state) => state.authErrors,
        status: (state) => state.authStatus,
        token: (state) => state.tokenAuth,
        loading: (state) => state.isLoandig,
        freelance:(state)=> state.isFreelance,


    },
    actions: {
        async getToken() {
            await axiosClient.get("/sanctum/csrf-cookie");

        },
        async getTokenElement(token) {

            this.tokenAuth = token;
            if (token) {
                sessionStorage.setItem('TOKEN', token);
            } else {
                sessionStorage.removeItem('TOKEN')
            }


        },
        async getUser() {
            //this.getToken();
            try{
                const response = await axiosClient.get('/getUser');
                this.authUser = response.data.data;
                this.isFreelance = response.data.data.isFreelance;

            }catch(e){
                this.tokenAuth=null;
            }


        },
        async handleSubmit(data) {
            this.authErrors = [];
            // this.getToken();
            try {

                this.isLoandig = true;

                const response = await axiosClient.post('/login', {
                    email: data.email,
                    password: data.password,
                });

                this.authUser = response.data.data;
                this.getTokenElement(response.data.token)
                this.isFreelance = response.data.data.isFreelance;

                this.isLoandig = false;

                this.router.push('/');


            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                    this.isLoandig = false;
                }
                this.isLoandig = false;

            }
        },
        async handleSubmitRegister(data) {

            this.authErrors = [];
            //this.getToken();
            this.isLoandig = true;

            try {
                const response = await axiosClient.post('/register', {
                    name: data.name,
                    phone: data.phone,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation
                });

                this.isLoandig = false;

                this.authUser = response.data.data;
                this.isFreelance = response.data.data.isFreelance;
                this.getTokenElement(response.data.token)
                this.router.push('/');

            } catch (error) {

                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
                this.isLoandig = false;


            }




        },
        async HandleLogout() {
            try {

                await axiosClient.post("/logout");
                this.authUser = null;
                this.getTokenElement(null);
                this.router.push('/');
            } catch (error) {
                console.log(error.response.status);
            };


        },
        async handleSubmitForgot(email) {

            try {
                const response = await axiosClient.post('/forgot-password', {
                    email: email
                });

                this.authStatus = response.data.status;


            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }

        },
        async handleResetPassword(resetData) {

            this.authErrors = [];

            try {
                await axiosClient.post('/reset-password', resetData);
                this.router.push('/');

            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }

        }

    },
    persist: true,

});



export const cartStore = defineStore('cart', {
    state: () => ({
        items: [],
        status: null,
        statusPayement: [],
        payementGetLink:'',
    }),
    getters: {
        totalItems: (state) => state.items.length,
        totalCost: (state) => {
            return state.items.reduce((total, item) => total + item.price * item.quantity, 0);
        },
        statusError: (state) => state.status,
        statusPayementGet: (state) => state.statusPayement,


    },
    actions: {
        async addItem(item) {
            // Vérifiez si l'article est déjà dans le panier
            const existingItem = this.items.find((i) => i.id === item.id);

            if (existingItem) {
                // Si l'article existe, mettez à jour la quantité
                existingItem.quantity += 1;
            } else {
                // Sinon, ajoutez l'article au panier
                this.items.push({ ...item, quantity: 1 });
            }
        },
        async removeItem(itemId) {
            const index = this.items.findIndex((item) => item.id === itemId);

            if (index !== -1) {
                this.items.splice(index, 1);
            }
        },
        async updateItemQuantity({ itemId, newQuantity }) {
            const item = this.items.find((i) => i.id === itemId);

            if (item) {
                item.quantity = newQuantity;
            }
        },
        async clearCart() {
            this.items = []; // Remise à zéro du tableau d'articles du panier
        },


        async checkoutMaxi(data) {
            this.status = [];
            // this.getToken();
            try {
                console.log(data);
                const response = await axiosClient.post('/checkout-maxi',{
                    name: data.name,
                    numero : data.numero,
                    items: this.items,
                    totalprice: this.totalCost
                });

                return  response.data;

                // this.router.push('/');
               // console.log(this.statusPayement);


            } catch (error) {
                if (error.response.status === 422) {

                    console.log(error.response.data.errors);
                }

            }

        },



        async handleMaxiStatus(data){
            this.status = [];
            // this.getToken();
            try {

                const response = await axiosClient.post('/checkout-maxi-status', {
                    status: data.status,
                    reference: data.reference,
                    method: data.reference, // Enlevez la virgule en trop ici
                });

                this.clearCart();
                return response.data;

                //console.log(response.data);
            } catch (error) {

                if (error.response && error.response.data && error.response.data.message) {
                    this.status = error.response.data;
                } else {
                    console.log("Une erreur inattendue s'est produite :", error);
                }
            }

        },

    },
    persist: true,
});


export const useLayoutStore = defineStore('userLayout',{
    state: ()=>({
        isDarkModeEnabled: false,
        isMonochromeModeEnabled: false,
        isSearchbarActive: false,
        isSidebarExpanded: false,
        isRightSidebarExpanded: false,
    }),
    getters:{
        SidebarExpanded: (state) => state.isRightSidebarExpanded,
    },

    actions: {
        toogleRight(){
            this.isRightSidebarExpanded = !this.isRightSidebarExpanded
        },
        ToogleFalse(){
            this.isRightSidebarExpanded =false

        },
        ToogleTrue() {
            this.isRightSidebarExpanded = true

        }
    }


})






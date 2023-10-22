
import { defineStore } from "pinia";

import axiosClient from "../axios";

export const useCategoryStore = defineStore(
    'categories', {
        state: () => ({
            categorieElement: null,
            authErrors: [],
            subCategoriesbyId: [],
            authStatus: null,
            OneService:[],
        }),
        getters: {
            categories: (state) => state.categorieElement,
            subCategoriesbyCategory: (state) => state.subCategoriesbyId,
            service: (state) => state.OneService

        },actions: {

            async getCategories(){

                const response = await axiosClient.get('/getAllCategories');
                this.categorieElement = response.data
            },

            async fetchSubcategories(id){
                const response = await axiosClient.get(`/subcategories/${id}`);
                this.subCategoriesbyId = response.data;

            },
            async fetchServices(service) {
                console.log(service)
                 const response = await axiosClient.get(`/oneService/${service}`);
                 this.OneService = response.data.data;

            }
        }

});

export const useFreelanceStore = defineStore('freelance',{
    state:()=>({
        Allfreelance :[],
    }),
    getters:{
        freelances: (state) => state.Allfreelance
    },
    actions: {
        async getAllFreelances(){
            const response = await axiosClient.get('/getAllFreelance');
            this.Allfreelance = response.data;
        },
        async storeFreelance(data){
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
    }),

    getters: {
        user: (state) => state.authUser,
        error: (state) => state.authErrors,
        status: (state) => state.authStatus,
        token: (state) => state.tokenAuth

    },
    actions: {
        async getToken() {
            await axiosClient.get("/sanctum/csrf-cookie");

        },
        async getTokenElement(token){

            this.tokenAuth = token;
            if (token) {
                sessionStorage.setItem('TOKEN', token);
            } else {
                sessionStorage.removeItem('TOKEN')
            }


        },
        async getUser() {
            //this.getToken();
            const response = await axiosClient.get('/getUser');
            this.authUser = response.data.data;

        },
        async handleSubmit(data) {
            this.authErrors = [];
           // this.getToken();
            try {
                const response = await axiosClient.post('/login', {
                    email: data.email,
                    password: data.password,
                });

                this.authUser =response.data.data;
                this.getTokenElement(response.data.token)

                this.router.push('/');


            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }

            }
        },
        async handleSubmitRegister(data) {

            this.authErrors = [];
            //this.getToken();

            try {
                const response = await axiosClient.post('/register', {
                    name: data.name,
                    phone:data.phone,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation
                });

                this.authUser = response.data.data;
                this.getTokenElement(response.data.token)
                this.router.push('/');

            } catch (error) {

                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }

            }




        },
        async HandleLogout() {
            try{

                await axiosClient.post("/logout");
               this.authUser = null;
                this.getTokenElement(null);
                this.router.push('/');
            }catch(error){
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
    }
});




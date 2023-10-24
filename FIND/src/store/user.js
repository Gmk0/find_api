import { defineStore } from "pinia";

import axiosClient from "../axios";

export const useTransactionStore = defineStore('transactionUser',{

    state: () => ({
        allTransaction:[],

    }),
    getters:{
        transactions: (state) => state.allTransaction,
    },
    actions:{

        async getAllTransaction() {
            try{
                const response = await axiosClient.get('/user/getUserTransaction')

                this.allTransaction = response.data

            }catch(e){

                console.log(e);
            }


        }

    }
})

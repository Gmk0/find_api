
<script setup>

import { useTransactionStore } from '../../../store/user';

import {ref, onMounted, computed } from 'vue';


import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';

import Paginator from 'primevue/paginator';


const transactions = computed(()=> transactionStore.transactions.data)

const transactionStore = useTransactionStore();

onMounted(async()=>{

    await transactionStore.getAllTransaction();


});



</script>

<template>
    <div>
{{ transactions }}




        <div class="card">
            <DataTable  paginator :rows="2" :rowsPerPageOptions="[2, 10, 20, 50]" :value="transactions" tableStyle="min-width: 50rem"
             >
        <template #header>
            <div class="flex justify-content-end">
                <span class="p-input-icon-left">
                    <i class="pi pi-search" />

                </span>
            </div>
        </template>
        <template #empty> No customers found. </template>
        <template #loading> Loading customers data. Please wait. </template>

                <Column sortable  field="transaction_numero" header="transaction_numero"></Column>
                <Column field="payment_token" header="payment_token"></Column>
                <Column field="payment_method" header="payment_method"></Column>
                   <Column field="amount" header="amount"></Column>

            </DataTable>
        </div>
    </div>
</template>


<style lang="scss" scoped></style>

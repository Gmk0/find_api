
<script setup>

import { useTransactionStore } from '../../../store/user';

import {ref, onMounted } from 'vue';


const transactionStore = useTransactionStore();

onMounted(async()=>{

    await transactionStore.getAllTransaction();


});



</script>

<template>
    <div>

        {{ transactionStore.transactions.data }}
    </div>
</template>


<style lang="scss" scoped></style>

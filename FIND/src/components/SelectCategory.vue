<template>
    <select v-model="selectedCategory">
        <option value="">{{ placeholder }}</option>
        <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
        </option>
    </select>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    props: {
        placeholder: {
            type: String,
            default: 'Sélectionnez une catégorie'
        }
    },
    data() {
        return {
            categories: [],
            selectedCategory: ''
        };
    },
    mounted() {
        this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
            try {
                const response = await axios.get('/api/fetchAll');
                this.categories = response.data.categories;
            } catch (error) {
                console.error('Erreur lors de la récupération des catégories:', error);
            }
        }
    },
    watch: {
        selectedCategory(newValue) {
            this.$emit('input', newValue);
        }
    }
};
</script>

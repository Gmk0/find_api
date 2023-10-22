<script setup>
import WebLayout from '../../../Layouts/WebLayout.vue';

//import { useStore } from '@/store'; // Assurez-vous d'ajuster le chemin d'importation
import { onMounted, inject, computed, ref, watch } from 'vue';
import SectionBorder from '../../../Components/SectionBorder.vue';
import TextInput from '../../../Components/TextInput.vue';

import { useCategoryStore, useAuthStore,useFreelanceStore } from '../../../store';

import InputError from '../../../Components/InputError.vue';
import InputLabel from '../../../Components/InputLabel.vue';
import PrimaryButton from '../../../Components/PrimaryButton.vue';
import SecondaryButton from '../../../Components/SecondaryButton.vue';
import  axiosClient  from '../../../axios';
import axios from 'axios';

import InputNumber from 'primevue/inputnumber';


const useCategory= useCategoryStore();
const useAuth = useAuthStore();
const useFreelance =useFreelanceStore();

const categories = computed(() => useCategory.categories);
const swal = inject('$swal')



const step = ref(1);

const image = ref(null);

const photoPreview = ref(null);
const photoInput = ref(null);
const selectNewPhoto = () => {
    photoInput.value.click();
};
const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);


     image.photo = photoInput.value.files[0];
     image.post(route('updateProfileUser'), {
        onSuccess: () => {
            console.log('La requête a réussi.');
            // Ajoutez ici le code que vous souhaitez exécuter en cas de succès
        },
        onError: (errors) => {
            console.log('La requête a échoué avec des erreurs :', errors);
            // Ajoutez ici le code que vous souhaitez exécuter en cas d'échec
        },

    });


};

 const experienceAnnee = ref([
    { name: '0 a 2 ans', id: '0-2 ans' },
    { name: '2 a 5 ans', id: '2-5 ans' },
     { name: '+ 7 ans', id: '+ 7 ans' },
]);

const subcategories = ref([]);
const selectedCategoryId = ref(null);
const selectedSubcategoryId = ref(null);

const freelanceElement = ref({
    nom: '',
    prenom: '',
    email: useAuth.user?.email,
    taux: '',
    portfolio: '',
    description : '',
    experience:''
});

const localisation = ref({
    addresse: '',
    commune: '',
    ville: '',
});

const experience = ref([]);
const selectedExperiment = ref({
    title: '',
    level: '',
});

const education = ref([]);
const selectedEducation = ref({
    diplome: '',
    universite: '',
    annee: '',
});

const langue = ref([]);
const selectedLangue = ref({
    langue: '',
    level: '',
});
const certification = ref([]);
const selectedCertificat = ref({
    certifier: '',
    delivrer: '',
    annee: '',
});
const comptes = ref([]);
const selectedComptes = ref({
    compte: '',
    lien: '',
});

const error = ref({
    experience: '',
    education: '',
    certification: '',
    langue: '',
    compte: '',
    description :''
});

const addEducation = () => {

    if (!selectedEducation.value.diplome || !selectedEducation.value.universite || !selectedEducation.value.annee) {
        error.value.education = 'les deux element sont requis.';


        return;
    }
    education.value.push({
        diplome: selectedEducation.value.diplome,
        universite: selectedEducation.value.universite,
        annee: selectedEducation.value.annee,
    });

    selectedEducation.value.diplome = '';
    selectedEducation.value.universite = '';
    selectedEducation.value.annee = '';
     error.value.education=''

};

const addExperience = () => {
    if (!selectedExperiment.value.title || !selectedExperiment.value.level) {

         error.value.experience = 'les deux element sont requis.';
        return;
    }
    experience.value.push({
        title: selectedExperiment.value.title,
        level: selectedExperiment.value.level,
    });
    selectedExperiment.value.title = '';
    selectedExperiment.value.level = '';
    error.value.experience = '';
};

const addCertification = () => {

    if (!selectedCertificat.value.certifier || !selectedCertificat.value.delivrer || !selectedCertificat.value.annee) {
        error.value.certification = 'les deux element sont requis.';

        return;
    }
    certification.value.push({
        certifier: selectedCertificat.value.certifier,
        delivrer: selectedCertificat.value.delivrer,
        annee: selectedCertificat.value.annee,
    });

    selectedCertificat.value.certifier = '';
    selectedCertificat.value.delivrer = '';
    selectedCertificat.value.annee = '';
    error.value.certification = '';


};
const addLangue = () => {

    if (!selectedLangue.value.langue || !selectedLangue.value.level) {
        error.value.langue = 'les deux element sont requis.';
        return;
    }
    langue.value.push({
        langue: selectedLangue.value.langue,
        level: selectedLangue.value.level,

    });
    selectedLangue.value.langue = '';
    selectedLangue.value.level = '';
    error.value.langue = '';

};

const addComptes = () => {

    if (!selectedComptes.value.lien || !selectedComptes.value.compte) {
        error.value.compte = 'les deux element sont requis.';
        return;
    }
    comptes.value.push({
        compte: selectedComptes.value.compte,
        lien: selectedComptes.value.lien,

    });
    selectedComptes.value.compte = '';
    selectedComptes.value.lien = '';
    error.value.compte = '';

};




const removeElement = (index, element) => {
    if (element === 'experience') {
        experience.value.splice(index, 1);
        //error.experience.value = null;
    } else if (element === 'education') {
        education.value.splice(index, 1);
       // error.education.value = null;
    } else if (element === 'langue') {
        langue.value.splice(index, 1);

       // error.langue.value = null;
    } else if (element === 'certification') {
        certification.value.splice(index, 1);
        //error.certification.value = null;
    } else if (element === 'compte') {
        comptes.value.splice(index, 1);
        //error.compte.value = null;
    }
};

const removeError=()=>{
    error.value.experience = "";
    error.value.education = "";
    error.value.certification = "";
      error.value.langue= '';
        error.value.compte= '';
}



const isSectionValid = (step) => {
    if (step === 1) {

        addExperience();
        removeError();


        if (!localisation.value.addresse|| !selectedCategoryId.value || !freelanceElement.value.taux || !selectedCategoryId.value
        || !selectedSubcategoryId.value || !freelanceElement.value.experience
        || !localisation.value.commune || !localisation.value.ville || !experience.value) {
            swal('Veuillez remplir tous les champs de la premiere section.');
            return false;
        }
    } else if (step === 2) {

         addLangue();
           removeError();

           if(!freelanceElement.value.description.length > 150)
           {
            error.value.description="la description doit au moins deppaser 150 Caractere"
            return false;
           }

        if (!freelanceElement.value.nom||!freelanceElement.value.prenom|| !langue.value ||!freelanceElement.value.description) {

           swal('Veuillez remplir tous les champs de la deuxieme section.');
            return false;
        }
    }else if(step === 3) {
        addEducation();
        addCertification();
          removeError();

        if(!education.value || !certification.value){
            swal('Veuillez remplir tous les champs de la troisieme section.');
            return false;
        }
    }

    return true;
};

const increaseStep = () => {
    if (!isSectionValid(step.value)) {
        return; // Arrêtez si la validation échoue
    }

    if (step.value < 5) {
        step.value += 1;

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
};

const languagesArray=ref([]);

function getWorldLanguages() {
    // Effectuer la requête GET vers l'API restcountries
    return axios.get('https://restcountries.com/v3/all')
        .then(response => {
            const data = response.data;

            // Créez un ensemble pour stocker les langues uniques
            const uniqueLanguages = new Set();

            // Parcourez la liste des pays et ajoutez leurs langues à l'ensemble
            data.forEach(country => {
                if (country.languages) {
                    // Les langues sont maintenant un objet, pas un tableau
                    const languages = Object.values(country.languages);
                    languages.forEach(language => {
                        uniqueLanguages.add(language);
                    });
                }
            });

            // Transformez l'ensemble en un tableau et renvoyez-le
             languagesArray.value = Array.from(uniqueLanguages);

             console.log(languagesArray.value);
            //return languagesArray;
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des langues', error);
            languagesArray.value=[];
        });
}







onMounted(()=>{

    getWorldLanguages();
});


const isLoadingSubcategorie = ref(false);



const fetchSubcategories = async () => {
    try {
        if (selectedCategoryId.value) {
            const response = await axiosClient.get(`/subcategories/${selectedCategoryId.value}`);
            subcategories.value = response.data.subcategories;
            isLoadingSubcategorie.value = true;
        } else {
            subcategories.value = [];
        }
    } catch (error) {
        console.error('An error occurred while fetching subcategories:', error);
    }
};

watch(selectedCategoryId, () => {
    fetchSubcategories();
    //alert('OK');
});


const register =()=>{

    if (!freelanceElement.value.email || !freelanceElement.value.numero) {
        swal('Veuillez remplir tous les champs de la 5 em section.');
        return false;
    }

    const data =ref({
        nom : freelanceElement.value.nom,
        prenom : freelanceElement.value.prenom,
        description : freelanceElement.value.description,
        langue : langue.value,
        diplome : education.value,
        certificat : certification.value,
        site : freelanceElement.value.nom,
        experience : freelanceElement.value.experience,
        competences :experience.value,
        taux_journalier : freelanceElement.value.taux,
        comptes : comptes.value,
        sub_categorie : selectedSubcategoryId.value,
        localisation : localisation.value,
        category_id : selectedCategoryId.value,
        level : 1,
    });

    useFreelance.storeFreelance(data.value);
}

const postData = async () => {
    try {
        const response = await axios.post(route('register.freelance'), data);
        console.log('Réponse du serveur:', response.data);
    } catch (error) {
        console.error('Erreur lors de la requête POST:', error);
    }
};

const postDataRouter = (data) => {
    router.post(route('register.freelance'), data, {
        onSuccess: () => {
            console.log('La requête a réussi.');
            // Ajoutez ici le code que vous souhaitez exécuter en cas de succès
        },
        onError: (errors) => {
            console.log('La requête a échoué avec des erreurs :', errors);
            // Ajoutez ici le code que vous souhaitez exécuter en cas d'échec
        },
        onFinish: () => {
            console.log('La requête a terminé, que ce soit en succès ou en erreur.');
            // Ajoutez ici le code que vous souhaitez exécuter à la fin de la requête, qu'elle ait réussi ou échoué
        },
    });
};


const levelSelector=ref([
    { name: 'Debutant', id: 'Debutant' },
    { name: 'intermediare', id: 'intermediare' },
    { name: 'Expert', id: 'Expert' },
])


defineOptions({
    layout: WebLayout,

});



</script>

<template>

<WebLayout>
        <div class="relative min-h-screen pt-16 text-gray-700 border-t border-gray-100">
        <div>
            <header class="bg-white top-0 lg:relative sticky lg:z-0 z-[60] shadow dark:bg-gray-800">
                <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex flex-col justify-between md:flex-row md:items-center">
                        <ul class="items-center justify-around hidden gap-6 lg:flex">
                            <li :class="step === 1 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                                <span :class="step === 1 ? 'bg-amber-600 text-white ' : ''"
                                    class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">

                                    1
                                </span>
                                <span>Compentences
                                </span>

                            </li>
                            <li :class="step === 2 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                                <span :class="step === 2 ? 'bg-amber-600 text-white ' : ''"
                                    class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">2
                                </span>
                                <span>Information personnelles
                                </span>

                            </li>
                            <li :class="step === 3 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                                <span :class="step === 3 ? 'bg-amber-600 text-white ' : ''"
                                    class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">3
                                </span>
                                <span>Formations
                                </span>

                            </li>
                            <li :class="step === 4 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                                <span :class="step === 4 ? 'bg-amber-600 text-white ' : ''"
                                    class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">4
                                </span>
                                <span>Comptes lié
                                </span>

                            </li>
                            <li @click="step = 5" :class="step === 5 ? 'text-amber-600 ' : ''"
                                class="flex px-1 cursor-pointer ">

                                <span :class="step === 5 ? 'bg-amber-600 text-white ' : ''"
                                    class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">4
                                </span>
                                <span>Sécurite du compte
                                </span>

                            </li>
                        </ul>



                        <div class="block mb-2 rounded-lg dark:bg-gray-800 dark:p-3 lg:hidden">
                            <div class="mb-1 text-xs font-bold leading-tight tracking-wide uppercase text-dark"
                                v-text="`Etape: ${step} of 5`"></div>

                            <div class="flex-1">
                                <div v-show="step === 1">
                                    <div class="text-lg font-bold leading-tight text-dark">Compentences
                                    </div>
                                </div>
                                <div v-show="step === 2">
                                    <div class="text-lg font-bold leading-tight text-dark">Informations Personnelles
                                    </div>
                                </div>
                                <div v-show="step === 3">
                                    <div class="text-lg font-bold leading-tight text-dark">Formations</div>
                                </div>

                                <div v-show="step === 4">
                                    <div class="text-lg font-bold leading-tight text-dark">Comptes lies</div>
                                </div>

                                <div v-show="step === 5">
                                    <div class="text-lg font-bold leading-tight text-dark">Securite Du compte
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="items-center w-full md:w-64">
                            <div class="w-full mr-2 bg-gray-100 rounded-full dark:bg-gray-800">
                                <div class="h-2 text-xs leading-none text-center text-white bg-green-500 rounded-full"
                                    :style="'width: ' + parseInt(step / 5 * 100) + '%'"></div>
                            </div>
                            <div class="w-10 text-xs text-dark" v-text="parseInt(step / 5* 100) +'%'">
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="mt-8">
                <div class="px-6" v-show="step === 1">
                    <div class="mb-4 lg:grid lg:grid-cols-3 lg:gap-6">
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                    VOS COMPTENCES
                                </h3>

                                <p class="mt-1 text-gray-600 text-md dark:text-gray-100">
                                Parlez nous un peu de vous. Ces informations apparaîtront sur votre profil
                                                                        public, afin que les acheteurs potentiels
                                                                        puissent mieux vous connaître.'
                                </p>
                            </div>
                        </div>

                    </div>
                    <SectionBorder />

                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Categorie
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Commencez par nous dire dans quel categorie vous vous situer
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white rounded-lg shadow dark:bg-gray-800 dark:border dark:border-gray-200 sm:p-6 ">
                                    <div class="gap-6 md:grid md:grid-cols-1 md:mb-2">
                                        <div class="gap-6 md:grid ">
                                             <div class="flex card justify-content-center">
                                                <Dropdown v-model="selectedCategoryId" :options="categories" optionValue="id" optionLabel="name" placeholder="Votre categorie" showClear  class="w-full md:w-12rem" />
                                            </div>


                                        </div>

                                        <div v-if="subcategories.length" class="grid grid-cols-2 gap-4 mt-4 mb-6">

                                                <div class="flex justify-content-center">
                                                    <Dropdown v-model="selectedSubcategoryId" :options="subcategories" optionValue="id" optionLabel="name" showClear  placeholder="Sous categorie" class="w-full md:w-10rem" />
                                                </div>

                                                <div class="flex justify-content-center">
                                                        <Dropdown v-model="freelanceElement.experience" :options="experienceAnnee" showClear  optionValue="id" optionLabel="name" placeholder="Experience" class="w-full md:w-10rem" />
                                                 </div>


                                        </div>




                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <SectionBorder />
                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                     Compentences
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                Énumérez les compétences liées aux services que vous offrez et ajoutez votre
                                                                        niveau
                                                                        d'expérience.
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white rounded-lg shadow dark:bg-gray-800 dark:border dark:border-gray-200 sm:p-6 ">
                                    <div class="">
                                        <div>
                                            <p class="mb-2 text-lg font-bold">Commpetences :</p>
                                           <ul class="mb-4 text-gray-700">
                                                <li v-for="(exp, index) in experience" :key="index" class="flex gap-2 px-2">
                                                    <span>{{ exp.title }} - {{ exp.level }}</span>


                                                    <button @click="removeElement(index, 'experience')" class="btn btn-sm btn-circle btn-outline">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                    </button>

                                                </li>
                                         </ul>
                                        </div>


                                        <div class="grid grid-cols-3 gap-2 mb-4">
                                            <div>
                                                <InputText
                                                size="large"
                                                 class="block w-full "
                                                 v-model="selectedExperiment.title"

                                                />

                                            </div>


                                                <Dropdown
                                                v-model="selectedExperiment.level"
                                                :options="levelSelector"

                                                 size="small"
                                                optionValue="id" optionLabel="name"
                                                 placeholder="Experience"
                                                class="w-full md:w-8rem" />



                                            <div>
                                                <button @click="addExperience" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                    Ajouter
                                                </button>
                                            </div>
                                        </div>

                                         <div v-if="error.experience" class="text-sm text-red-600">{{ error.experience}}</div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Prix  -->
                   <SectionBorder />
                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre taux Journalier
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Indiquez Votre taux journalier moyen , sachant qu'une journee represente
                                                                        environ 8 heures de travail
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white rounded-lg shadow dark:bg-gray-800 dark:border dark:border-gray-200 sm:p-6">



                                           <InputNumber v-model="freelanceElement.taux"
                                           placeholder="Taux"
                                           inputId="locale-us"
                                           locale="en-US"
                                           :minFractionDigits="2" />



                                </div>
                            </div>
                        </div>

                    </div>



                    <!-- Localisation  -->
                    <SectionBorder />
                    <div class='md:grid md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Localisation
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Ou travaillez-vous le plus souvent.
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white rounded-lg shadow dark:bg-gray-800 dark:border dark:border-gray-200 sm:p-6 ">
                                    <div class="grid gap-2 md:grid-cols-3">


                                            <TextInput
                                            class="block w-full"
                                            placeholder="Adresse"
                                             v-model="localisation.addresse" />

                                             <TextInput
                                            class="block w-full"
                                             placeholder="ville"
                                             v-model="localisation.ville" />

                                           <TextInput
                                           placeholder="Commune"
                                            class="block w-full"
                                           v-model="localisation.commune" />

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="flex justify-between md:col-span-1">

                            </div>
                            <div class="mt-2 md:mt-4 md:col-span-2">

                            </div>

                        </div>

                    </div>

                </div>


                <div class="px-6 " v-show="step === 2">
                    <div class="mb-4 lg:grid lg:grid-cols-3 md:gap-6">
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                INFORMATIONNS PERSONNELLES
                                </h3>

                                <p class="mt-1 text-gray-600 text-md dark:text-gray-100">
                                    Parlez nous un peu de vous. Ces informations apparaîtront sur votre
                                                                        profil
                                                                        public, afin que les acheteurs potentiels
                                                                        puissent mieux vous connaître.
                                </p>
                            </div>
                        </div>

                    </div>
                    <SectionBorder />
                    <div class='md:grid md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Nom & Prenom'
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Prive*
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div class="grid gap-6 md:grid-cols-2 md:mb-2">






                                            <TextInput class="block w-full"
                                            placeholder="Nom"
                                                v-model="freelanceElement.nom"
                                            />


                                            <TextInput class="block w-full"
                                                placeholder="Prenom"
                                                    v-model="freelanceElement.prenom"
                                                />







                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                    <SectionBorder />
                    <div class='mt-4 md:grid md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Photo de Profile <span class="text-red-600">*</span>
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Ajoutez une photo de profil de vous-même afin que les clients sachent
                                                                        exactement
                                                                        avec qui ils travailleront.'
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form>
                                <div class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div class="gap-6 md:grid">

                                            <div  class="col-span-6">
                    <!-- Profile Photo File Input -->
                                        <input
                                            ref="photoInput"
                                            type="file"
                                            class="hidden"
                                            @change="updatePhotoPreview"
                                        >

                                     <InputLabel for="photo" value="Photo" />

                    <!-- Current Profile Photo -->


                    <!-- New Profile Photo Preview -->
                                    <div v-show="photoPreview" class="mt-2">
                                        <span
                                            class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                                            :style="'background-image: url(\'' + photoPreview + '\');'"
                                        />
                                    </div>

                            <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                Select A New Photo
                            </SecondaryButton>



                                 <InputError  class="mt-2" />
                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <SectionBorder />
                    <div class='mt-4 md:grid md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    description
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Partagez un peu votre experience de travail; les projets interessant
                                                                        que vous
                                                                        avez realiser et votre Domaine d'expertise
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                    <div>


                                     <textarea
                                     v-model="freelanceElement.description"
                                     id="message"
                                     rows="4"

                                     class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Description">
                                    </textarea>
                                    <div class="flex justify-between">
                                        <span>{{error.description}}</span>
                                        <span> {{  freelanceElement.description.length}} /6000</span>


                                    </div>
                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>

                    <SectionBorder />
                    <div class='md:grid md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Langue parler
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Sélectionnez les langues dans lesquelles vous pouvez communiquer et
                                                                        votre
                                                                        niveau
                                                                        de compétence
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div class="">
                                            <div>
                                                <p class="mb-2 text-lg font-bold">langues :</p>
                                               <ul class="mb-4">
                                                    <li v-for="(educ, index) in langue " :key="index" class="flex gap-2 px-2">
                                                        <span>{{ educ.langue }} - {{ educ.level }}</span>


                                                        <button @click="removeElement(index, 'langue')" class="btn btn-sm btn-circle btn-outline">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </button>

                                                    </li>
                                             </ul>
                                            </div>


                                            <div class="grid grid-cols-3 gap-2 mb-4">
                                                <div>
                                                    <TextInput
                                                     class="block w-full"
                                                     v-model="selectedLangue.langue"

                                                    />

                                                </div>

                                                <div>
                                                     <TextInput
                                                        class="block w-full"
                                                        v-model="selectedLangue.level"
                                                         />

                                                </div>
                                                <div>
                                                    <button @click="addLangue" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Ajouter
                                                    </button>
                                                </div>
                                            </div>

                                             <div v-if="error.langue" class="text-sm text-red-600">{{ error.langue }}</div>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                 <div class="px-6" v-show="step === 3">
                    <!-- Education -->
                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Education <span class="text-sm italic"> (facultatif)</span>
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Ajoutez tous les détails de formation pertinents qui aideront les
                                                                        clients à
                                                                        mieux
                                                                        vous
                                                                        connaître.
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div>
                                        <div v-show="education.length" class="flex flex-col mb-2">

                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                                    <div
                                                        class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50 dark:bg-gray-900">
                                                                <tr>
                                                                    <th scope="col"
                                                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                        Diplomee En
                                                                    </th>
                                                                    <th scope="col"
                                                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                        Universite
                                                                    </th>
                                                                    <th scope="col"
                                                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                        Annee
                                                                    </th>
                                                                    <th scope="col" class="relative px-6 py-3">


                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">



                                                                <tr v-for="(educ , index) in education">
                                                                    <td class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ educ.diplome }}
                                                                    </td>
                                                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                           {{ educ.universite }}
                                                                    </td>
                                                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                          {{ educ.annee }}

                                                                    </td>

                                                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">


                                                                         <button @click="removeElement(index, 'education')" class="btn btn-sm btn-circle btn-outline">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                                         </button>



                                                                    </td>
                                                                </tr>






                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid gap-4 mt-4 md:grid-cols-3 md:mb-2">
                                            <div>
                                                 <TextInput
                                                 placeholder="Diplomer en"
                                                 class="block w-full"
                                                 v-model="selectedEducation.diplome"/>

                                            </div>
                                            <div>
                                                <TextInput
                                                placeholder="Etablissement"
                                                class="block w-full"
                                                v-model="selectedEducation.universite"/>


                                            </div>

                                            <div class="flex gap-2">

                                                <div>
                                                        <TextInput
                                                        placeholder="annee"
                                                         class="block w-full"
                                                           v-model="selectedEducation.annee"/>
                                                </div>


                                                     <button @click="addEducation" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Ajouter
                                                    </button>



                                            </div>


                                        </div>
                                           <div v-if="error.education" class="text-red-600">{{ error.education }}</div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <SectionBorder />


                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Certification<span class="text-sm italic"> (facultatif)</span>
                                </h3>

                                <p class="text-sm italic text-slate-800">facultatif</p>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Ajoutez tous les détails de certification pertinents qui aideront les
                                                                        clients
                                                                        à
                                                                        mieux
                                                                        vous
                                                                        connaître.
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div>
                                        <div v-show="certification.length" class="flex flex-col mb-2">

                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                                    <div
                                                        class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                                <tr>
                                                                    <th scope="col"
                                                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                                                        Certificat
                                                                    </th>
                                                                    <th scope="col"
                                                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                                                        Delivrer par
                                                                    </th>
                                                                    <th scope="col"
                                                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                                                        Annee
                                                                    </th>
                                                                    <th scope="col" class="relative px-6 py-3">


                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="bg-white divide-y divide-gray-200">



                                                                <tr v-for="(certif , index) in certification">
                                                                    <td
                                                                        class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                        {{ certif.certifier }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                            {{ certif.delivrer }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200whitespace-nowrap">
                                                                        {{ certif.annee }}
                                                                    </td>

                                                                    <td
                                                                        class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                                                               <button @click="removeElement(index, 'certification')" class="btn btn-sm btn-circle btn-outline">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                                             </button>


                                                                    </td>
                                                                </tr>





                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid gap-4 mt-4 md:grid-cols-3 md:mb-2">
                                            <div>
                                                <TextInput
                                                class="block w-full"
                                                placeholder="Certifier en"
                                                v-model="selectedCertificat.certifier"/>

                                            </div>
                                            <div>
                                                 <TextInput
                                                class="block w-full"
                                                placeholder="Delivrer par"
                                                v-model="selectedCertificat.delivrer"/>

                                            </div>




                                                <div class="flex gap-2">
                                                     <div>
                                                          <TextInput
                                                          class="block w-full"
                                                          v-model="selectedCertificat.annee"/>
                                                     </div>

                                                         <button @click="addCertification" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            Ajouter
                                                        </button>



                                                </div>





                                        </div>

                                        <div v-if="error.certification" class="text-red-600">{{error.certification }}</div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <SectionBorder />

                    Personnal website>

                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Sites Web <span class="text-sm italic"> (facultatif)</span>
                                </h3>



                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Incluez un lien vers votre site Web personnel ou votre
                                                                        portfolio avec vos
                                                                        échantillons de
                                                                        travail.
                                </p>
                            </div>


                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div class="grid md:mb-2">




                                        <TextInput />

                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <SectionBorder />




                </div>
                  <div class="px-6 mx-auto my-auto" v-show="step === 4">

                    <div class='mb-4 lg:grid lg:mb-0 lg:grid-cols-3 lg:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                    Comptes Lies
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Prendre le temps de vérifier et de lier vos comptes peut
                                                                        améliorer votre
                                                                        crédibilité
                                                                        et
                                                                        nous aider à vous offrir plus
                                                                        d'affaires. Ne vous inquiétez pas, vos informations sont et
                                                                        resteront toujours
                                                                        privées.."

                                </p>
                            </div>


                        </div>


                    </div>
                    <SectionBorder />

                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Presence Sociale
                                </h3>

                                <p class="mt-1 text-sm text-gray-600">
                                    ""
                                </p>
                            </div>


                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-2 gap-4">
                                <label for="google">Google</label>





                                <button type="button" outlined>
                                    connecter
                                </button>









                            </div>

                        </div>


                    </div>

                    <SectionBorder />

                    <div class='mb-4 lg:grid lg:mb-0 lg:grid-cols-3 lg:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Presence Professionnelle
                                </h3>

                                <p class="mt-1 text-sm text-gray-600">
                                    ""
                                </p>
                            </div>


                        </div>


                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div>
                                <div
                                    class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                    <div class="">


                                        <div>
                                            <p class="mb-2 text-lg font-bold">Commptes lies :</p>
                                            <ul class="mb-4">

                                                <li v-for="(copt , index) in comptes" class="items-center gap-2 ">
                                                    <span class="flex flex-wrap mr-1">
                                                        {{ copt.compte}} {{ copt.lien }}
                                                    </span>

                                                    <button @click="removeElement(index, 'compte')" class="btn btn-sm btn-circle btn-outline">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                        </button>




                                                </li>

                                            </ul>
                                        </div>


                                        <div class="grid grid-cols-3 gap-2 mb-4">
                                                <div>
                                                    <TextInput
                                                     class="block w-full"
                                                     v-model="selectedComptes.compte"

                                                    />

                                                </div>

                                                <div>
                                                     <TextInput
                                                        class="block w-full"
                                                        v-model="selectedComptes.lien"
                                                         />

                                                </div>
                                                <div>
                                                    <button @click="addComptes" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Ajouter
                                                    </button>
                                                </div>
                                            </div>

                                             <div v-if="error.compte" class="text-sm text-red-600">{{ error.compte }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>

                <div class="px-6" v-show="step === 5">

                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                    Securite Du Compte
                                </h3>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    La confiance et la sécurité sont importantes dans notre
                                                                        communauté.Veuillez
                                                                        vérifier
                                                                        votre adresse e - mail et votre
                                                                        numéro de téléphone afin que nous puissions sécuriser votre
                                                                        compte.
                                </p>
                            </div>


                        </div>


                    </div>
                    <SectionBorder />

                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Email
                                </h3>

                                <p class="mt-1 text-sm text-gray-600">
                                    ""
                                </p>
                            </div>


                        </div>
                        <div  class="mt-5 md:mt-0 md:col-span-2">

                            <div class="grid gap-4 mb-4 md:grid-cols-2">


                                <div>
                                    <TextInput
                                    v-model="freelanceElement.email"
                                     />

                                </div>



                                <div>
                                    <button>Add</button>
                                </div>

                                <div class="italic text-gray-600">Email verifier</div>







                            </div>




                        </div>


                    </div>
                    <SectionBorder />

                    <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                        <div class="flex justify-between md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Votre Numero
                                </h3>

                                <p class="mt-1 text-sm text-gray-600">
                                    ""
                                </p>
                            </div>


                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">




                            <div class="grid gap-4 md:grid-cols-2">


                                <TextInput
                                v-model="freelanceElement.numero"

                                />



                                <div>

                                    <p class="hidden text-sm italic text-red-600">fonctionalites no disponible</p>
                                </div>


                            </div>


                        </div>


                    </div>

                </div>



            </div>

             <div class="flex justify-between p-3 mt-auto">
                <div class="w-1/2">

                    <button v-show="step > 1" @click="step--"
                        class="middle none center rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        data-ripple-light="true">
                        Retour
                    </button>
                </div>
                <div class="w-1/2 text-right">

                    <button v-show="step < 5" @click="increaseStep"
                        class="middle none center rounded-lg bg-amber-600 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-orange-500/20 transition-all hover:shadow-lg hover:shadow-orange-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        data-ripple-light="true">
                        Continuer
                    </button>

                    <button v-show="step == 5" @click="register()"
                        class="middle none center rounded-lg bg-green-600 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        data-ripple-light="true">
                        S'inscrire
                    </button>





                </div>
            </div>



        </div>



    </div>


</WebLayout>
</template>







<style lang="scss" scoped></style>

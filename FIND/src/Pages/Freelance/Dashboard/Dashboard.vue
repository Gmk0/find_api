<template>
    <div class="w-full min-h-screen bg-red-200">

        <Popper :placement="'left'">

            <button>clivk</button>

            <template #content="props">
                <div>
                    <div class="fixed">
                        <div
                            class="w-64 bg-white border rounded-lg popper-box border-slate-150 shadow-soft dark:border-navy-600 dark:bg-navy-700">
                            <div class="flex items-center px-4 py-5 space-x-4 rounded-t-lg bg-slate-100 dark:bg-navy-800">
                                <div class="avatar h-14 w-14">
                                    <img class="object-cover rounded-full" src="" alt="">
                                </div>
                                <div>
                                    <a href="#"
                                        class="text-base font-medium text-slate-700 hover:text-amber-600 focus:text-amber-600 dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">

                                    </a>
                                    <p class="text-xs text-slate-400 dark:text-navy-300">

                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col pt-2 pb-5">
                                <a href="{{route('freelance.profile')}}"
                                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                                    <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg bg-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <h2
                                            class="font-medium transition-colors text-slate-700 group-hover:text-amber-600 group-focus:text-amber-600 dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                                            Profile
                                        </h2>
                                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                            Paramètre de votre profil
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('freelance.messages')}}"
                                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                                    <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg bg-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <h2
                                            class="font-medium transition-colors text-slate-700 group-hover:text-amber-600 group-focus:text-amber-600 dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                                            Messages
                                        </h2>
                                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                            Vos messages
                                        </div>
                                    </div>
                                </a>

                                <a href="#"
                                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                                    <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg bg-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <h2
                                            class="font-medium transition-colors text-slate-700 group-hover:text-amber-600 group-focus:text-amber-600 dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                                            Activité
                                        </h2>
                                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                            Votre activité et événements
                                        </div>
                                    </div>
                                </a>
                                <a href="{{route('freelance.profile')}}"
                                    class="flex items-center px-4 py-2 space-x-3 tracking-wide transition-all outline-none group hover:bg-slate-100 focus:bg-slate-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600">
                                    <div class="flex items-center justify-center w-8 h-8 text-white rounded-lg bg-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>

                                    <div>
                                        <h2
                                            class="font-medium transition-colors text-slate-700 group-hover:text-amber-600 group-focus:text-amber-600 dark:text-navy-100 dark:group-hover:text-accent-light dark:group-focus:text-accent-light">
                                            Paramètres
                                        </h2>
                                        <div class="text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                            Paramètres de l'application Web
                                        </div>
                                    </div>
                                </a>
                                <div class="px-4 mt-3">
                                    <form method="POST" action="{{ route('logout')}}">

                                        <button type="submit"
                                            class="w-full space-x-2 text-white btn h-9 bg-amber-600 hover:bg-amber-600-focus focus:bg-amber-600-focus active:bg-amber-600-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Deconnexion</span>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

        </Popper>

    </div>
</template>

<script setup>

</script>


<style lang="scss" scoped></style>

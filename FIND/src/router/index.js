import { createRouter, createWebHistory } from "vue-router";

import { useAuthStore } from "../store/index.js";

import Home from "../Pages/Web/Home.vue";
import Login from "../Pages/Auth/Login.vue";
import Register from "../Pages/Auth/Register.vue";


const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/login',
     name: 'login',
      component: Login ,
        meta: {
            requiresGuest: true
        }
    },
    { path: '/register',
    name :'register',
    component: Register,
    meta: {
            requiresGuest: true
        }
     },
    {
        path: "/find-freelance",
        name: "FindFreelance",
        component: () => import("../Pages/Web/Freelance/FindFreelance.vue")
    },
    {
        path: "/registration",
        name: "registration",
        component: () => import("../Pages/Web/Registration/Begin.vue"),
    },
    {
        path: "/registration/info",
        name: "registration.info",
        component: () => import("../Pages/Web/Registration/Info.vue"),
        meta: {
            requiresAuth: true
        },
    },
    {
        path: "/registration/registration",
        name: "registration.store",
        component: () => import("../Pages/Web/Registration/Registration.vue"),
        meta: {
            requiresAuth: true,
            requireNotFreelance: true,
        },
    },
    {
        path: "/category",
        name: "category",
        component: () => import("../Pages/Web/Category/Category.vue")
    },
    {
        path: "/Category/:name",
        name: "Category.name",
        component: () => import("../Pages/Web/Category/CategoryName.vue")
    },
    {
        path: "/Category/:name/:sub",
        name: "sub.name",
        component: () => import("../Pages/Web/Category/SubCategoryName.vue")
    },
    {
        path: "/service/:service_numero",
        name: "one.service",
        meta: {
            requiresAuth: true,
        },
        component: () => import("../Pages/Web/Service/OneService.vue")
    },



];


const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {

    const user = useAuthStore()
    if (to.meta.requiresAuth && !user.token) {
        next({ name: 'login' })
    }
    if (to.meta.requiresGuest && user.token) {
        next({ name: 'Home' })
    }
    if (to.meta.requiresAuth && to.name === 'registration.store' && user.user.isFreelance)
    {
        next({ name: 'Home' })
    }

    next();


})


export default router;

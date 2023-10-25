import { createRouter, createWebHistory } from "vue-router";

import { useAuthStore } from "../store/index.js";
import NProgress from 'nprogress';

import Home from "../Pages/Web/Home.vue";
import Login from "../Pages/Auth/Login.vue";
import Register from "../Pages/Auth/Register.vue";



function removeQueryParams(to) {
    if (Object.keys(to.query).length)
        return { path: to.path, query: {}, hash: to.hash }
}

function removeHash(to) {
    if (to.hash) return { path: to.path, query: to.query, hash: '' }
}
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
        path: "/Category/:name/:sub",
        name: "sub.name",
        component: () => import("../Pages/Web/Category/SubCategoryName.vue")
    },
    {
        path: "/Category/:name",
        name: "Category.name",
        component: () => import("../Pages/Web/Category/CategoryName.vue"),
        beforeEnter: [removeQueryParams, removeHash],

    },
    {
        path: "/category",
        name: "category",
        component: () => import("../Pages/Web/Category/Category.vue")
    },
    {
        path: "/mission/create",
        name: "Create.mission",
        component: () => import("../Pages/Web/Mission/CreateMission.vue")
    },
    {
        path: "/service",
        name: "ServiceAll",
        component: () => import("../Pages/Web/Service/ServiceAll.vue")
    },
    {
        path: "/apropos-de-nous",
        name: "About",
        component: () => import("../Pages/Web/Other/About.vue")
    },
    {
        path: "/contact",
        name: "Contact",
        component: () => import("../Pages/Web/Other/Contact.vue")
    },
    {
        path: "/foires-aux-questions",
        name: "Faq",
        component: () => import("../Pages/Web/Other/Faq.vue")
    },
    {
        path: "/feedback",
        name: "Feedback",
        component: () => import("../Pages/Web/Other/Feedback.vue")
    },

    {
        path: "/service/:service_numero",
        name: "one.service",
        meta: {
            requiresAuth: true,
        },
        component: () => import("../Pages/Web/Service/OneService.vue")
    },
    {
        path: "/checkout/service",
        name: "Checkout.service",
        meta: {
            requiresAuth: true,
        },
        component: () => import("../Pages/Web/Checkout/Checkout.vue")
    },
    {
        path: "/checkout/service/status",
        name: "Checkout.status",
        meta: {
            requiresAuth: true,
        },
        component: () => import("../Pages/Web/Checkout/CheckoutStatus.vue")
    },
    {
        path: '/user',
        name: 'user',
        redirect: '/user/dashboard',
        component: () => import("../Layouts/UserLayout.vue"),
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: 'dashboard',
                name: 'user.dashboard',
                component: () => import("../Pages/User/Dashboard/Dashboard.vue"),
            },
            {
                path: 'commandes',
                name: 'user.commandes',
                component: () => import("../Pages/User/Commande/ListeCommandeUser.vue"),
            },
            {
                path: 'transactions',
                name: 'user.transactions',
                component: () => import("../Pages/User/Transaction/ListeTransUser.vue"),
            },
            {
                path: 'missions',
                name: 'user.missions',
                component: () => import("../Pages/User/Mission/ListeMission.vue"),
            },
            {
                path: 'profile',
                name: 'user.profile',
                component: () => import("../Pages/User/Profile/Profile.vue"),
            },
        ]

    },
    {
        path: "/freelance",
        name: "Checkout.status",
        meta: {
            requiresAuth: true,
            requiresFreelance: true,
        },
        component: () => import("../Layouts/FreelanceLayout.vue"),
        children :[
            {
                path: 'dashboard',
                name: 'freelance.dashboard',
                component: () => import("../Pages/Freelance/Dashboard/Dashboard.vue"),
            },


        ]

    }




];


const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {

    NProgress.start();
    const user = useAuthStore()
    if (to.meta.requiresAuth && !user.token) {
        next({ name: 'login' })
    }
    if (to.meta.requiresGuest && user.token) {
        next({ name: 'Home' })
    }
    if (to.meta.requiresAuth && to.name === 'registration.store' && user.freelance === true)
    {
        next({ name: 'freelance.dashboard' })
    } if (to.meta.requiresAuth && to.meta.requiresFreelance && user.freelance === false)
    {
        next({ name: 'Home' })
    }
    next();


})
router.afterEach(() => {
    NProgress.done();
});


export default router;

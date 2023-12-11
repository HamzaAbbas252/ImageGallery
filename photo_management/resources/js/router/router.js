import { createRouter,createWebHistory } from "vue-router";

import LoginForm  from "../screens/Login.vue"
import Table  from "../component/Table.vue"
import Action_Table  from "../component/ActionTable.vue"
import sidebar from "../component/sidebar.vue"
import oldbar from "../component/oldbar.vue"
import Main from "../screens/Main.vue"
import Dailoged from "../component/DailogImage.vue"
import Deletion_table from "../component/DeleteAction.vue"
import GalleryView from "../component/GalleryView.vue"
const routes = [
    {
        name:"Login",
        path: '/',
        component : LoginForm,
        meta: {guest: true},
    },
    // {
    //     name:"GalleryView",
    //     path: '/GalleryView',
    //     component : GalleryView,
    //     meta: {guest: true},
    // },
    {
        name:"Deletion_table",
        path: '/delete',
        component : Deletion_table,
        meta: {requiresAuth: true}
    },
    {
        name:"Table",
        path: '/Table',
        component : Table,
        meta: {requiresAuth: true}
    },
    {
        name:"sidebar",
        path: '/sidebar',
        component : sidebar,
        meta: {requiresAuth: true}
    },
    {
        name:"Dailoged",
        path: '/Dailoged',
        component : Dailoged,
        meta: {requiresAuth: true}
    },
    {
        name:"Main",
        path: '/Main',
        component : Main,
        meta: { requiresAuth: true },
        children:[
            {
                name: 'Table',
                path:'/Table',
                component:Table

            },
            {
                name:"Action",
                path: '/Action',
                component : Action_Table

            },
            {
                name:"GalleryView",
                path:"/GalleryView",
                component:GalleryView
            }
        ],
        }


]

const router = createRouter({
    history : createWebHistory(),
    routes,
})
console.log(router)

function loggedIn(){
    return localStorage.getItem('token')
    //return null
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
            path: '/',
            query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if(to.matched.some(record => !record.meta.requiresAuth)) {
        if (loggedIn()) {
            next({
            path: '/Main',
            query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})


export default router;

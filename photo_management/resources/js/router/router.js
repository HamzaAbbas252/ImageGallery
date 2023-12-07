import { createRouter,createWebHistory } from "vue-router";

import LoginForm  from "../screens/Login.vue"
import Table  from "../component/Table.vue"
import Action_Table  from "../component/ActionTable.vue"
import sidebar from "../component/sidebar.vue"
import oldbar from "../component/oldbar.vue"
import Main from "../screens/Main.vue"
import NewLoginFrom from "../screens/NewLoginForm.vue"
import Dailoged from "../component/DailogImage.vue"
import Deletion_table from "../component/DeleteAction.vue"

const routes = [
    {
        name:"Login",
        path: '/',
        component : LoginForm
    },
    {
        name:"Deletion_table",
        path: '/delete',
        component : Deletion_table
    },
    {
        name:"NewLoginForm",
        path: '/NewLoginForm',
        component : NewLoginFrom
    },    
    {
        name:"oldbar",
        path: '/oldbar',
        component : oldbar
    },
    {
        name:"Table",
        path: '/Table',
        component : Table
    },
    {
        name:"sidebar",
        path: '/sidebar',
        component : sidebar
    },
    {
        name:"Dailoged",
        path: '/Dailoged',
        component : Dailoged
    },


    {
        name:"Main",
        path: '/Main',
        component : Main,
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
        ]
        }

]



const router = createRouter({
    history : createWebHistory(),
    routes,
})
console.log(router)

export default router;
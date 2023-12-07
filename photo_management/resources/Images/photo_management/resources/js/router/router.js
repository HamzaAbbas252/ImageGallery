import { createRouter,createWebHistory } from "vue-router";

import LoginForm  from "../screens/Login.vue"
const routes = [
    
    {
        name:"Login",
        path: '/',
        component : LoginForm
    }
]
const router = createRouter({
    history : createWebHistory(),
    routes,
})
console.log(router)

export default router;
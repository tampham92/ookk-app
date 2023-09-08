import { createRouter, createWebHistory } from "vue-router";

const routes =[
    {
        path: "/",
        name: "main-layout",
        component: () => import("../layout/main.vue"),
        children: [
            {
                path: "login",
                name: "auth-login",
                component: () => import("../pages/auth/Login.vue")
            },
            {
                path: "register",
                name: "auth-register",
                component: () => import("../pages/auth/Register.vue")
            },
            {
                path: "profile",
                name: "user-info",
                component: () => import("../pages/user/UserInfo.vue")
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
export default router;
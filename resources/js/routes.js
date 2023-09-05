import { createWebHistory, createRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth.js";
const routes = [
    {
        path: "/login",
        name: "Login",
        component: () => import("@/views/Login.vue"),
        meta: {
            title: "Login",
        },
    },
    {
        path: "/",
        name: "home",
        component: () => import("@/views/Books/Index.vue"),
        meta: {
            title: "Books",
            requiresAuth: true,
        },
    },
    {
        path: "/create",
        name: "Create-Book",
        component: () => import("@/views/Books/Form.vue"),
        meta: {
            title: "Create-Book",
            requiresAuth: true,
        },
    },
    {
        path: "/edit/:id",
        name: "Edit Book",
        component: () => import("@/views/Books/Form.vue"),
        meta: {
            title: "Edit-Book",
            requiresAuth: true,
        },
    },
    {
        path: "/rent/:id",
        name: "Rent-Book",
        component: () => import("@/views/Rent/Form.vue"),
        meta: {
            title: "Rent-Book",
            requiresAuth: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
const defaultDocumentTitle = "Test";
router.beforeEach((to, from, next) => {
    const auth = useAuthStore();
    if (
        to.matched.some((record) => record.meta.requiresAuth) &&
        !auth.checkAuthentication()
    ) {
        return next({
            path: "/login",
        });
    }
    if (
        to.matched.some((record) => !record.meta.requiresAuth) &&
        auth.checkAuthentication()
    ) {
        return next({
            path: "/",
        });
    }
    return next();
});
router.afterEach((to) => {
    document.title = to.meta?.title
        ? `${to.meta.title} — ${defaultDocumentTitle}`
        : defaultDocumentTitle;
});

export default router;

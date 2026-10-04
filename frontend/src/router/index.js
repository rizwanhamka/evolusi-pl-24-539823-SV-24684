import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import CatatanList from "../views/CatatanList.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "home", component: Home },
        { path: "/catatan", name: "catatan", component: CatatanList },
    ],
});

export default router;

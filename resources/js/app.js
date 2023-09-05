import "./bootstrap";

import { createApp } from "vue";
import Router from "./routes";
import { createPinia } from "pinia";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp({});
const pinia = createPinia();

app.use(Router);
app.use(pinia);
app.use(Toast);

app.mount("#app");

import axios from "axios";
import { defineStore } from "pinia";
import { useLocalStorage } from "@vueuse/core";
import { useToast } from "vue-toastification";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: useLocalStorage("TOKEN", null),
        isAuthenticated: false,
        toast: useToast(),
    }),
    actions: {
        logout() {
            this.token = null;
            localStorage.removeItem("TOKEN");
        },
        setToken(TOKEN) {
            this.token = TOKEN;
            localStorage.setItem("TOKEN", this.token);
            this.isAuthenticated = true;
        },
        checkAuthentication() {
            return this.token != null;
        },
        chechHeader() {
            const header = {
                "Content-Type": "application/json",
                Authorization: "Bearer " + this.token,
            };
            return header;
        },
        getErros(errors) {
            if (errors.data) {
                console.log(errors.data);
                Object.keys(errors.data).forEach((key) => {
                    this.toast.error("" + errors.data[key], {
                        position: "bottom-right",
                    });
                });
                return;
            }

            this.toast.error("" + errors.message, {
                position: "bottom-right",
            });
            return;
        },
        getMessage(message) {
            this.toast.success("" + message, {
                position: "bottom-right",
            });
        },
    },
});

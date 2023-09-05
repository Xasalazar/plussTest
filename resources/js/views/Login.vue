<template>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input
                    type="email"
                    id="email"
                    v-model="email"
                    class="form-control"
                    placeholder="correo@example.com"
                    required
                />
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    v-model="password"
                    class="form-control"
                    placeholder="Contraseña"
                    required
                />
            </div>
            <button type="submit" class="btn btn-primary">
                Iniciar sesión
            </button>
        </form>
    </div>
</template>

<script>
import { useAuthStore } from "@/stores/auth.js";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login() {
            const auth = useAuthStore();
            axios
                .post("/api/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((result) => {
                    console.log(result.data.data);
                    auth.setToken(result.data.data.token);
                    auth.getMessage(result.data.message);
                    this.$router.push("/");
                })
                .catch((error) => {
                    console.error(error);
                    const errors = error.response.data;
                    auth.getErros(errors);
                });
        },
    },
};
</script>

<style scoped>
.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>

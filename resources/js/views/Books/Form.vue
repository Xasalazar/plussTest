<template>
    <div>
        <h1>
            {{ route.params.id ? "Actualizar Libro" : "Crear Nuevo Libro" }}
        </h1>
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="section_id">Sección</label>
                <select
                    v-model="formulario.section_id"
                    class="form-control"
                    required
                >
                    <option v-for="section in sections" :value="section.id">
                        {{ section.name }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Título</label>
                <input
                    v-model="formulario.title"
                    type="text"
                    class="form-control"
                    id="title"
                    required
                />
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea
                    v-model="formulario.description"
                    class="form-control"
                    id="description"
                ></textarea>
            </div>
            <div class="form-group">
                <label for="number_page">Número de Página</label>
                <input
                    v-model="formulario.number_page"
                    type="number"
                    class="form-control"
                    id="number_page"
                    required
                />
            </div>
            <div class="form-group">
                <label for="publication_date">Fecha de Publicación</label>
                <input
                    v-model="formulario.publication_date"
                    type="date"
                    class="form-control"
                    id="publication_date"
                    required
                />
            </div>
            <button type="submit" class="btn btn-primary">
                {{ route.params.id ? "Actualizar" : "Guardar" }}
            </button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth.js";
export default {
    data() {
        return {
            formulario: {
                section_id: null,
                title: "",
                description: "",
                number_page: null,
                publication_date: null,
            },
            sections: [],
            route: useRoute(),
            router: useRouter(),
            auth: useAuthStore(),
        };
    },
    mounted() {
        const headers = this.auth.chechHeader();
        axios
            .get("/api/sections", { headers })
            .then((response) => {
                this.sections = response.data.data.data;
                // this.auth.getMessage(response.data.message);
            })
            .catch((error) => {
                const errors = error.response.data;
                this.auth.getErros(errors);
                console.error("Error al obtener la lista de libros:", error);
            });
        if (this.route.params.id) {
            this.verlibro(this.route.params.id);
        }
    },
    methods: {
        submit() {
            if (this.route.params.id) {
                this.actualizarlibro();
            } else {
                this.crearLibro();
            }
        },
        crearLibro() {
            const headers = this.auth.chechHeader();
            axios
                .post("/api/book", this.formulario, { headers })
                .then((response) => {
                    this.router.push({ path: "/" });
                    this.auth.getMessage(response.data.message);
                })
                .catch((error) => {
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    console.error("Error al crear el libro:", error);
                });
        },
        actualizarlibro() {
            const headers = this.auth.chechHeader();
            axios
                .put("/api/book/" + this.route.params.id, this.formulario, {
                    headers,
                })
                .then((response) => {
                    this.router.push({ path: "/" });
                    this.auth.getMessage(response.data.message);
                })
                .catch((error) => {
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    console.error("Error al crear el libro:", error);
                });
        },
        verlibro(id) {
            const headers = this.auth.chechHeader();
            axios
                .get("/api/book/" + id, { headers })
                .then((response) => {
                    this.formulario = response.data.data;
                    //  this.auth.getMessage(response.data.message);
                })
                .catch((error) => {
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    console.error("Error al ver el libro:", error);
                });
        },
    },
};
</script>
<style>
h1 {
    text-align: center;
    background-color: #007bff;
    color: white;
    padding: 20px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

/* Estilos para el botón de enviar */
button[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
}

/* Estilos para el botón de enviar al pasar el cursor */
button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Estilos para el checkbox */
.form-check-input {
    width: auto;
    margin-right: 5px;
}

/* Estilos para los errores de validación (opcional) */
.error-message {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
}
</style>

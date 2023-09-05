<template>
    <h1>Rentar Libro</h1>
    <form class="rental-form" @submit.prevent="BuscarLector">
        <h3 class="section-title">Informacion de Libro</h3>
        <div class="form-group">
            <label for="title">Seccion</label>
            <input
                v-model="formulario.section.name"
                type="text"
                class="form-control"
                id="title"
                disabled
            />
        </div>
        <div class="form-group">
            <label for="title">Título</label>
            <input
                v-model="formulario.title"
                type="text"
                class="form-control"
                id="title"
                disabled
            />
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea
                v-model="formulario.description"
                class="form-control"
                id="description"
                disabled
            ></textarea>
        </div>
        <div class="form-group">
            <label for="number_page">Número de Página</label>
            <input
                v-model="formulario.number_page"
                type="number"
                class="form-control"
                id="number_page"
                disabled
            />
        </div>
        <div class="form-group">
            <label for="publication_date">Fecha de Publicación</label>
            <input
                v-model="formulario.publication_date"
                type="date"
                class="form-control"
                id="publication_date"
                disabled
            />
        </div>
        <h3 class="section-title">Informacion de Lector</h3>
        <div class="form-group">
            <label for="publication_date">Buscar Lector: </label>
            <input
                v-model="document"
                type="text"
                class="form-control"
                required
            />
            <button type="submit" class="search-button">Buscar</button>
        </div>
    </form>
    <form v-show="lector.id" class="rental-form" @submit.prevent="RentarLibro">
        <div>
            <div class="form-group">
                <label for="title">Nombre</label>
                <input
                    v-model="lector.name"
                    type="text"
                    class="form-control"
                    id="title"
                    disabled
                />
            </div>
            <div class="form-group">
                <label for="title">Apellido</label>
                <input
                    v-model="lector.lastname"
                    type="text"
                    class="form-control"
                    id="title"
                    disabled
                />
            </div>
            <div class="form-group">
                <label for="title">Telefono</label>
                <input
                    v-model="lector.phone"
                    type="text"
                    class="form-control"
                    id="title"
                    disabled
                />
            </div>
            <div class="form-group">
                <label for="title">Documento</label>
                <input
                    v-model="lector.document"
                    type="text"
                    class="form-control"
                    id="title"
                    disabled
                />
            </div>
        </div>
        <button type="submit" class="rent-button">Rentar</button>
    </form>
</template>
<script>
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth.js";
export default {
    data() {
        return {
            formulario: {
                section: [],
                title: "",
                description: "",
                number_page: null,
                publication_date: null,
            },
            lector: {
                id: null,
                name: "",
                lastname: "",
                phone: "",
                document: "",
            },
            sections: [],
            document: "",
            route: useRoute(),
            router: useRouter(),
            auth: useAuthStore(),
        };
    },
    mounted() {
        this.verlibro(this.route.params.id);
    },
    methods: {
        verlibro(id) {
            const headers = this.auth.chechHeader();
            axios
                .get("/api/book/" + id, { headers })
                .then((response) => {
                    this.formulario = response.data.data;
                    // this.auth.getMessage(response.data.message);
                })
                .catch((error) => {
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    console.error("Error al ver el libro:", error);
                });
        },
        BuscarLector() {
            const headers = this.auth.chechHeader();
            axios
                .get("/api/reader/" + this.document, { headers })
                .then((response) => {
                    this.lector = response.data.data;
                    this.auth.getMessage(response.data.message);
                    console.log(this.lector);
                })
                .catch((error) => {
                    console.error("Error al buscar Lector:", error);
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    this.lector.id = null;
                });
        },
        RentarLibro() {
            const headers = this.auth.chechHeader();
            axios
                .post(
                    "/api/rent/" + this.route.params.id + "/" + this.lector.id,
                    [],
                    { headers }
                )
                .then((response) => {
                    this.auth.getMessage(response.data.message);
                    this.router.push({ path: "/" });
                })
                .catch((error) => {
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    console.error("Error al buscar Lector:", error);
                });
        },
    },
};
</script>
<style>
/* Estilos para el formulario de renta */
.rental-title {
    font-size: 24px;
    margin-bottom: 20px;
}

.rental-form {
    max-width: 500px;
    margin: 0 auto;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.section-title {
    font-size: 18px;
    margin-top: 15px;
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.search-button,
.rent-button {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 3px;
    cursor: pointer;
}

.search-button {
    background-color: #007bff;
    color: white;
}

.search-button:hover {
    background-color: #0056b3;
}

.rent-button {
    background-color: #28a745;
    color: white;
}

.rent-button:hover {
    background-color: #1e7e34;
}
</style>

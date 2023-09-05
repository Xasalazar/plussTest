<script>
import Table from "@/components/Table.vue";
import Search from "@/components/Search.vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth.js";
import axios from "axios";
export default {
    components: {
        Table,
        Search,
    },
    data() {
        return {
            books: [],
            router: useRouter(),
            auth: useAuthStore(),
        };
    },
    mounted() {
        this.ListarLibros();
    },
    methods: {
        EliminarLibro(libro, index) {
            const headers = this.auth.chechHeader();
            axios
                .delete("/api/book/" + libro[0].id, { headers })
                .then((response) => {
                    this.books.splice(libro[1], 1);
                    this.auth.getMessage(response.data.message);
                })
                .catch((error) => {
                    console.error(error);
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                });
        },
        EditarLibro(libro) {
            this.router.push({ path: "/edit/" + libro.id });
        },
        BuscarTermino(term) {
            this.ListarLibros(term);
        },
        ListarLibros(category = "") {
            const headers = this.auth.chechHeader();
            axios
                .get("/api/books", {
                    params: {
                        category: category,
                    },
                    headers,
                })
                .then((response) => {
                    this.books = response.data.data.data;
                    //this.auth.getMessage(response.data.message);
                })
                .catch((error) => {
                    const errors = error.response.data;
                    this.auth.getErros(errors);
                    console.error(
                        "Error al obtener la lista de libros:",
                        error
                    );
                });
        },
        crearLibro() {
            this.router.push({ path: "/create" });
        },
        RentarLibro(libro) {
            this.router.push({ path: "/rent/" + libro.id });
        },
        logout() {
            this.auth.logout();
            this.router.push({ path: "/login" });
        },
    },
};
</script>

<template>
    <h1>Libreria</h1>
    <div style="display: flex; margin-bottom: 2%">
        <Search
            placeholder="Buscar por Seccion.."
            @busqueda="BuscarTermino"
        ></Search>
        <button @click="logout" class="btn-back">LogOut</button>
    </div>

    <Table
        :Data="books"
        :Headers="['Titulo', 'Descripcion', 'Numero de Pagina', 'Seccion']"
        :Keys="['title', 'description', 'number_page', 'section.name']"
        @eliminar="EliminarLibro"
        @editar="EditarLibro"
        @extra="RentarLibro"
    ></Table>
    <footer>
        <button @click="crearLibro" class="btn-create">Crear</button>
    </footer>
</template>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    background-color: #007bff;
    color: white;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.btn-create {
    margin-top: 5%;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
    margin-right: 10px; /* Espacio entre los botones */
}

.btn-back {
    background-color: red;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
    margin-left: auto;
}
</style>

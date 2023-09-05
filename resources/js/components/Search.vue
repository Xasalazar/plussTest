<template>
    <div class="search-container">
        <input
            v-model="searchTerm"
            @input="buscarLibros"
            type="text"
            :placeholder="placeholder"
            class="search-input"
        />
        <button @click="limpiarBusqueda" class="clear-button">Limpiar</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchTerm: "", // Término de búsqueda ingresado por el usuario
        };
    },
    methods: {
        buscarLibros() {
            this.$emit("busqueda", this.searchTerm);
        },
        limpiarBusqueda() {
            this.searchTerm = ""; // Limpiar el término de búsqueda
            this.buscarLibros(); // Realizar una búsqueda vacía para mostrar todos los libros nuevamente
        },
    },
    props: {
        placeholder: {
            type: String,
            default: "Buscar",
        },
    },
};
</script>

<style>
/* Estilos para el componente de búsqueda */
.search-container {
    display: flex;
    align-items: center;
}

.search-input {
    width: 250px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

.clear-button {
    margin-left: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
}

.clear-button:hover {
    background-color: #0056b3;
}
</style>

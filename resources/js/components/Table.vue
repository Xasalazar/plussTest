<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th v-for="header in Headers">{{ header }}</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in Data" :key="item.id">
                    <td v-for="key in Keys" :key="key.id">
                        {{ getTdTag(item, key) }}
                    </td>
                    <td>
                        <button @click="editItem(item)" class="edit-button">
                            Editar
                        </button>
                        <button
                            @click="deleteItem(item, index)"
                            class="delete-button"
                        >
                            Eliminar
                        </button>
                        <button @click="extraItem(item)" class="rent-button">
                            Rentar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            books: [], // Aquí almacenarás la lista de libros obtenida del servidor
        };
    },
    mounted() {},
    props: {
        Data: {
            type: Array,
            default: [],
        },
        Headers: {
            type: Array,
            default: [],
        },
        Keys: {
            type: Array,
            default: [],
        },
    },
    methods: {
        getTdTag(item, key) {
            if (Array.isArray(key)) {
                let result = "";
                key.forEach((element, index) => {
                    let keys = element.split(".");
                    result += keys.reduce(
                        (acc, element) => acc && acc[element],
                        item
                    );
                    if (key.length !== index + 1) {
                        result += " ";
                    }
                });

                return result;
            }
            let keys = key.split(".");
            if (keys.length > 0) {
                return keys.reduce((acc, key) => acc && acc[key], item);
            }
            return item[key];
        },
        editItem(item) {
            this.$emit("editar", item);
        },
        deleteItem(item, index) {
            this.$emit("eliminar", [item, index]);
        },
        extraItem(item) {
            this.$emit("extra", item);
        },
    },
};
</script>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}
.edit-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    margin-right: 5px;
    cursor: pointer;
}

.delete-button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    margin-right: 5px;
    cursor: pointer;
}

.rent-button {
    background-color: green;
    color: white;
    border: none;
    padding: 8px 16px;
    cursor: pointer;
}

.edit-button:hover,
.delete-button:hover {
    opacity: 0.8;
}
</style>

<template>
    <div class="pagination">
        <button
            @click="changePage(currentPage - 1)"
            :disabled="currentPage === 1"
        >
            Anterior
        </button>
        <div v-for="page in pageNumbers" :key="page">
            <button
                @click="changePage(page)"
                :class="{ active: currentPage === page }"
            >
                {{ page }}
            </button>
        </div>
        <button
            @click="changePage(currentPage + 1)"
            :disabled="currentPage === totalPages"
        >
            Siguiente
        </button>
    </div>
</template>

<script>
export default {
    props: {
        currentPage: Number,
        totalPages: Number,
    },
    computed: {
        pageNumbers() {
            return Array.from({ length: this.totalPages }, (_, i) => i + 1);
        },
    },
    methods: {
        changePage(newPage) {
            if (newPage >= 1 && newPage <= this.totalPages) {
                this.$emit("page-change", newPage);
            }
        },
    },
};
</script>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    margin: 0 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

button[disabled] {
    background-color: #ccc;
    cursor: not-allowed;
}

.active {
    background-color: #0056b3;
}

span {
    margin: 0 10px;
    font-size: 14px;
    font-weight: bold;
}
</style>

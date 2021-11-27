<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <div
                class="
                    md-layout-item
                    md-medium-size-100
                    md-xsmall-size-100
                    md-size-100
                    move
                "
            >
                <md-card class="md-card-plain">
                    <md-card-header>
                        <h4 class="title">Sepetler</h4>
                        <div class="row">
                            <div class="subtitle col-sm-8">
                                <md-field style="width: 80%; margin: auto">
                                    <label>Ara..</label>
                                    <md-input v-model="search"></md-input>
                                </md-field>
                            </div>
                        </div>
                    </md-card-header>
                    <md-card-content>
                        <md-table v-model="filteredShopcarts">
                            <md-table-row
                                slot="md-table-row"
                                slot-scope="{ item }"
                            >
                                <md-table-cell md-label="Id">{{
                                    item.id
                                }}</md-table-cell>
                                <md-table-cell md-label="Kullanıcı İsmi">{{
                                    item.user.name
                                }}</md-table-cell>
                                <md-table-cell md-label="Ürün İsmi">{{
                                    item.product.name
                                }}</md-table-cell>
                                <md-table-cell md-label="Miktar">{{
                                    item.quantity
                                }}</md-table-cell>

                                <md-table-cell
                                    md-label="Sil"
                                    style="color: red"
                                >
                                    <md-button
                                        style="color: red"
                                        @click.prevent="deleteshopcart(item.id)"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-trash"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                            />
                                        </svg>
                                    </md-button>
                                </md-table-cell>
                            </md-table-row>
                        </md-table>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
export default {
    mounted() {
        axios
            .get("/api/allshopcarts")
            .then((res) => (this.shopcarts = res.data));
    },
    data() {
        return {
            shopcarts: [],
            search: "",
        };
    },
    computed: {
        filteredShopcarts() {
            this.search = this.search.toLowerCase();
            return this.shopcarts.filter(
                (item) =>
                    item.user.name.toLowerCase().includes(this.search) ||
                    item.product.name.toLowerCase().includes(this.search) ||
                    item.id == this.search
            );
        },
    },
    components: {
        "app-navbar": Navbar,
    },
    methods: {
        deleteshopcart(id) {
            axios
                .post("/api/deleteshopcart", { id: id })
                .then((res) => (this.shopcarts = res.data));
        },
    },
};
</script>

<style scoped>
.title {
    background-color: rgb(17, 77, 92);
    color: rgb(255, 255, 255);
    padding: 10px;
    border-radius: 10px;
    margin-top: -40px;
}
.move {
    padding-top: 100px;
}
.subtitle {
    padding-top: 10px;
}
</style>

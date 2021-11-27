<template>
    <div>
        <app-navbar :searchh="searchh"></app-navbar>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <app-sidebar :getCategory="getCategory"></app-sidebar>
                </div>
                <div class="col-sm-9">
                    <md-button @click="arrangementincrease"
                        >Fiyata Göre Artan</md-button
                    >
                    <md-button @click="arrangementdecrease"
                        >Fiyata Göre azalan</md-button
                    >

                    <div class="row">
                        <div
                            v-for="item in Filtered"
                            :key="item.id"
                            class="col-sm-4 mb-3"
                        >
                            <md-card>
                                <img
                                    :src="getPhoto(item.image)"
                                    style="height: 100%"
                                    alt=""
                                />
                                <md-card-header>
                                    <div class="md-title">
                                        <router-link
                                            :to="{
                                                path: 'urun/' + item.slug,
                                            }"
                                        >
                                            <div class="head-title">
                                                {{ item.name }}
                                            </div></router-link
                                        >
                                    </div>
                                </md-card-header>

                                <md-card-content>
                                    <p>
                                        <b style="font-size: 20px"
                                            >{{ item.price }} ₺</b
                                        >
                                    </p>
                                    <p class="description">
                                        {{ item.description }}
                                    </p>
                                </md-card-content>
                                <md-card-actions v-if="user != ''">
                                    <md-button
                                        @click.prevent="addProduct(item.id)"
                                        >Sepete ekle</md-button
                                    >

                                    <md-button
                                        @click.prevent="followProduct(item.id)"
                                        >Beğen</md-button
                                    >
                                </md-card-actions>

                                <md-card-actions v-if="user == ''">
                                    <router-link to="/giris">
                                        <md-button>Sepete ekle</md-button>

                                        <md-button>Beğen</md-button>
                                    </router-link>
                                </md-card-actions>
                            </md-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
import sidebar from "./Sidebar.vue";
import navbar from "./Navbar.vue";
import footer from "./Footer.vue";
export default {
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/product/" + this.selectCategory)
            .then((res) => {
                this.products = res.data;
                this.Filtered = this.products;
            });
        axios.get("/api/user").then((res) => (this.user = res.data));
    },

    data() {
        return {
            selectCategory: "x",
            products: [],
            Filtered: [],
            search: "",
            max: 0,
            min: 0,
            user: "",
        };
    },
    components: {
        "app-sidebar": sidebar,
        "app-navbar": navbar,
        "app-footer": footer,
    },

    methods: {
        getPhoto(path) {
            return "/storage/" + path;
        },
        getCategory(data, min, max) {
            this.selectCategory = data;
            this.min = min;
            this.max = max;
            axios
                .get("http://127.0.0.1:8000/api/product/" + data)
                .then((res) => {
                    this.products = res.data;
                })
                .then((this.Filtered = this.products));

            this.Filtered = this.products
                .filter((item) => item.name.toLowerCase().includes(this.search))
                .filter((item) => Math.round(item.price) <= this.max)
                .filter((item) => Math.round(item.price) >= this.min);
        },
        searchh(data) {
            this.search = data;
            if (this.max == 0) {
                this.Filtered = this.products.filter((item) =>
                    item.name.toLowerCase().includes(data)
                );
            } else {
                this.Filtered = this.products
                    .filter((item) => item.name.toLowerCase().includes(data))
                    .filter((item) => Math.round(item.price) < this.max)
                    .filter((item) => Math.round(item.price) > this.min);
            }
        },
        arrangementincrease() {
            this.Filtered.sort(
                (a, b) => parseFloat(a.price) - parseFloat(b.price)
            );
        },
        arrangementdecrease() {
            this.Filtered.sort(
                (a, b) => parseFloat(b.price) - parseFloat(a.price)
            );
        },
        followProduct(id) {
            axios
                .post("api/addfollows", { product_id: id })
                .then((res) => alert(res.data));
        },
        addProduct(id) {
            axios
                .post("api/addProduct", { id: id })
                .then((res) => alert(res.data));
        },
    },
};
</script>
<style>
.head-title {
    font-size: 15px;
    font-weight: bolder;
    color: #ff7f00;
    overflow: hidden;
    transition-duration: 0.3s;
}
.head-title:hover {
    color: #c4782c;
}
.description {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
</style>

<template>
    <div>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />

        <app-navbar></app-navbar>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div v-for="item in shopcarts" :key="item.id">
                        <md-card class="mb-3">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <md-card-header>
                                        <div class="head-title">
                                            {{ item.product.name }}
                                        </div>
                                    </md-card-header>

                                    <md-card-content>
                                        <p>
                                            Birim fiyat:
                                            {{ item.product.price }} ₺
                                        </p>
                                        <div class="navbar col-sm-5">
                                            <div>
                                                <md-button
                                                    @click="
                                                        changeQuantity(
                                                            item.id,
                                                            item.quantity - 1
                                                        )
                                                    "
                                                    ><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-caret-down"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"
                                                        />
                                                    </svg>
                                                </md-button>
                                            </div>
                                            <div>
                                                Miktar: {{ item.quantity }}
                                            </div>
                                            <div>
                                                <md-button
                                                    @click="
                                                        changeQuantity(
                                                            item.id,
                                                            item.quantity + 1
                                                        )
                                                    "
                                                    ><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-caret-up"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"
                                                        /></svg
                                                ></md-button>
                                            </div>
                                        </div>
                                        <p>
                                            Toplam:
                                            {{
                                                item.quantity *
                                                item.product.price
                                            }}
                                            ₺
                                        </p>
                                    </md-card-content>

                                    <md-card-actions>
                                        <md-button
                                            @click="deleteProduct(item.id)"
                                            class="md-accent"
                                            >Sil</md-button
                                        >
                                    </md-card-actions>
                                </div>
                            </div>
                        </md-card>
                    </div>
                </div>
                <div class="col-sm-3">
                    <md-card class="md-primary" md-theme="green-card">
                        <md-card-header>
                            <md-card-header-text>
                                <div>
                                    <md-button
                                        style="
                                            width: 100%;
                                            color: #136281;
                                            font-weight: bolder;
                                        "
                                        @click="refresh"
                                        >Kontrol</md-button
                                    >
                                </div>
                                <div class="md-title">{{ price }} ₺</div>
                                <div class="md-subhead">Toplam Ücret</div>
                                <div>
                                    <div
                                        class="mt-2"
                                        v-if="user.is_active == 0"
                                    >
                                        Ödemek için önce aktivasyon kodunu
                                        aktifleştirmeniz gerekektedir.
                                    </div>
                                    <md-button
                                        v-if="user.is_active"
                                        style="
                                            width: 100%;
                                            color: #ff7f00;
                                            font-weight: bolder;
                                        "
                                    >
                                        Öde
                                    </md-button>
                                </div>
                            </md-card-header-text>
                        </md-card-header>
                    </md-card>
                </div>
            </div>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
import footer from "./Footer.vue";

export default {
    mounted() {
        axios.get("api/shopcarts").then((res) => {
            this.shopcarts = res.data;
            this.shopcarts.map(
                (x) => (this.price += x.product.price * x.quantity)
            );
        });
        axios.get("/api/user").then((res) => (this.user = res.data));
    },
    data() {
        return {
            shopcarts: [],
            price: 0,
            user: "",
        };
    },
    components: {
        "app-navbar": Navbar,
        "app-footer": footer,
    },
    methods: {
        deleteProduct(id) {
            axios
                .post("api/deleteProduct", { id: id })
                .then((res) => (this.shopcarts = res.data));
        },

        changeQuantity(id, quantity) {
            axios
                .post("api/changequantity", { id: id, quantity: quantity })
                .then((res) => (this.shopcarts = res.data));
        },
        refresh() {
            this.price = 0;
            axios.get("api/shopcarts").then((res) => {
                this.shopcarts = res.data;
                this.shopcarts.map(
                    (x) => (this.price += x.product.price * x.quantity)
                );
            });
        },
    },
};
</script>

<style>
.head-title {
    font-size: 20px;
    padding-bottom: 5px;
    font-weight: bolder;
    color: #ff7f00;
    overflow: hidden;
}
</style>

<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <div class="row">
                <div
                    v-for="item in follows"
                    :key="item.id"
                    class="col-sm-3 mb-3"
                >
                    <md-card>
                        <md-card-header>
                            <div class="md-title">
                                <div class="head-title">
                                    {{ item.product.name }}
                                </div>
                            </div>
                        </md-card-header>

                        <md-card-content>
                            <p>
                                <b style="font-size: 20px"
                                    >{{ item.product.price }} ₺</b
                                >
                            </p>
                            <p class="description">
                                {{ item.product.description }}
                            </p>
                        </md-card-content>

                        <md-card-actions>
                            <md-button
                                @click.prevent="addProduct(item.product_id)"
                                >Sepete ekle</md-button
                            >
                            <md-button @click.prevent="unfollowProduct(item.id)"
                                >Beğenmeyi kaldır
                            </md-button>
                        </md-card-actions>
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
        axios.get("api/follows").then((res) => (this.follows = res.data));
    },
    data() {
        return {
            follows: [],
        };
    },
    components: {
        "app-navbar": Navbar,
        "app-footer": footer,
    },
    methods: {
        unfollowProduct(id) {
            axios
                .post("api/unfollows", { id: id })
                .then((res) => (this.follows = res.data));
        },
        addProduct(id) {
            axios
                .post("api/addProduct", { id: id })
                .then((res) => alert(res.data));
        },
    },
};
</script>

<style></style>

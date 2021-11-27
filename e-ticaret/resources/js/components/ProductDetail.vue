<template>
    <div style="padding-bottom: 100px">
        <app-navbar></app-navbar>
        <div class="container">
            <md-card class="mb-3">
                <div class="row">
                    <div class="col-sm-5">
                        <img
                            style="padding: 10px"
                            :src="getPhoto(product.image)"
                            alt=""
                        />
                    </div>
                    <div class="col-sm-7">
                        <md-card-header>
                            <div
                                style="font-size: 30px; color: #ff7f00"
                                class="md-title"
                            >
                                {{ product.name }}
                            </div>
                        </md-card-header>

                        <md-card-content>
                            <div style="font-size: 25px">
                                {{ product.price }} ₺
                            </div>
                            <div style="width: 100%">
                                <div class="navbar">
                                    <div>
                                        <md-button
                                            @click="
                                                changeQuantity(quantity - 1)
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
                                    <div>{{ quantity }}</div>
                                    <div>
                                        <md-button
                                            @click="
                                                changeQuantity(quantity + 1)
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
                            </div>
                            <div>
                                {{ quantity }} adet için
                                {{ quantity * product.price }} ₺
                            </div>
                        </md-card-content>

                        <md-card-actions>
                            <md-button
                                v-if="user"
                                @click.prevent="
                                    addProduct(product.id, quantity)
                                "
                                >Sepete ekle</md-button
                            >
                            <md-button
                                v-if="user"
                                @click.prevent="followProduct(product.id)"
                                >Beğen</md-button
                            >
                            <router-link to="/giris"
                                ><md-button v-if="user == 0"
                                    >Giriş Yap!</md-button
                                ></router-link
                            >
                        </md-card-actions>
                    </div>
                </div>
            </md-card>
            <md-card>
                <md-tabs md-alignment="centered">
                    <md-tab
                        id="tab-description"
                        @click.prevent="description"
                        md-label="Açıklama"
                    ></md-tab>
                    <md-tab
                        id="tab-reviews"
                        @click.prevent="reviews"
                        md-label="Yorumlar"
                    ></md-tab>
                    <md-tab
                        v-if="user"
                        id="tab-createreviews"
                        @click.prevent="createreviews"
                        md-label="Yorum Yap"
                    ></md-tab>
                </md-tabs>
                <div v-if="descriptionvalue" style="padding: 30px">
                    {{ product.description }}
                </div>
                <div v-if="reviewvalue">
                    <div
                        style="padding: 10px"
                        v-for="item in review"
                        :key="item.id"
                        v-if="item.is_active"
                    >
                        <md-card>
                            <md-card-header>
                                <div class="md-title">
                                    {{ item.subject }}
                                </div>
                            </md-card-header>

                            <md-card-content>
                                {{ item.review }}
                            </md-card-content>

                            <md-card-content style="color: #f9d71c">
                                <svg
                                    v-for="i in item.rate"
                                    :key="i.index"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-star-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                    /></svg
                                ><svg
                                    v-for="i in 5 - item.rate"
                                    :key="i.index"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-star"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"
                                    />
                                </svg>
                            </md-card-content>

                            <md-card-actions>
                                {{ item.user.name }}
                            </md-card-actions>
                        </md-card>
                    </div>
                </div>
                <div
                    v-if="createreviewvalue && user"
                    style="padding-bottom: 100px"
                >
                    <md-card style="width: 500px; margin: auto" class="mt-5">
                        <md-card-header>
                            <div class="md-title" style="text-align: center">
                                Yorumunuzu Bırakabilirsiniz
                            </div>
                        </md-card-header>

                        <md-card-content>
                            <div class="navbar">
                                <md-radio v-model="form.rate" :value="1"
                                    >1</md-radio
                                >
                                <md-radio v-model="form.rate" :value="2"
                                    >2</md-radio
                                >
                                <md-radio v-model="form.rate" :value="3"
                                    >3</md-radio
                                >
                                <md-radio v-model="form.rate" :value="4"
                                    >4</md-radio
                                >
                                <md-radio v-model="form.rate" :value="5"
                                    >5</md-radio
                                >
                            </div>

                            <md-field>
                                <label>Konu</label>
                                <md-input v-model="form.mytopic"></md-input>
                            </md-field>
                            <md-field>
                                <label>Yorum</label>
                                <md-textarea
                                    v-model="form.myreview"
                                ></md-textarea>
                            </md-field>
                        </md-card-content>

                        <md-card-actions>
                            <md-button
                                @click.prevent="refresh"
                                style="color: red"
                                >Temizle</md-button
                            >
                            <md-button
                                @click.prevent="sendreview"
                                style="color: #ff7f00"
                                >Gönder</md-button
                            >
                        </md-card-actions>
                    </md-card>
                </div>
            </md-card>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
import footer from "./Footer.vue";

export default {
    components: {
        "app-navbar": Navbar,
        "app-footer": footer,
    },
    data() {
        return {
            form: {
                rate: 0,
                mytopic: "",
                myreview: "",
                user: "",
                product: "",
            },
            slug: "",
            product: {},
            review: [],
            quantity: 1,
            descriptionvalue: true,
            reviewvalue: false,
            createreviewvalue: false,
            user: "",
        };
    },
    mounted() {
        this.slug = this.$route.params.product;
        axios
            .get("/api/getproduct/" + this.slug)
            .then((res) => (this.product = res.data));

        axios.get("/api/user").then((res) => (this.user = res.data));
    },

    methods: {
        sendreview() {
            this.form.user = this.user.id;
            this.form.product = this.product.id;
            axios.post("/api/sendreview", this.form);
            this.form = "";
        },
        refresh() {
            this.form.rate = "";
            this.form.mytopic = "";
            this.form.myreview = "";
        },
        createreviews() {
            this.createreviewvalue = true;
            this.reviewvalue = false;
            this.descriptionvalue = false;
        },
        description() {
            this.descriptionvalue = true;
            this.reviewvalue = false;

            this.createreviewvalue = false;
        },
        reviews() {
            this.descriptionvalue = false;
            this.reviewvalue = true;
            this.createreviewvalue = false;

            axios
                .post("/api/getreviews/", { product_id: this.product.id })
                .then((res) => (this.review = res.data));
        },
        getPhoto(path) {
            return "/storage/" + path;
        },
        changeQuantity(quantity) {
            if (quantity > 10 || quantity < 1) {
            } else {
                this.quantity = quantity;
            }
        },
        followProduct(id) {
            axios
                .post("/api/addfollows", { product_id: id })
                .then((res) => alert(res.data));
        },
        addProduct(id, quantity) {
            axios
                .post("/api/addProduct", { id: id, quantity: quantity })
                .then((res) => alert(res.data));
        },
    },
};
</script>

<style></style>

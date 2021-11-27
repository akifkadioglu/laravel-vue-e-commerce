<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <div
                v-for="(item, index) in errors"
                :key="index"
                style="
                    background-color: #ff7f00;
                    padding: 15px;
                    border-radius: 5px;
                    font-weight: bolder;
                    color: white;
                "
            >
                {{ item }}
            </div>
            <div class="move">
                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <label for="name" class="">Ad</label>
                            <input
                                type="text"
                                v-model="form.name"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <label for="email" class="">E-mail</label>
                            <input
                                type="text"
                                v-model="form.email"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <label for="email" class="">Telefon</label>
                            <input
                                type="text"
                                v-model="form.phone"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="">Konu</label>
                            <input
                                type="text"
                                v-model="form.topic"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <label for="message">Mesaj</label>
                            <textarea
                                type="text"
                                rows="5"
                                v-model="form.message"
                                class="form-control md-textarea"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <br />
                <div style="text-align: end">
                    <md-button
                        @click.prevent="sendmessage"
                        style="color: green"
                    >
                        Gönder
                    </md-button>
                </div>
            </div>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
import navbar from "./Navbar.vue";
import footer from "./Footer.vue";
export default {
    components: {
        "app-navbar": navbar,
        "app-footer": footer,
    },
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                topic: "",
                message: "",
            },
            errors: [],
        };
    },
    computed: {},
    methods: {
        sendmessage() {
            this.errors = [];
            axios.post("/api/sendmessage", this.form).catch((err) => {
                this.errors = err.response.data.errors;
            });
            alert("Eğer hata dönmezse mesaj bize ulaşmıştır.");
        },
    },
};
</script>

<style>
.move {
    padding-top: 100px;
}
</style>

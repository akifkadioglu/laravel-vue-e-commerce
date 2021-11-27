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
            <div class="register">
                <form>
                    <md-field>
                        <label>E-mail</label>
                        <md-input v-model="form.email"></md-input>
                    </md-field>
                    <md-field>
                        <label>Şifre</label>
                        <md-input
                            v-model="form.password"
                            type="password"
                        ></md-input>
                    </md-field>

                    <div style="text-align: end">
                        <md-button
                            type="submit"
                            style="color: green"
                            @click.prevent="login"
                            >Kullanıcı Oluştur</md-button
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
export default {
    components: {
        "app-navbar": Navbar,
    },
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            errors: [],
            user: {},
        };
    },
    methods: {
        login() {
            axios
                .post("/api/login", this.form)
                .then((res) => (this.user = res))
                .then(() => {
                    this.$router.push({ name: "Home" });
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
    },
};
</script>

<style></style>

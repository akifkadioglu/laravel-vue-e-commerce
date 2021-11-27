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
                        <label>İsim</label>
                        <md-input v-model="form.name"></md-input>
                    </md-field>
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
                    <md-field>
                        <label>Şifre Tekrar</label>
                        <md-input
                            v-model="form.password_confirmation"
                            type="password"
                        ></md-input>
                    </md-field>
                    <div style="text-align: end">
                        <router-link to="/giris"
                            ><md-button
                                >Zaten bir hesabım var</md-button
                            > </router-link
                        ><md-button
                            type="submit"
                            style="color: green"
                            @click.prevent="saveform"
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
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                is_active: false,
                password_confirmation: "",
            },
            errors: [],
        };
    },
    components: {
        "app-navbar": Navbar,
    },
    methods: {
        saveform() {
            axios
                .post("/api/createuser", this.form)
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

<style>
.register {
    width: 600px;
    padding: 20px;
    border-radius: 10px;
    position: relative;
    margin: auto;
}
</style>

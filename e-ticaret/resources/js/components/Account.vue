<template>
    <div>
        <app-navbar :searchh="searchh"></app-navbar>
        <div class="container">
            <div v-if="search">Aranan kelime: {{ search }}</div>

            <div class="col-sm-6" style="margin: auto">
                <form autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12">
                            {{ user.email }}
                        </div>
                        <div class="col-sm-6">
                            <md-field>
                                <label>Ad Soyad</label>
                                <md-input
                                    autocomplete="off"
                                    v-model="name"
                                ></md-input>
                            </md-field>
                        </div>
                        <div class="col-sm-6">
                            <md-field>
                                <label>Yeni Şifre</label>
                                <md-input
                                    autocomplete="off"
                                    v-model="newpassword"
                                    type="password"
                                ></md-input>
                            </md-field>
                        </div>
                        <div class="col-sm-12">
                            <md-field>
                                <label>Şifre </label>
                                <md-input
                                    autocomplete="off"
                                    v-model="password"
                                    type="password"
                                ></md-input>
                            </md-field>
                        </div>
                    </div>
                    <div style="text-align: end">
                        <md-button
                            @click.prevent="
                                update(user.email, password, newpassword, name)
                            "
                            >Güncelle</md-button
                        >
                    </div>
                    
                </form>
            </div>
        </div>

        <app-footer></app-footer>
    </div>
</template>
<script>
import navbar from "./Navbar.vue";
import footer from "./Footer.vue";
export default {
    data() {
        return {
            search: "",
            newpassword: "",
            password: "",
            user: "",
            name: "",
        };
    },
    mounted() {
        axios.get("/api/user").then((res) => (this.user = res.data));
    },
    components: {
        "app-navbar": navbar,
        "app-footer": footer,
    },
    methods: {
        searchh(data) {
            this.search = data;
        },
        update(email, password, newpassword, name) {
            axios
                .post("/api/updateuser", {
                    email: email,
                    password: password,
                    newpassword: newpassword,
                    name: name,
                })
                .then((res) => (this.user = res.data));
        },
    },
};
</script>

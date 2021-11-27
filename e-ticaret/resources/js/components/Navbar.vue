<template>
    <div>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />

        <div class="navbar header">
            <div></div>
            <b style="color: white">İyi Alışverişler :) </b>
            <div></div>
        </div>
        <div class="navbar" style="padding-left: 5%; padding-right: 5%">
            <router-link to="/"> <div>logo</div></router-link>
            <div style="width: 60%">
                <md-field>
                    <label>Ara..</label>
                    <md-input
                        @input="searchh(search)"
                        v-model="search"
                    ></md-input>
                </md-field>
            </div>
            <div>
                <md-menu md-size="medium" md-align-trigger v-if="user == ''">
                    <md-button md-menu-trigger>
                        <md-icon class="fa fa-user"></md-icon>Hesabım</md-button
                    >
                    <md-menu-content>
                        <router-link to="/giris"
                            ><md-menu-item>Giriş Yap</md-menu-item>
                        </router-link>
                        <router-link to="/kayit">
                            <md-menu-item>Kaydol</md-menu-item></router-link
                        >
                    </md-menu-content>
                </md-menu>

                <md-menu md-size="medium" md-align-trigger v-if="user">
                    <md-button md-menu-trigger>
                        <md-icon class="fa fa-user"></md-icon
                        >{{ user.name }}</md-button
                    >
                    <md-menu-content>
                        <router-link to="/hesabim"
                            ><md-menu-item>Profil</md-menu-item>
                        </router-link>
                        <router-link to="/sepetim">
                            <md-menu-item>Sepetim</md-menu-item></router-link
                        >
                        <router-link to="/begendiklerim">
                            <md-menu-item
                                >Beğendiklerim</md-menu-item
                            ></router-link
                        >
                        <md-divider class="md-inset"></md-divider>
                        <md-menu-item @click.prevent="logout"
                            >Çıkış</md-menu-item
                        >
                    </md-menu-content>
                </md-menu>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        searchh: Function,
    },
    mounted() {
        axios.get("/api/user").then((res) => (this.user = res.data));
    },
    data() {
        return {
            search: "",
            user: "",
        };
    },
    methods: {
        logout() {
            axios.get("/api/logout").then((res) => (this.user = res.data));
        },
    },
};
</script>
<style>
.header {
    transition-duration: 0.5s;
}
.header:hover {
    background-color: #ff7f00;

    padding-top: 30px;
}
</style>

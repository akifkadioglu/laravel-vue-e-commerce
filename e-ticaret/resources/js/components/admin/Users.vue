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
                        <h4 class="title">Kullanıcılar</h4>
                        <div class="row">
                            <div class="subtitle col-sm-8">
                                <md-field style="width: 80%; margin: auto">
                                    <label>Ara..</label>
                                    <md-input v-model="search"></md-input>
                                </md-field>
                            </div>
                            <div class="col-sm-4" style="padding-top: 20px">
                                <md-button
                                    data-toggle="modal"
                                    data-target="#createmodal"
                                    >Kullanıcı Oluştur</md-button
                                >
                            </div>
                        </div>
                    </md-card-header>
                    <md-card-content>
                        <md-table v-model="filteredUsers">
                            <md-table-row
                                slot="md-table-row"
                                slot-scope="{ item }"
                            >
                                <md-table-cell md-label="Id">{{
                                    item.id
                                }}</md-table-cell>
                                <md-table-cell md-label="İsim">{{
                                    item.name
                                }}</md-table-cell>
                                <md-table-cell md-label="E-mail">{{
                                    item.email
                                }}</md-table-cell>
                                <md-table-cell md-label="Aktif mi">
                                    <div v-if="item.is_active">Evet</div>
                                    <div v-if="item.is_active == 0">
                                        Hayır
                                    </div></md-table-cell
                                >
                                <md-table-cell md-label="Oluşturulma tarihi">{{
                                    item.created_at | date
                                }}</md-table-cell>
                                <md-table-cell
                                    md-label="Düzenle"
                                    style="color: blue"
                                >
                                    <md-button
                                        @click.prevent="edituser(item.id)"
                                        style="color: blue"
                                        data-toggle="modal"
                                        data-target="#editmodal"
                                        ><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-pen"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"
                                            /></svg></md-button
                                ></md-table-cell>
                                <md-table-cell
                                    md-label="Sil"
                                    style="color: red"
                                >
                                    <md-button
                                        @click.prevent="deleteuser(item.id)"
                                        style="color: red"
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

        <!-- Modal Edit -->
        <div
            class="modal fade"
            id="editmodal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ user.id }} - {{ user.name }}
                        </h5>
                        <md-button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </md-button>
                    </div>
                    <div class="modal-body">
                        <md-field>
                            <label>İsim</label>
                            <md-input v-model="user.name"></md-input>
                        </md-field>
                        <md-field>
                            <label>E-mail</label>
                            <md-input v-model="user.email"></md-input>
                        </md-field>
                        <md-switch v-model="user.is_active">{{
                            user.is_active
                        }}</md-switch>
                        <p>Oluşturulma tarihi: {{ user.created_at }}</p>
                        <p>Güncellenme tarihi: {{ user.updated_at }}</p>
                    </div>
                    <div class="modal-footer">
                        <md-button data-dismiss="modal"> Kapat </md-button>
                        <md-button
                            class="md-primary"
                            @click.prevent="
                                editeduser(
                                    user.id,
                                    user.name,
                                    user.email,
                                    user.is_active
                                )
                            "
                            >Güncelle</md-button
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div
            class="modal fade"
            id="createmodal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Yeni Kullanıcı - {{ form.name }}
                        </h5>
                        <md-button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </md-button>
                    </div>
                    <div class="modal-body">
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
                            <label>Şifre yeniden</label>
                            <md-input
                                v-model="form.password_confirmation"
                                type="password"
                            ></md-input>
                        </md-field>
                        <md-switch v-model="form.is_active">{{
                            form.is_active
                        }}</md-switch>
                    </div>
                    <div class="modal-footer">
                        <md-button data-dismiss="modal"> Kapat </md-button>
                        <md-button
                            class="md-primary"
                            @click.prevent="
                                createuser(
                                    form.name,
                                    form.email,
                                    form.is_active,
                                    form.password,
                                    form.password_confirmation
                                )
                            "
                            >Oluştur</md-button
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
export default {
    mounted() {
        axios.get("/api/alluser").then((res) => (this.users = res.data));
    },
    data() {
        return {
            users: [],
            search: "",
            user: {
                name: "",
                email: "",
                is_active: "",
                created_at: "",
                updated_at: "",
            },
            form: {
                name: "",
                email: "",
                password: "",
                is_active: false,
                password_confirmation: "",
            },
        };
    },
    components: {
        "app-navbar": Navbar,
    },
    computed: {
        filteredUsers: function () {
            return this.users.filter(
                (item) =>
                    item.name.toLowerCase().includes(this.search) ||
                    item.email.toLowerCase().includes(this.search) ||
                    item.id == this.search
            );
        },
    },
    filters: {
        date: function (value) {
            value = value.toString();
            return value.slice(0, 10);
        },
    },
    methods: {
        deleteuser(id) {
            axios
                .post("/api/deleteuser", { id: id })
                .then((res) => (this.users = res.data));
        },
        edituser(id) {
            axios
                .post("/api/edituser", { id: id })
                .then((res) => (this.user = res.data));
        },
        editeduser(id, name, email, active) {
            axios
                .post("/api/editeduser", {
                    id: id,
                    name: name,
                    email: email,
                    active: active,
                })
                .then((res) => (this.user = res.data));
            axios.get("/api/alluser").then((res) => (this.users = res.data));
        },
        createuser() {
            axios.post("/api/createuser", this.form);
            axios.get("/api/alluser").then((res) => (this.users = res.data));
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

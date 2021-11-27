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
                        <h4 class="title">Mesajlar</h4>
                        <div class="row">
                            <div class="subtitle col-sm-8">
                                <md-field style="width: 80%; margin: auto">
                                    <label>Ara..</label>
                                    <md-input v-model="search"></md-input>
                                </md-field>
                            </div>
                        </div>
                    </md-card-header>
                    <md-card-content>
                        <md-table v-model="filteredMessages">
                            <md-table-row
                                slot="md-table-row"
                                slot-scope="{ item }"
                            >
                                <md-table-cell md-label="Id">{{
                                    item.id
                                }}</md-table-cell>
                                <md-table-cell md-label="Ad">{{
                                    item.name
                                }}</md-table-cell>
                                <md-table-cell md-label="E-mail">{{
                                    item.email
                                }}</md-table-cell>
                                <md-table-cell md-label="Telefon">{{
                                    item.phone
                                }}</md-table-cell
                                ><md-table-cell md-label="Konu">{{
                                    item.topic
                                }}</md-table-cell>
                                <md-table-cell md-label="Not">{{
                                    item.note
                                }}</md-table-cell>
                                <md-table-cell md-label="Okundu mu">
                                    <span v-if="item.is_okey == 1">Okundu</span>
                                    <span v-if="item.is_okey == 0"
                                        >Okunmadı</span
                                    >
                                </md-table-cell>
                                <md-table-cell
                                    md-label="Düzenle"
                                    style="color: blue"
                                >
                                    <md-button
                                        style="color: blue"
                                        data-toggle="modal"
                                        data-target="#editmodal"
                                        @click.prevent="editmessage(item.id)"
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
                                        style="color: red"
                                        @click.prevent="deletemessage(item.id)"
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
                            {{ message.name }}
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
                        <md-field> E-mail: {{ message.email }} </md-field>
                        <md-field> Telefon: {{ message.phone }} </md-field>
                        <md-field> Konu: {{ message.topic }} </md-field>
                        <md-switch v-model="message.is_okey">
                            Okundu mu: {{ message.is_okey }}</md-switch
                        >
                        <md-field>
                            <label>Not</label>
                            <md-input v-model="message.note"></md-input>
                        </md-field>
                        <md-field> Mesaj: {{ message.message }} </md-field>
                    </div>
                    <div class="modal-footer">
                        <md-button data-dismiss="modal"> Kapat </md-button>
                        <md-button
                            class="md-primary"
                            @click.prevent="editedmessage"
                            >Düzenle</md-button
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
    components: {
        "app-navbar": Navbar,
    },
    mounted() {
        axios.get("/api/allmessages").then((res) => {
            this.messages = res.data;
        });
    },
    methods: {
        
        deletemessage(id) {
            axios
                .post("/api/deletemessage", { id: id })
                .then((res) => (this.messages = res.data));
        },
        editedmessage() {
            axios
                .post("/api/editedmessage", this.message)
                .then((res) => (this.messages = res.data));
        },
        editmessage(id) {
            axios
                .post("/api/editmessage", { id: id })
                .then((res) => (this.message = res.data));
        },
    },
    computed: {
        filteredMessages: function () {
            return this.messages.filter(
                (item) =>
                    item.topic
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    item.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    item.email
                        .toLowerCase()
                        .includes(this.search.toLowerCase()) ||
                    item.id == this.search
            );
        },
    },
    data() {
        return {
            search: "",
            messages: [],
            message: {},
        };
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

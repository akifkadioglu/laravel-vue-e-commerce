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
                        <h4 class="title">Ürünler</h4>
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
                                    >Ürün Oluştur</md-button
                                >
                            </div>
                        </div>
                    </md-card-header>
                    <md-card-content>
                        <md-table v-model="filteredproducts">
                            <md-table-row
                                slot="md-table-row"
                                slot-scope="{ item }"
                            >
                                <md-table-cell md-label="Id">{{
                                    item.id
                                }}</md-table-cell>
                                <md-table-cell md-label="Resim">
                                    <img
                                        :src="getPhoto(item.image)"
                                        style="width: 100%"
                                        alt=""
                                    />
                                </md-table-cell>
                                <md-table-cell md-label="İsim">{{
                                    item.name
                                }}</md-table-cell>
                                <md-table-cell md-label="Url">{{
                                    item.slug
                                }}</md-table-cell>
                                <md-table-cell md-label="Fiyat">{{
                                    item.price
                                }}</md-table-cell>
                                <md-table-cell md-label="Miktar">{{
                                    item.quantity
                                }}</md-table-cell>
                                <md-table-cell md-label="Ürün Sahibi"
                                    >{{ item.user.id }} -
                                    {{ item.user.name }}</md-table-cell
                                >

                                <md-table-cell md-label="Oluşturulma tarihi">{{
                                    item.created_at | date
                                }}</md-table-cell>
                                <md-table-cell md-label="Kategoriler">
                                    <md-button
                                        @click.prevent="getcategories(item.id)"
                                        style="color: green"
                                        data-toggle="modal"
                                        data-target="#categories"
                                        ><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-subtract"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"
                                            /></svg></md-button
                                ></md-table-cell>
                                <md-table-cell
                                    md-label="Düzenle"
                                    style="color: blue"
                                >
                                    <md-button
                                        style="color: blue"
                                        data-toggle="modal"
                                        data-target="#editmodal"
                                        @click.prevent="editproduct(item.id)"
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
                                        @click.prevent="deleteproduct(item.id)"
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

        <!-- Categories -->
        <div
            class="modal fade"
            id="categories"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Kategoriler
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
                        <div class="navbar">
                            <div>
                                <select
                                    class="form-select"
                                    v-model="topcategory"
                                >
                                    <option
                                        v-for="item in category"
                                        :value="item.id"
                                        :key="item.id"
                                        v-if="item.parent_id == null"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>

                                <select
                                    class="form-select"
                                    v-if="topcategory != null"
                                    v-model="subcategory"
                                >
                                    <option
                                        v-for="item in category"
                                        :value="item.id"
                                        :key="item.id"
                                        v-if="item.parent_id == topcategory"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <md-button
                                    style="color: grey"
                                    v-if="subcategory == null"
                                    disabled
                                    >Kategori Ekle</md-button
                                >
                                <md-button
                                    style="color: green"
                                    @click.prevent="
                                        addcategory(selectproduct, subcategory)
                                    "
                                    v-if="subcategory != null"
                                    >Kategori Ekle</md-button
                                >
                            </div>
                        </div>

                        <div
                            class="navbar"
                            v-for="item in categories"
                            :key="item.id"
                        >
                            <div>
                                {{ item.category.name }}
                            </div>
                            <div>
                                <md-button
                                    style="color: red"
                                    @click.prevent="
                                        deletecategoryproduct(
                                            item.product_id,
                                            item.category_id
                                        )
                                    "
                                    ><svg
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
                                        /></svg
                                ></md-button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <md-button data-dismiss="modal"> Kapat </md-button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Product -->
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
                            Ürün Oluştur
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
                        <input
                            type="file"
                            class="mb-4 form-control"
                            @change="handleOnchange"
                        />

                        <md-field>
                            <label>Ürün İsmi</label>
                            <md-input v-model="addproduct.name"></md-input>
                        </md-field>
                        <label>Ürün Fiyatı</label>

                        <input
                            type="number"
                            placeholder="Fiyat"
                            min="0"
                            step="0.01"
                            class="form-control"
                            v-model="addproduct.price"
                        />
                        <md-field>
                            <label>Açıklama</label>
                            <md-input
                                v-model="addproduct.description"
                            ></md-input>
                        </md-field>
                        <label>Ürün Miktarı</label>

                        <input
                            type="number"
                            placeholder="Miktar"
                            min="1"
                            class="form-control"
                            v-model="addproduct.quantity"
                        />
                        <label class=" my-4">Kullanıcı Id</label>
                        <input
                            type="number"
                            placeholder="Kullanıcı id"
                            class="form-control"
                            v-model="addproduct.user"
                        />
                        <select
                            class="form-control my-4"
                            v-model="addproduct.user"
                        >
                            <option
                                v-for="item in users"
                                :key="item.id"
                                :value="item.id"
                            >
                                {{ item.id }} -
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <md-button data-dismiss="modal"> Kapat </md-button>
                        <md-button
                            class="md-primary"
                            @click.prevent="createproduct()"
                            >Ekle</md-button
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product -->
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
                            {{ selectedproduct.id }} -
                            {{ selectedproduct.name }}
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
                        <input
                            type="file"
                            class="mb-4 form-control"
                            @change="handleOnchange2"
                        />
                        <img :src="getPhoto(selectedproduct.image)" alt="" />

                        <md-field>
                            <label>Ürün İsmi</label>
                            <md-input v-model="selectedproduct.name"></md-input>
                        </md-field>
                        <input
                            type="number"
                            placeholder="Fiyat"
                            min="0"
                            step="0.01"
                            class="form-control"
                            v-model="selectedproduct.price"
                        />
                        <md-field>
                            <label>Açıklama</label>
                            <md-input
                                v-model="selectedproduct.description"
                            ></md-input>
                        </md-field>
                        <input
                            type="number"
                            placeholder="Miktar"
                            min="1"
                            class="form-control"
                            v-model="selectedproduct.quantity"
                        />
                        <input
                            type="number"
                            placeholder="Kullanıcı id"
                            class="form-control my-4"
                            v-model="selectedproduct.user.id"
                        />
                        <select
                            class="form-control my-4"
                            v-model="selectedproduct.user.id"
                        >
                            <option
                                v-for="item in users"
                                :key="item.id"
                                :value="item.id"
                            >
                                {{ item.id }} -
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <md-button data-dismiss="modal"> Kapat </md-button>
                        <md-button
                            class="md-primary"
                            @click.prevent="editedproduct"
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
        axios.get("/api/products").then((res) => (this.products = res.data));
        axios
            .get("/api/categories")
            .then((response) => (this.category = response.data));
        axios.get("/api/alluser").then((res) => (this.users = res.data));
    },
    data() {
        return {
            addproduct: {
                file: "",
                name: "",
                price: 0,
                description: "",
                quantity: 0,
                user: "",
            },

            users: [],
            products: [],
            search: "",
            allcategories: [],
            categories: "",
            selectproduct: "",
            category: "",
            topcategory: null,
            subcategory: null,
            selectedproduct: {
                id: "",
                file: "",
                name: "",
                price: 0,
                description: "",
                quantity: 0,
                user: "",
            },
        };
    },
    filters: {
        date: function (value) {
            value = value.toString();
            return value.slice(0, 10);
        },
    },
    computed: {
        filteredproducts: function () {
            this.search = this.search.toLowerCase();
            return this.products.filter(
                (item) =>
                    item.name.toLowerCase().includes(this.search) ||
                    item.user.name.toLowerCase().includes(this.search) ||
                    item.slug.toLowerCase().includes(this.search) ||
                    item.id == this.search
            );
        },
    },
    methods: {
        editedproduct() {
            const formData = new FormData();
            formData.append(
                "image",
                this.selectedproduct.file,
                this.selectedproduct.file.name
            );
            formData.append("id", this.selectedproduct.id);
            formData.append("name", this.selectedproduct.name);
            formData.append("price", this.selectedproduct.price);
            formData.append("description", this.selectedproduct.description);
            formData.append("quantity", this.selectedproduct.quantity);
            formData.append("user", this.selectedproduct.user.id);
            axios
                .post("/api/editedproduct", formData)
                .then((res) => (this.products = res.data));
        },
        editproduct(id) {
            axios
                .post("/api/editproduct", { id: id })
                .then((res) => (this.selectedproduct = res.data));
        },
        getPhoto(path) {
            return "/storage/" + path;
        },
        createproduct() {
            const formData = new FormData();
            formData.append(
                "image",
                this.addproduct.file,
                this.addproduct.file.name
            );
            formData.append("name", this.addproduct.name);
            formData.append("price", this.addproduct.price);
            formData.append("description", this.addproduct.description);
            formData.append("quantity", this.addproduct.quantity);
            formData.append("user", this.addproduct.user);

            axios
                .post("/api/createproduct", formData)
                .then((res) => (this.products = res.data));
        },
        handleOnchange(e) {
            this.addproduct.file = e.target.files[0];
        },
        handleOnchange2(e) {
            this.selectedproduct.file = e.target.files[0];
        },
        getcategories(id) {
            axios
                .post("/api/getcategories", { id: id })
                .then((res) => (this.categories = res.data));
            this.selectproduct = id;
        },
        deletecategoryproduct(product_id, category_id) {
            axios
                .post("/api/deletecategoryproduct", {
                    product_id: product_id,
                    category_id: category_id,
                })
                .then((res) => (this.categories = res.data));
        },
        addcategory(product_id, category_id) {
            axios
                .post("/api/addproductcategory", {
                    product_id: product_id,
                    category_id: category_id,
                })
                .then((res) => (this.categories = res.data));
            this.topcategory = null;
            this.subcategory = null;
        },
        deleteproduct(id) {
            axios
                .post("/api/deleteproduct", { id: id })
                .then((res) => (this.products = res.data));
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

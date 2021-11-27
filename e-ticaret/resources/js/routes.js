import Home from "./components/Home"
import Account from "./components/Account"
import Shopcart from "./components/Shopcart"
import Follows from "./components/Follows"
import Contact from "./components/Contact"
import ProductDetail from "./components/ProductDetail"
import Login from "./components/Login"
import Register from "./components/Register"
import AdminUsers from "./components/admin/Users"
import AdminHome from "./components/admin/Home"
import AdminCategories from "./components/admin/Category"
import AdminProducts from "./components/admin/Products"
import AdminShopcarts from "./components/admin/Shopcart"
import AdminReviews from "./components/admin/Reviews"
import AdminSettings from "./components/admin/Settings"
import AdminContact from "./components/admin/Contact"

export default {
    mode: "history",

    routes: [
        {
            path: "/",
            component: Home,
            name: "Home"
        }, {
            path: "/hesabim",
            component: Account
        }, {
            path: "/sepetim",
            component: Shopcart
        }, {
            path: "/begendiklerim",
            component: Follows
        }, , {
            path: "/iletisim",
            component: Contact
        }, {
            path: "/urun/:product",
            component: ProductDetail,
            name: "ProductDetail"
        }, {
            path: "/kayit",
            component: Register
        }, {
            path: "/giris",
            component: Login
        }, {
            path: "/admin/",
            component: AdminHome
        }
        , {
            path: "/admin/kullanicilar",
            component: AdminUsers
        }, {
            path: "/admin/kategoriler",
            component: AdminCategories
        }, {
            path: "/admin/urunler",
            component: AdminProducts
        }, {
            path: "/admin/sepetler",
            component: AdminShopcarts
        }, {
            path: "/admin/yorumlar",
            component: AdminReviews
        }, {
            path: "/admin/ayarlar",
            component: AdminSettings
        }, {
            path: "/admin/contact",
            component: AdminContact
        }
    ]
}
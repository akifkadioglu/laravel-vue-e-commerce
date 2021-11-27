<template>
    <div class="footer bg-dark text-light">
        <div></div>
        <div>
            {{ data }} | <router-link to="/iletisim">İletişim</router-link>
        </div>
        <div></div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: "A'dan Z'ye Buldum ®",
        };
    },
};
</script>
<style>
.footer {
    position: absolute;
    bottom: 0%;
    width: 100%;
    padding: 10px;
    text-align: center;
}
</style>

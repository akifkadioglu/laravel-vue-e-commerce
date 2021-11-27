<template>
    <div class="col-sm-3">
        <div class="full-control">
            <div class="list">
                <md-list :md-expand-single="expandSingle">
                    <md-list-item
                        md-expand
                        v-for="item in category"
                        :key="item.id"
                        v-if="item.parent_id == null"
                    >
                        <span class="md-list-item-text">{{ item.name }}</span>

                        <md-list slot="md-expand">
                            <md-list-item
                                v-for="sub in category"
                                :key="sub.id"
                                v-if="sub.parent_id == item.id"
                                class="md-inset"
                                ><div class="block">
                                    <div class="input">
                                        <md-checkbox
                                            v-model="select"
                                            :value="sub.id"
                                            >{{ sub.name }}</md-checkbox
                                        >
                                    </div>
                                </div>
                            </md-list-item>
                        </md-list>
                    </md-list-item>
                </md-list>
            </div>
        </div>
        <div class="navbar">
            <div class="row">
                <div class="col-sm-6">
                    <md-field>
                        <label>En Düşük</label>
                        <span class="md-prefix">₺</span>
                        <md-input v-model="min"></md-input>
                    </md-field>
                </div>
                <div class="col-sm-6">
                    <md-field>
                        <label>En Fazla</label>
                        <span class="md-prefix">₺</span>
                        <md-input v-model="max"></md-input>
                    </md-field>
                </div>
            </div>
        </div>
        <md-button @click="getCategory(select, min, max)">
            Filtreyi Kullan
        </md-button>
    </div>
</template>

<script>
export default {
    props: {
        getCategory: Function,
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/categories")
            .then((response) => (this.category = response.data));
    },
    data() {
        return {
            category: [],
            select: [],
            min: 0,
            max: 100000000,
            expandSingle: false,
        };
    },
};
</script>
<style lang="scss" scoped>
$list-width: 320px;

.full-control {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap-reverse;
}

.list {
    width: $list-width;
}

.full-control > .md-list {
    width: $list-width;
    max-width: 100%;
    height: 400px;
    display: inline-block;
    overflow: auto;
    border: 1px solid rgba(#000, 0.12);
    vertical-align: top;
}

.control {
    min-width: 250px;
    display: flex;
    flex-direction: column;
    padding: 16px;
}
</style>

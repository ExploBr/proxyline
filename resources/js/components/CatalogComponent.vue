<template lang="">
    <div>
        <template v-for="(item, index) in catalog_data" :key="index">
            <div class="mt-50"> 
            <div class="from-group d-flex w-100 g-10 a-bottom mb-25 mt-25 w-100">
                <label>Страница для вывода</label>
                <v-select :options="allPage" v-model="item.page" class="w-50"></v-select>
            </div>
                        <div class="from-group d-flex w-100 g-10 a-bottom mb-25 mt-25 w-100">
 
                                <label>Url</label>
                                <v-select multiple :options="allPage" v-model="item.links" class="w-50"></v-select>
  
                                
                        </div>

                 
                    </div>
        </template>
        <button type="submit" class="btn btn-primary mt-25" @click.prevent="addMenu()">Добавить меню</button>
        <button type="submit" class="btn btn-primary mt-25 d-flex" @click.prevent="addCatalog()">Обновить</button>
    </div>
</template>
<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import api from "../api";
export default {
    name:'CatalogComponent',
    components:{
        vSelect
    }, 
    props:[
        'all_page','catalog'
    ],
    data() {
        return {
            allPage:[],     
            catalog_data: this.catalog === null || this.catalog === undefined ? [{"page":"", "links":[]}] : this.catalog,
        }
    },
    mounted() {
        this.allPage.push('#')
        this.all_page.forEach(element => {
            this.allPage.push(element.slug)
        });
    },
    methods: {
        addMenu(){
            this.catalog_data.push({'page':'',"links":[]})
        },
        addCatalog(){
            api.post('/api/auth/admin/catalog', {catalog:this.catalog_data})
        }
    },
}
</script>
<style >
    .mt-50{
        margin-top:50px;
    }
</style>
<template lang="">
    <div>
        <template v-for="(item, index) in metas" :key="index">
            <div class="from-group"   v-if="item.lang == newlang">

                    <div class="from-group" v-if="item.name=='code_country' || item.name=='name_country'">
                        <label>{{ getTitle(item.name) }}</label>
                        <input v-model="item.content">
                    </div>
                    <div class="from-group" v-else>
                        <label for="">{{ getTitle(item.name) }}</label>
                            <textarea v-model="item.content" :id="item.name" :ref="item.name">
                                          
                            </textarea>
                    </div>
 

            </div>
        </template>
         

           
    </div>
</template>
<script>
export default {
    name: "MainComponent",

    props:['metas', 'newlang'],

    mounted() {
        console.log(this.newlang);
 
    },
    methods: {
        getTitle(name){
            if (name == 'ipv_content_top'){
                return 'Изображение Сверху'
            }
            if (name == 'ipv_content_bottom'){
                return 'Контент Снизу'
            }
            if (name == 'code_country'){
                return 'Код для страны'
            }
            if (name == 'name_country'){
                return 'Название для главной'
            }

            return name
        }
    },
    computed:{

    }
     
}
</script>
<style lang="">
    
</style>
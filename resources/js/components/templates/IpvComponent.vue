<template lang="">
    <div>
        <template v-for="(item, index) in metas" :key="index">
            <div class="from-group"   v-if="item.lang == newlang">

                <div class="from-group" >
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

            return name
        }
    },
    computed:{

    }
     
}
</script>
<style lang="">
    
</style>
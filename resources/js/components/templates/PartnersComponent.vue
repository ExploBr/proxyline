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
    name: "PartnersComponent",

    props:['metas', 'newlang'],

    mounted() {
        console.log(this.newlang);
 
    },
    methods: {
        getTitle(name){
            if (name == 'steps'){
                return 'Шаги'
            }
            if (name == 'trafic'){
                return 'Типы трафиика'
            }
            if (name == 'zagolovok'){
                return 'Заголовок с изображением'
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
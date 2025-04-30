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
    name: "CenyComponent",

    props:['metas', 'newlang'],
    beforeCreate(){
        if(this.metas.length == 0){
            this.metas.push({name:'ceny_zagolovok',content:"", lang: this.newlang})
        }
    },
    mounted() {
        console.log(this.metas);
         
    },
    methods: {
        getTitle(name){
            if (name == 'ceny_zagolovok'){
                return 'Заголовок на странице'
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
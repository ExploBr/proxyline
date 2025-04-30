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
    name: "OptComponent",

    props:['metas', 'newlang'],

    mounted() {
        console.log(this.newlang);
 
    },
    methods: {
        getTitle(name){
            if (name == 'opt_kolvo'){
                return 'Количество'
            }
            if (name == 'opt_content'){
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
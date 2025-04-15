<template lang="">
    <div>
        <template v-for="(item, index) in metas" :key="index">
            <div class="from-group"   v-if="item.lang == newlang">

                <div class="from-group" >

                    <label for="title">{{ getTitle(item.name) }}</label>
                    <input class="form-control"
                    value="" v-model="item.content"
                    type="text"   :id="item.name">

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
            if (name == 'zagolovok'){
                return 'Заголовок'
            }
            if (name == 'podzagolovok'){
                return 'Подзаголовок'
            }

            return name
        }
    },
     
}
</script>
<style lang="">
    
</style>
<template lang="">
    <div>
        <template v-for="(item, index) in metas" :key="index">
            <div class="from-group"   v-if="item.lang == newlang">

                <div class="from-group" >
                        <label for="">{{ getTitle(item.name) }}</label>

                        <input class="form-control"
                        value="" v-model="item.content"
                        type="text"   id="zagolovok">
                            
                    </div>
 

            </div>
        </template>
    
    </div>
</template>
<script>
export default {
    name: "ContactComponent",

    props:['metas', 'newlang'],


    methods: {
        getTitle(name){
            if (name == 'zagolovok'){
                return 'Заголовок для отображения'
            }

            return name
        }
    },
}
</script>
<style lang="">
    
</style>
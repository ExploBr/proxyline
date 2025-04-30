<template lang="">
    <div>
        <div v-if="metas"> 
        <template v-for="(item, index) in metas" :key="index">
            <div class="from-group"   v-if="item.lang == newlang">

                <div class="from-group" v-if="item.name == 'class'">
                        <label for="">{{ getTitle(item.name) }}</label>

                        <input class="form-control"
                        value="" v-model="item.content"
                        type="text"   id="zagolovok">
                            
                </div>
                <div class="fom-group d-flex mt-25" v-else-if="item.name == 'partner_block'">
                     

                        <input  class="custom__checkbox"
                         value="yes" v-model="getPublish" @change="checkChange"
                        type="checkbox"   id="zagolovok">
                        <label for="">{{ getTitle(item.name) }}</label>
                            
                </div>
                <div class="from-group" v-else>
                        <label for="">{{ getTitle(item.name) }}</label>

                        <textarea v-model="item.content" :id="item.name" :ref="item.name">
                                          
                        </textarea>
                            
                </div>

 

            </div>
        </template>
        </div>
        <div v-else>
                <div class="from-group" >
                        <label class="mb-25">Изображение к заголовку (Если нужено)</label>
                        <textarea v-model="metas.zagolovok" id="zagolovok" ref="zagolovok"  >
                                        {{ metas.zagolovok }}
                        </textarea>
                    </div>

                    <div class="from-group" >
                        <label class="mb-25">Произвольный класс (для кастомных стилей)</label>
                        <input class="form-control"
                        value="" v-model="metas.class"
                        type="text"   id="class">
                    </div>

                    <div class="from-group d-flex mt-25" >
                         
                        <input class=" custom__checkbox"
                        value="" vlue="true" v-model="metas.partner_block"
                        type="radio"   >
                        <label class="mb-25">Партнерская программа</label>
                    </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "TxtComponent",
    data() {
        return {
            checked:false
        }
    },
    props:['metas', 'newlang'],
    mounted() {
        if(this.metas.length == 1){
            if(this.metas[0].name != 'zagolovok'){
                this.metas.unshift({'name': 'zagolovok', 'content': '', 'lang' : this.newlang})
            }
            else{
                this.metas.push({'name': 'class', 'content': '', 'lang' : this.newlang})
            }
        }
        if(this.metas.length == 2){
            if(this.metas[0].name != 'zagolovok'){
                this.metas.unshift({'name': 'zagolovok', 'content': '', 'lang' : this.newlang})
            }
            if(this.metas[1].name != 'class'){
                this.metas.splice(1,0,{'name': 'class', 'content': '', 'lang' : this.newlang})
            }  
            else{
                this.metas.push({'name': 'partner_block', 'content': '', 'lang' : this.newlang})
            }
        }
         console.log(this.metas);
    },
    methods: {
        getTitle(name){
            if (name == 'zagolovok'){
                return 'Изображение'
            }
            if (name == 'class'){
                return 'Произвольный класс'
            }
            if (name == 'partner_block'){
                return 'Партнеры'
            }

            return name
        },
        checkChange(){
            if(this.metas.length == 3){
                        if(this.metas[2].name == 'partner_block'){
                            if(this.metas[2].content == 0){
                                this.metas[2].content = 1
                            }else{
                                this.metas[2].content = 0
                            }
                        }
                        }
          
        }

    },
    computed:{
     

            getPublish:{
                get() {
                    if(this.metas.length == 3){
                        if(this.metas[2].name == 'partner_block'){
                        return this.metas[2].content == 1 ?  true :  false
                        }
                        }
                },
            
            
            }
       
    }
    
}
</script>
<style lang="">
    
</style>
<template lang="">
    <div>
        <div v-if="metas.length > 0"> 
        <template v-for="(faq, index) in metas" :key="index">
            <div class="from-group"   v-if="faq.lang == newlang">
                <h2 class="mt-25"> {{ getTitle(faq.name)}}</h2>
                <template v-for="(item, index) in faq.content" :key="index">
                    
                    <div class="from-group d-flex g-10 mt-25" >
                            <input class="form-control w-40"
                            value="" v-model="item.faq"
                            type="text"   id="" placeholder="Вопрос">
                            <input class="form-control  w-40"
                            value="" v-model="item.answer"
                            type="text"   id="" placeholder="Ответ">
                            <button type="submit" class="btn btn-primary  h-50" @click.prevent="removeFaq(faq.content,index)">X</button>
                        </div>
                </template>
                <button type="submit" class="btn btn-primary mt-25" @click.prevent="addFaq(faq.content)">Добавить faq</button>
            </div>
        </template>
        </div>
       
    </div>
</template>
<script>
export default {
    name: "FaqComponent",
    data() {
        return {
            checked:false,
            faq: 
                {
                    faq1:[{'faq':'','answer':''}],
                    faq2:[{'faq':'','answer':''}]
                },
        }
    },
    props:['metas', 'newlang'],
    mounted() {
        console.log(this.metas[0].content);
    },
    methods: {
     
        getTitle(name){
            if (name == 'faq1'){
                return ' Общая информация о прокси'
            }
            if (name == 'faq2'){
                return ' Общие вопросы по работе сервиса'
            }
        },

        removeFaq(data,index){
            data.splice(index, 1);   
        },
        addFaq(data){
            data.push({  
                    faq: '', 
                    answer:''
                });
                console.log(this.faq);
        },

    },
    computed:{
     
 
       
    }
    
}
</script>
<style lang="">
    
</style>
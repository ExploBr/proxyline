<template lang="">
    <div>
      
            <calculator-item v-for="(item, index) in calculator_info"
             :key="index"
             :type="item.type"
             :ip_type="item.ip_type"
             :index="index"
             :title="item.title"
             :text_after_title="item.text_after_title"   
             :lang = "lang"
             
             @type="type = $event"
             @ip_type="ip_type = $event"
            
              >
            </calculator-item>
          
         
         
    </div>
</template>
<script>
import axios from "axios";
import api from "../../api"
import { getActiveLanguage } from 'laravel-vue-i18n';
 
import CalculatorItem from "./CalculatorItem.vue";
export default {
    name:'CalcutatorComponent',
    props:[
        'data_calculator','calculator_info'
    ],
    data() {
        return {      
             
            type: '',
            ip_type: '',    
             
            lang:getActiveLanguage(),
            
             
        }
    },
    
    mounted() {
        
         
    },
    methods: {
         
         
         

    },
    components:{
        CalculatorItem
    }

}
</script>
<style lang="">
    
</style>
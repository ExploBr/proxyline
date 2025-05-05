<template lang="">
    <div>
        <div class="container"> 
        <div class="calculator__main--wrapper"> 
            <calculator-item v-for="(item, index) in calculator_info"
             :key="index"
             :type="item.type"
             :ip_type="item.ip_type"
             :index="index"
             :title="item.title"
             :text_after_title="item.text_after_title"   
             :lang = "lang"
             :display_modal_info = "display_modal_info"
             @type="type = $event"
             @ip_type="ip_type = $event"
             @display_modal_info="display_modal_info = $event"
             :crf = "crf"
              >
            </calculator-item>
        </div>  

            <div class="redcolor redcd" style="">
            <img src="/storage/images/onlywhite.svg" style="margin-right: 15px" alt="white">
            <span> {{$t('Attention!!! Our proxies are suitable only for white targets')}}</span>
            </div>

            <div class="agreement_info">
                {{$t('By purchasing our proxies you agree to the terms')}}
                <a href="/polzovatelskoe-soglashenie/" v-if="lang == 'ru'">{{$t('user agreement')}}</a>
                <a :href="'/'+lang+'/polzovatelskoe-soglashenie/'" v-else>{{$t('user agreement')}}</a>

                 {{$t('and')}} <a href="/private-policy/" v-if="lang == 'ru'">{{$t('privacy policy')}}</a> 
                                <a :href="'/'+lang+'/private-policy/'" v-else>{{$t('privacy policy')}}</a> 
                </div>
         

                 
            <template v-for="(item, index) in modal_info" :key="index">
                <div :id="'calculator_modalinfo--'+index" v-if="this.display_modal_info == index+1" class="calculator_modalinfo">
                    <div class="calculator_modalinfo--wrapper">
                        <div class="" v-html="item.popup">
                             
                        </div>
                        <button @click.prevent="displayModalInfo" class="close__b">×</button>
                    </div>
                </div>
            </template>


        </div>

        <div class="bottompart__wrapper" ref="ref"> 
            <div class="container"> 
                <span>{{$t('Many payment methods:')}}</span>
                <swiper-container 
                   init="false"
                   class="bottompart__slider"
                  >
                  <template  v-for="(item, index) in bottompart" > 
                    <swiper-slide class="swiper__item" >
                        <img :src="item.image+'.svg'" alt="socials">
                        <img :src="item.image+'1.svg'" alt="socials" loading="lazy">
                    </swiper-slide>
                    
                </template>
                 
                </swiper-container>
            </div>
        </div>

    </div>
</template>
<script>
import { register } from 'swiper/element/bundle';
 
 
import axios from "axios";
import api from "../../api"
import { getActiveLanguage } from 'laravel-vue-i18n';
 
import CalculatorItem from "./CalculatorItem.vue";


 
   

export default {
    name:'CalcutatorComponent',
    props:[
        'data_calculator','calculator_info', 'modal_info', 'crf'
    ],
    data() {
        return {      
            
            type: '',
            ip_type: '',    
            display_modal_info:0,
            lang:getActiveLanguage(),
            bottompart:[
                { "image": "/storage/images/bottompart/visa"},
                { "image": "/storage/images/bottompart/card"},
                { "image": "/storage/images/bottompart/wm"},
                { "image": "/storage/images/bottompart/bt"},
                { "image": "/storage/images/bottompart/qw"},
                { "image": "/storage/images/bottompart/t"},
                { "image": "/storage/images/bottompart/et"},
                { "image": "/storage/images/bottompart/fk"},
                { "image": "/storage/images/bottompart/lc"},
                { "image": "/storage/images/bottompart/pm"},
                { "image": "/storage/images/bottompart/dg"},
                { "image": "/storage/images/bottompart/ym"},
            ]
             
        }
    },
    
    
    mounted() {
         
        const swiperEl = document.querySelector('swiper-container');

        const swiperParams = {
            
            speed:800,
         
            loop:true,

            autoplay: {
                delay: 2000,
            },
            breakpoints: {
            250: {
                slidesPerView: 3,
            },
            650: {
                slidesPerView: 5,
            },
            900: {
                slidesPerView: 7,
            },
            1200:{
                slidesPerView: 10,
            },
            },
            on: {
            init() {
                // ...
            },
            },
        };

        
            register();
            Object.assign(swiperEl, swiperParams);
            swiperEl.initialize();
   
         
    },
    
    methods: {
        displayModalInfo(){
            document.querySelector('html').classList.remove('menu__show')
            this.display_modal_info = 0
        }
    },
    computed:{
       
    },
    components:{
        CalculatorItem,
      
    }

}
</script>
<style lang="">
    
</style>
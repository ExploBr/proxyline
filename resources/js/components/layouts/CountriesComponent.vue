<template lang="">
    <div >
        <template v-for="(item, mainindex) in catalogpages" :key="mainindex">
            <div :class="mainindex == 0 ? 'tabcontent show' : 'tabcontent hide'"  >
                <!-- <p v-if="index == 0" class="all__proxy--title">{{ $t('Select IP address of the country') }}</p>-->
                <ul class="all__proxy--all">
                    <li v-for="(item, index) in item.links" :key="index" class="all__proxy--item">
                        <a :href="lang == 'ru' ? '/' + item.slug : '/' + lang + '/' + item.slug">
                            <span v-html="item.meta.ipv_content_top"></span>
                            <template v-if="item.meta.name_country">{{item.meta.name_country}}</template>
                            <template v-else>{{item.title}}</template>
                         </a> 
                        <i :class="'show--modal ' + item.meta.code_country" @click="showModal(item.meta.code_country,item.meta.name_country, item.meta.ipv_content_top)" v-if="mainindex == 0"> </i>
                        <Transition name="fade">
                            <div v-if="countries[index] != null && code == countries[index].code" class="modal__info" >
                                <div class="proxy--modal__title">
                                    <span v-html="img"></span>
                                    <p>{{title}}</p>
                                </div>
                                <div v-html="countries[index].content" class="proxy--modal__content">

                                </div>
                                <div class="close__b" @click="unShowModal">

                                </div>
                            </div>
                        </Transition>
                     
                    </li>
                </ul>
            </div>
        </template>
       
    </div>
</template>
<script>

 


 import { getActiveLanguage } from 'laravel-vue-i18n';
export default {
    name:"CountriesComponent",
    props:[
        'catalogpages', 'countries'
    ],
    
    
    data() {
        return {
            lang:getActiveLanguage(),
            code:'',
            title:'',
            img:''
        }
    },
     

    mounted() {
        console.log(this.countries);
        console.log(this.catalogpages);
        const div = document.querySelector( '.all__proxy--item')
        document.addEventListener( 'click', (e) => {
            const withinBoundaries = e.composedPath().includes(div);
        
            if ( ! withinBoundaries ) {
                this.unShowModal(); // скрываем элемент т к клик был за его пределами
            }
        })
         
    },
 
    methods: {
        showModal(code,title,img){
            console.log('object');
            this.code = code 
            this.title = title 
            this.img = img 
        },
        unShowModal(code){
         
            this.code = '' 
            this.title = '' 
            this.img = '' 
           
        
        }
    },

 
}
</script>
<style  >
    .fade-enter-active,
    .fade-leave-active {
    transition: opacity 0.3s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
    opacity: 0;
}
 
</style>
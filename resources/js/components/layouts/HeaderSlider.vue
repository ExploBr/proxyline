<template lang="">
    <div>

        <div class="headerslider__wrapper"> 

                <swiper-container 
                   init="false"
                   class="bottompart__slider"
                  >
                  <template  v-for="(item, index) in bottompart" > 
                    <swiper-slide class="swiper__item" >
                        <img :src="item.image+'1.svg'" alt="socials">
                        <img :src="item.image+'2.svg'" alt="socials">
                    </swiper-slide>
                    
                </template>
                 
                </swiper-container>

        </div>

    </div>
</template>
<script>
import { register } from 'swiper/element/bundle';
export default {
    name: "HeaderSlider",
    
    data() {
        return {      
            

            bottompart:[
                { "image": "/storage/images/topicons/t"},
                { "image": "/storage/images/topicons/i"},
                { "image": "/storage/images/topicons/n"},
                { "image": "/storage/images/topicons/v"},
                { "image": "/storage/images/topicons/y"},
                { "image": "/storage/images/topicons/f"},
                { "image": "/storage/images/topicons/p"},
                { "image": "/storage/images/topicons/g"},
                { "image": "/storage/images/topicons/yy"},
                { "image": "/storage/images/topicons/a"},
                { "image": "/storage/images/topicons/q"},
                { "image": "/storage/images/topicons/tt"},
                { "image": "/storage/images/topicons/ttt"},
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

    
}
</script>
<style lang="">
    
</style>
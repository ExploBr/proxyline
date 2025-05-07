<template lang="">
<div  >
    <div class="count__usd count__item" v-scroll="handleScroll">
        <span class="numbers numbers-dollar" style="opacity: 1"><vue3-autocounter ref='counter' :startAmount="0" :endAmount="partner_income" :duration="4" separator="." :autoinit="false"></vue3-autocounter></span>
        <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512" fill="currentColor">
            <path fill="#000000" d="M211.9 242.1L95.6 208.9c-15.8-4.5-28.6-17.2-31.1-33.5C60.6 150 80.3 128 105 128h73.8c15.9 0 31.5 5 44.4 14.1 6.4 4.5 15 3.8 20.5-1.7l22.9-22.9c6.8-6.8 6.1-18.2-1.5-24.1C240.4 74.3 210.4 64 178.8 64H176V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48h-2.5C60.3 64 14.9 95.8 3.1 143.6c-13.9 56.2 20.2 111.2 73 126.3l116.3 33.2c15.8 4.5 28.6 17.2 31.1 33.5C227.4 362 207.7 384 183 384h-73.8c-15.9 0-31.5-5-44.4-14.1-6.4-4.5-15-3.8-20.5 1.7l-22.9 22.9c-6.8 6.8-6.1 18.2 1.5 24.1 24.6 19.1 54.6 29.4 86.3 29.4h2.8v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48h2.5c49.2 0 94.6-31.8 106.4-79.6 13.9-56.2-20.2-111.2-73-126.3z"></path>
        </svg>
    </div>
    <div class="count__rub count__item">
        
        <span class="numbers numbers-rub"> <vue3-autocounter ref='counter2' :startAmount="0" :endAmount="partner_income_usd"  :duration="4" separator="." :autoinit="false"></vue3-autocounter></span>
        <svg aria-hidden="true" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor">
            <path fill="#000000" d="M243.128 314.38C324.987 314.38 384 257.269 384 172.238S324.987 32 243.128 32H76c-6.627 0-12 5.373-12 12v215.807H12c-6.627 0-12 5.373-12 12v30.572c0 6.627 5.373 12 12 12h52V352H12c-6.627 0-12 5.373-12 12v24c0 6.627 5.373 12 12 12h52v68c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-68h180c6.627 0 12-5.373 12-12v-24c0-6.627-5.373-12-12-12H128v-37.62h115.128zM128 86.572h105.61c53.303 0 86.301 31.728 86.301 85.666 0 53.938-32.998 87.569-86.935 87.569H128V86.572z"></path>
        </svg>
    </div>
</div>
</template>

<script>
 
 
import Vue3Autocounter from 'vue3-autocounter';
export default {
    name: "AffilateComponent",
    props:[
        'allstats','course_usd'
    ],
    data() {
        return {
            ifScroll: false,
            partner_income:this.allstats.partner_income,
            partner_income_usd:this.allstats.partner_income * this.course_usd,

        }
    },
    mounted() {
        
    },
    directives: {
    // Определяем локальную директиву `v-scroll`.
    scroll: {
         
      // Хук, срабатывающий при вставке в родительский DOM.
      mounted(element, binding) {
         
        // добавляем слушателя на событие.
        window.addEventListener('scroll', function(event) {
          
          let result = binding.value(event, element)
      
          
        })
      }
    }
  },
    methods: {
        handleScroll(event,element) {
           let MyoffsetTop = element.getBoundingClientRect().top + window.pageYOffset;
           
            if((window.scrollY > MyoffsetTop - (window.screen.height)) && this.ifScroll != true){
                this.$refs.counter.start();
                this.$refs.counter2.start();
                this.ifScroll = true;
                console.log(this.ifScroll);
            }
    
        }
    },
    components: {
        'vue3-autocounter': Vue3Autocounter
    }

};
</script>

<style lang=""></style>

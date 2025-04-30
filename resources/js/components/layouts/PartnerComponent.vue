<template lang="">
    <div  class="counter__wrapper">
        <div class="count__usd count__item" v-scroll="handleScroll">
            <span class="numbers numbers-dollar" style="opacity: 1"><vue3-autocounter ref='counter' :startAmount="0" :endAmount="partner_income" :duration="4" separator="." :autoinit="false"></vue3-autocounter> $</span>
 
        </div>
        <div class="count__rub count__item">
            
            <span class="numbers numbers-rub"> <vue3-autocounter ref='counter2' :startAmount="0" :endAmount="partner_income_rub"  :duration="4" separator="." :autoinit="false"></vue3-autocounter> {{$t('MILLION ₽')}}</span>
 
        </div>
    </div>
    </template>
    
    <script>
     
    import Vue3Autocounter from 'vue3-autocounter';
    export default {
        name: "PartnerComponent",
        props:[
            'course_usd',
        ],
        data() {
            return {
                ifScroll: false,
                partner_income: 0,
                partner_income_rub: 0
            }
        },
        mounted() {
            fetch('https://panel.proxyline.net/stats/').then(response => response.json())
            .then((commits) => {
                console.log(commits);
                this.partner_income = Math.round(commits.partner_income),
                this.partner_income_rub = Math.round(commits.partner_income * this.course_usd)
                }
        );
            console.log(this.course_usd);
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

                
                if(window.scrollY > element.offsetTop - (window.screen.height) && this.ifScroll != true && this.partner_income > 0){       
                                  
                        this.$refs.counter.start();
                        this.$refs.counter2.start();
                        this.ifScroll = true;

                }
        
            }
        },
        components: {
            'vue3-autocounter': Vue3Autocounter
        }
    
    };
    </script>
    
    <style lang=""></style>
    
<template lang="">
    <div class="banner__info">
        <div class="banner__info--wrapper"> 
                <div class="banner__block">
                    <i> 
                    <img src="/storage/images/header/i2.svg" alt="">
                    <img class="hover" src="/storage/images/header/i2-hover.svg" alt="">
                    </i>
                    <p v-if="langthis == 'ru'"> клиентов выбрали нас</p> <p v-else>{{ $t('clients chose us') }}</p><span><vue3-autocounter ref='counter' :startAmount="0" :endAmount="userCount"  :duration="4" separator=" "></vue3-autocounter></span>
                </div>
                <div class="banner__block">
                    <i> 
                    <img src="/storage/images/header/i3.svg" alt="">
                    <img class="hover" src="/storage/images/header/i3-hover.svg" alt="">
                    </i>
                    <p v-if="langthis == 'ru'"> повторных заказов</p> <p v-else>{{ $t('repeat orders') }}</p> <span><vue3-autocounter ref='counter' :startAmount="0" :endAmount="procentZakaz"  :duration="4" separator=" "></vue3-autocounter>%</span>
                </div>
                <div class="banner__block">
                    <i> 
                    <img src="/storage/images/header/i1.svg" alt="">
                    <img class="hover" src="/storage/images/header/i1-hover.svg" alt="">
                    </i>
                    <p v-if="langthis == 'ru'"> Прокси в работе</p><p v-else>{{ $t('Proxy at work') }}</p> <span><vue3-autocounter ref='counter' :startAmount="0" :endAmount="activeProxy"  :duration="4" separator=" "></vue3-autocounter></span>
                </div>
                <div class="banner__block">
                    <i> 
                    <img src="/storage/images/header/i4.svg" alt="">
                    <img class="hover" src="/storage/images/header/i4-hover.svg" alt="">
                    </i>
                    <p v-if="langthis == 'ru'"> заказов обработано</p> <p v-else>{{ $t('orders processed') }}</p> <span><vue3-autocounter ref='counter' :startAmount="0" :endAmount="orderCount"  :duration="4" separator=" "></vue3-autocounter></span>
                </div>
                <a href="" class="buy__btn" v-if="langthis == 'ru'">Аренда индивидуальных прокси от 5 дней</a>
                <a href="" class="buy__btn" v-else>{{ $t('Rent individual proxies from 5 days') }}</a>

                <div class="garant__block">
                    <div class="garant__block--img"> 
                        <img src="/storage/images/header/i5.svg" alt="">
                        <img class="hover" src="/storage/images/header/i5-hover.svg" alt="">
                    </div>
                    <div class="garant__wrapper"> 
                        <p v-if="langthis == 'ru'">гарантия на возврат денег</p> 
                        <p v-else>{{ $t('money back guarantee') }}</p> 
                        <span v-if="langthis == 'ru'">48 часов</span>
                        <span v-else>{{ $t('48 hours') }}</span>
                    </div>
                </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Vue3Autocounter from 'vue3-autocounter';
export default {
    name: 'StatsData',
    props:[
        'lang'
    ],
    data() {
        return {
            userCount:0,
            totalProxy:0,
            orderCount:0,
            activeProxy:0,
            procentZakaz:0,
            langthis: this.lang

        }
    },
    mounted() {
         
        fetch('https://panel.proxyline.net/stats/').then(response => response.json())
        .then((commits) => {
            console.log(commits);
            this.activeProxy = commits.active_proxy_count,
            this.orderCount = commits.order_count,
            this.totalProxy = commits.total_proxy_count,
            this.userCount = commits.user_count
            this.procentZakaz = 91
            }
        );
    },

    components: {
        'vue3-autocounter': Vue3Autocounter
    }
}
</script>
<style lang="">
    
</style>
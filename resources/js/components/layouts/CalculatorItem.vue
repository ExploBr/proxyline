<template lang="">
 
        <div :class="'calculator' + ' calculator'+index"  >
                <div class="calculator__wrapper" :id="'calc'+index" >
                    <template v-if="index == 2">
                        <div class="calc__animation">
                            <img v-if="lang == 'ru'" src="/storage/images/ani/ani-ru.png" alt="Анимация proxyline">
                            <img v-else src="/storage/images/ani/ani1.png" alt="Анимация proxyline 2">

                            <img src="/storage/images/ani/ani2.png" alt="Анимация proxyline 3">
                            <img src="/storage/images/ani/ani3.png" alt="Анимация proxyline 4">
                        </div>
                    </template>
                     
                    <h3>
                        <a href="#">{{$t(`${title}`)}}</a>
                        <span data-fancybox  :data-src="'#vozmitediv__'+index">{{$t('See for what purposes')}}</span>
                    </h3>
                    <div class="calculator__after--titile">{{$t(`${text_after_title}`)}}</div>

                    <div class="calc__row">
                        <label>{{$t('See for what purposes')}}</label>
                        <div class="country__list">
                            <div class="country__list--wrapper">
                                <div class="country__list--current" @click="openCountries=!openCountries">
                                    <span class="flag" :style="flagStyle"></span>
                                    <span v-text="countryFull"></span>
                                </div>

                                <div  v-show="openCountries" class="country__dropdown--content">
                                            <div class="search__country">
                                                <input type="text" v-model="countryQuery" :placeholder="$t('Search country')">
                                            </div>
                                            <ul>
                                                <template v-for="item in countries">
                                                    <li :class="clc(item.code)" @click="setCountry(item.code)" v-show="item.show">
                                                                <span class="flag"
                                                                      :style="'background-image: url('+ item.flag_small +')'"></span>
                                                       
                                                         <span v-text="item.full" class="wpd-dropdown__name"></span>
                                                         
                                                    </li>
                                                </template>
                                                <template v-if="!findCountry">
                                                    <li class="country__notfount">
                                                        {{$t('Country not found', 'proxyline')}}
                                                    </li>
                                                </template>
                                            </ul>
                                </div>
                                
                            </div>

                        </div>
                    </div>


                    <div class="calculator__data">
                        <div class="calc__row">
                                    <label>{{$t('Qty')}}<span class="q__info" :data-tooltip="$t('Limit for 1 order - up to 2000 proxies')">?</span></label>
                                    <div class="in">
                                        <div class="qty__block">
                                            <button type="button" @click="qtyMinus">-</button>
                                            <input type="number" class="price__number" v-model="count"
                                                   @change="countValidate" min="1" pattern="[0-9]{3}">
                                            <button type="button" @click="qtyPlus">+</button>
                                        </div>
                                    </div>
                        </div>

                        <div class="calc__row">
                                    <label>{{$t('Price per piece')}}</label>
                                    <div class="value__row">
                                        <template v-if="lang == 'ru'"> 
                                            <span class="value"><span v-text="price"></span> $</span>
                                            <span class="value__info">≈<span
                                                        v-text="price_rub"></span> ₽</span>
                                            <span class="q__info"
                                                  :data-tooltip="'Курс ЦБ: 1$ =   ₽'">?</span>
                                        </template>
                                        <template v-else>
                                            <span class="value"><span
                                                v-text="price"></span> $</span>
                                        </template>
                                             
                                    </div>
                        </div>


                    </div>

                    
                    <input type="hidden" :value="type">
                    <input type="hidden" :value="ip_type">
                     
                </div>
            </div>
 
</template>
<script>
 import { getActiveLanguage } from 'laravel-vue-i18n';
export default {
    name:"CalculatorItem",
    props:[
        'index', 'type' , 'text_after_title', 'title', 'ip_type',  'lang',
    ],

    data() {
        return {
            countryFull: '',
            flag: '',
            open: false,
            country: getActiveLanguage() == 'ru' ? 'ru' : 'us',
            countries: [],
            openCountries: false,
            openCountriesManual: false,
            countryQuery: '',
            findCountry: true,
            count: 1,
            default_limit: 2000,
            limit: 2000,
            limits: [],
            period: 5,

            prices: [],
            price: 0,
            sale_price: 0,
            price_usd: 0,
            price_rub: 0,
            total: 0,
            total_sale: 0,
            total_usd: 0,
            total_rub: 0,
            sale:  0,
            show_sale: false,
            usd_curse: 0,

            openManually: false,
            list: [],
            filter_list: [],
            search: '',
            select_proxy: [],
        }
    },
     
    mounted() {
       this.$emit('type', this.type);
       this.$emit('ip_type', this.ip_type);
        

      this.setData(this.$parent.data_calculator);  
      
      
      this.filterCountries();

      this.$watch('country', ()=>{
                this.getPrice();
                this.getProxyList();
                this.setLimit();
        });

        this.$watch('count', ()=>{
                if(this.count > this.limit) this.count = this.limit;
                this.getPrice();
        });

 
        this.$watch('period', ()=>{
                this.getPrice();
            });

        this.$watch('select_proxy', ()=>{
                if( this.select_proxy.length >= 1 ) {
                    this.count = this.select_proxy.length;
                }
        });


        this.$watch('search', ()=>{
                this.filterListProcess();
            });

        this.$watch('countryQuery', ()=>{
                this.searchCountry();
            });

            
    },

    methods: {
        setData: async function(data_calculator) {
            // set countries
            
             
            this.countries = data_calculator.countries[this.type+':'+this.ip_type];

            
             this.filterCountries();
            
            this.setCountry(this.country);
            
            //set prices
            this.prices = data_calculator.prices.prices;
            this.usd_curse = data_calculator.prices.rub;
            this.getPrice();

            //set limits
            this.default_limit = data_calculator.limits.default_limit;
            this.limits = data_calculator.limits.limits;
            this.setLimit();

           
            
        },
         
        clc(code) {
            return {
                selected: this.country === code
            }
        },


        

        filterCountries(){
            for (const property in this.countries) {
                this.countries[property].show = true;
                this.countries[property].full = this.lang === 'ru'
                    ? this.countries[property].name_ru + ' ('+  this.countries[property].name_local +')'
                    : this.countries[property].name + ' ('+  this.countries[property].name_local +')';
            }
        },

        searchCountry(){
            this.filterCountries();
            this.findCountry = false;
            for (const property in this.countries) {
                if (
                    this.countries[property]['name'].toLowerCase().includes(this.countryQuery.toLowerCase()) ||
                    this.countries[property]['name_ru'].toLowerCase().includes(this.countryQuery.toLowerCase()) ||
                    this.countries[property]['name_local'].toLowerCase().includes(this.countryQuery.toLowerCase())
                ) {
                    this.countries[property].show = true;
                    this.findCountry = true;
                }
                else {
                    this.countries[property].show = false;
                }
            }
        },

        setCountry(code) {
            this.country = code;
            this.openCountries = false;
            for (var prop in this.countries) {
                if( prop === this.country ) {
                    this.flag = this.countries[prop].flag_small;
                    this.countryFull = this.countries[prop].full;
                    
                }
            }

            if( this.countryFull === '' )  {

                var firstKey = Object.keys(this.countries)[0];
                this.country = this.countries[firstKey].code;
                this.flag = this.countries[firstKey].flag_small;
                this.countryFull = this.countries[firstKey].full;
            }
        },

         

        roundAmount(amount) {
            return Math.ceil(amount * 100) / 100
        },

        qtyPlus() {
            this.count++;
            if( this.select_proxy.length ) {
                this.count = this.select_proxy.length;
            }
        },

        qtyMinus() {
            this.count--;
            if( this.count <= 0 ) this.count = 1;
            if( this.select_proxy.length ) {
                this.count = this.select_proxy.length;
            }
        },

        countValidate() {
            if( this.count <= 0 ) this.count = 1;
        },

        setLimit() {
            var key = [this.country, this.type, this.ip_type].join(':');
            if(key in this.limits) this.limit = this.limits[key];
            else this.limit = this.default_limit;
        },


        getPrice(){
            this.show_sale = false;

            var key = [this.country, this.type, this.ip_type].join(':');

            var values = this.prices[key];

            var min_period = 5;

            var i, n;
            if (values) {
                for (i = 0; i < values.length; i++) {
                    if (values[i][0] <= this.count) {
                        min_period = values[i][1][values[i][1].length - 1][0];
                        for (n = 0; n < values[i][1].length; n++) {
                            if (values[i][1][n][0] <= this.period || values[i][1][n][0] <= min_period) {
                                this.price = values[i][1][n][1];
                                break;
                            }
                        }
                        break;
                    }
                }
            }


            this.price = this.roundAmount(this.price * this.period);

            this.sale_price = this.setSalePrice();
            this.price_rub = (this.sale_price * this.usd_curse).toFixed(2);

            this.total = (this.price * this.count).toFixed(2);

            this.total_sale = (this.sale_price * this.count).toFixed(2);
            this.total_usd = this.total_sale;

            this.total_rub = (this.total_sale * this.usd_curse).toFixed(2);
        },

        setSalePrice(){
            return this.roundAmount(this.price - ( this.price / 100 * this.sale ));
        },

        getProxyList() {
            if( this.ip_type !== 4 ) return;
            fetch(`https://panel.proxyline.net/get-ip-list/?ip_type=${this.type}&ip_version=${this.ip_type}&country=${this.country}`)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    this.list = data;
                    this.filterListProcess();
                });
        },

        filterListProcess() {
            this.filter_list = [];
            var searchString = this.search.toLowerCase();
            for( var i=0; i < this.list.length; i++ ) {
                if( this.list[i].text.toLowerCase().indexOf(searchString) !== -1 ) {
                    this.filter_list.push(this.list[i]);
                }
            }
        },

        itemClass(item){
            return {
                'item': true,
                'active': this.hasInSelected(item)
            }
        },

        hasInSelected(item) {
            for( var i=0; i < this.select_proxy.length; i++ ) {
                if( this.select_proxy[i].id === item.id ) {
                    return true;
                }
            }
            return false;
        },

        pushSelected(item) {
            if( ! this.hasInSelected(item) ) {
                this.select_proxy.push(item);
            }
        },

        removeSelect(item) {
            for( var i=0; i < this.select_proxy.length; i++ ) {
                if( this.select_proxy[i].id === item.id ) {
                    this.select_proxy.splice(i, 1);
                    break;
                }
            }
        },
        open_cm() {
            this.openCountriesManual = !this.openCountriesManual;
            if( this.select_proxy.length ) openCountriesManual = false;
        },

        selectModalClass() {
            return {
                'select-ips': this.select_proxy.length ? true : false
            }
        },
         
    },
    computed:{
        flagStyle() {
            
            return {
                'background-image': 'url('+ this.flag +')'
            };
        },
    }
}
</script>
<style lang="">
    
</style>
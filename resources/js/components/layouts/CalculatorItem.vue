<template lang="">
 
        <div :class="'calculator' + ' calculator'+index"  >
                <div class="calculator__wrapper" :id="'calc'+index" >
                    <template v-if="index == 2">
                        <div class="calc__animation">
                            <img v-if="lang == 'ru'" src="/storage/images/ani/ani-ru.png" alt="Анимация proxyline">
                            <img v-else src="/storage/images/ani/ani1.png" alt="Анимация proxyline 2">

                            <img src="/storage/images/ani/ani2.png" alt="Анимация proxyline 3" loading="lazy">
                            <img src="/storage/images/ani/ani3.png" alt="Анимация proxyline 4" loading="lazy">
                        </div>
                    </template>
                     
                    <template v-if="index ==0">
                         
                            <img v-if="lang == 'ru'" src="/storage/images/musthave_ru.svg" alt="Анимация proxyline" class="individual__calc--svg" loading="lazy">
                            <img v-else src="/storage/images/musthave_en.svg" alt="Анимация proxyline 2" class="individual__calc--svg" loading="lazy">
 
                    </template>

                    <h3>
                        <a href="#">{{$t(`${title}`)}}</a>
                        <span  @click="displayModal(index+1)" :data-src="'#vozmitediv__'+index">{{$t('See for what purposes')}}</span>
                    </h3>
                    <div class="calculator__after--titile">{{$t(`${text_after_title}`)}}</div>

                    <div class="calc__row">
                        <label>{{$t('Country')}}</label>
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
                                                    <li class="country__notfound">
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
                                                  :data-tooltip="$t('Central Bank rate:')+' 1$ = '+usd_curse+' ₽'">?</span>
                                        </template>
                                        <template v-else>
                                            <span class="value"><span
                                                v-text="price"></span> $</span>
                                        </template>
                                             
                                    </div>
                        </div>

                        <div class="calc__row">
                                    <label>
                                        {{$t('Period')}}
                                        
                                    </label>
                                    <div class="in">
                                        <select class="period" v-model="period">
                                            <template v-for="(item, index) in days">
                                                <option   :value="item">{{item}} {{$t('Days')}}</option>
                                            </template>
                                               
                                             
                                        </select>
                                    </div>
                        </div>

                        <div class="calc__row">
                                    <label>{{$t('Type')}}</label>
                                    <div class="value__row">
                                        <span class="value">HTTP / SOCKS5<span class="q__info" :data-tooltip="$t('HTTP/Socks5 output in two formats simultaneously. Unlimited proxy traffic')">?</span></span>
                                    </div>
                        </div>

                        <div class="calc__row">
                                    <label>{{$t('Total payable')}}</label>
                                    <div class="value__row">
                                        <template v-if="lang == 'ru'"> 
                                            <span class="value"><span v-text="total"></span> $</span>
                                            <div class="value__info">≈<span v-text="total_rub"></span> ₽</div>
                                        </template>
                                        <template v-else>
                                            <span class="value"><span v-text="total"></span> $</span>
                                        </template>
                                    </div>
                        </div>

                        
                        <div class="chosed_proxy" v-if="ip_type == 4">
                                        <button type="button" class="btn btn-sm btn-success"
                                                @click="openModalProxy">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog"
                                                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                      d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path>
                                            </svg>
                                            {{$t('Select IP manually')}}
                                        </button>
                        </div>
                        
                        <div class="calc__buy">
                                    <form action="/mainpay/"
                                          method="POST">
                                         <input type="hidden" name="_token" :value="crf"> 
                                        <input type="hidden" name="tarif" :value="'ipv'+ip_type">
                                        <input type="hidden" name="ip_type" :value="type">
                                        <input type="hidden" name="ip_version" :value="ip_type">
                                        <input type="hidden" name="country" v-model="country">
                                        <input type="hidden" name="country_name" v-model="countryFull">
                                        <input type="hidden" name="country_flag" v-model="flag">
                                        <input type="hidden" name="quantity" v-model="count">
                                        <input type="hidden" name="period" v-model="period">
                                        <input type="hidden" name="price" v-model="price">
                                        <input type="hidden" name="price_rub" v-model="price_rub">
                                        <input type="hidden" name="usd_curse" v-model="usd_curse">
                                        <input type="hidden" name="total_rub" v-model="total_rub">
                                        <input type="hidden" name="summ" v-model="total">
                                         
                                        <input v-if="lang == 'ru'" type="hidden" name="total" v-model="total_sale">
                                     
                                        <input v-else type="hidden" name="total" x-model="total_usd">
                                      
                                        <template v-for="item in select_proxy">
                                            <input type="hidden" name="ip_list[]" v-model="item.id">
                                        </template>
                                        <template v-for="item in select_proxy">
                                            <input type="hidden" name="ip_list_name[]" v-model="item.text">
                                        </template>
                                        <button type="submit">{{$t('Buy')}}</button>
                                    </form>
                        </div>


                    </div>
 
                </div>



                <template v-if="ip_type == 4">
                    <div  v-if="openManually" class="select__proxy--overflow"
                                 @click="openManually=!openManually"></div>
                            <div v-if="openManually" class="select__proxy-modal ">
                                <div class="select__proxy-modal--wrapper">
                                    <button class="close__b" @click="openManually = !openManually">×</button>
                                    <div class="proxy-modal__title">{{$t('Select IP manually')}}</div>
                                    <hr>
                                    <div  :class="selectModalClass" class="select-modal__content">
                                        <div class="flex-select-modal__content">
                                            <div class="manually-country-name">

                                                <div class="country__list--wrapper"
                                                     v-show="!select_proxy.length">
                                                    <div class="country__list--current bold--curent" @click="open_cm">
                                                        <span class="flag" :style="flagStyle"></span>
                                                        <span v-text="countryFull"></span>
                                                    </div>
                                                    <div v-show="openCountriesManual"
                                                         class="country__dropdown--content">
                                                        <div class="search__country">
                                                            <input type="text" v-model="countryQuery" :placeholder="$t('Search country')">
                                                        </div>

                                                        <ul class="">
                                                            <template v-for="item in countries">
                                                                <li :class="clc(item.code)" @click="setCountry(item.code)" v-show="item.show">
                                                                <span class="flag"
                                                                      :style="'background-image: url('+ item.flag_small +')'"></span>
                                                       
                                                                <span v-text="item.full" class="wpd-dropdown__name"></span>
                                                                </li>
                                                            </template>
                                                            <template v-if="!findCountry">
                                                                <li class="country__notfound">
                                                                    {{$t('Country not found', 'proxyline')}}
                                                                </li>
                                                            </template>
                                                        </ul>
                                                    </div>
                                                </div>


                                            </div>
                                            <input :placeholder="$t('Search by IP / subnet or city (in Latin)')"
                                                   type="text" v-model="search" class="search_ip">
                                        </div>
                                        <div class="flex-select-modal__content">
                                            <button v-show="select_proxy.length" type="button" class="custom__close btn"
                                                    @click="openManually=false">{{$t('Ready')}}</button>
                                            <div v-show="select_proxy.length" class="selected-proxy__count">
                                                <div>{{$t('Selected')}}<span
                                                            v-text="select_proxy.length"></span></div>
                                            </div>
                                        </div>
                                        <div v-show="select_proxy.length" class="select-modal__select">
                                            <template v-for="item in select_proxy">
                                                <div class="item">
                                                    <span><span class="remove" @click="removeSelect(item)">x</span><span
                                                                v-text="item.text"></span></span>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="select-modal__list">
                                            <div class="select-modal__list-content">
                                                <template v-for="item in filter_list">
                                                    <div :class="itemClass(item)" @click="pushSelected(item)"><span
                                                                v-text="item.text"></span></div>
                                                </template>
                                                <div v-show="!filter_list.length"
                                                     class="select-modal__empty">{{$t('No results were found for your search.')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </template>
            </div>
 
</template>
<script>
 import { getActiveLanguage } from 'laravel-vue-i18n';
import { watch } from 'vue';
export default {
    name:"CalculatorItem",
    props:[
        'index', 'type' , 'text_after_title', 'title', 'ip_type',  'lang', 'display_modal_info','crf'
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

             days : [5, 10, 20, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 360],
             
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

        watch(this.select_proxy, ()=>{
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

        

        openModalProxy(){
            this.openManually=!this.openManually
            this.getProxyList();
        },

        displayModal(index){
            document.querySelector('html').classList.toggle('menu__show');

            // set diplay index -> parent component
            this.$emit('display_modal_info', index);
             
        } 
        
         
    },
    computed:{
        flagStyle() {
            
            return {
                'background-image': 'url('+ this.flag +')'
            };
        },
        selectModalClass() {
            return {
                'select-ips': this.select_proxy.length ? true : false
            }
        },
         
    }
}
</script>
<style lang="">
    
</style>
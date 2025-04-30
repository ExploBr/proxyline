<template lang="">
<div class="">
    <div class="main__types">
        <div class="container">
            <div class="types__wrapper">
                <h3 class="">
                    {{ $t('Proxy type') }}
                </h3>
                <div class="all__types">
                    <div>
                        <input type="radio" id="type_individual" value="dedicated" v-model="type" />
                        <label for="type_individual">{{ $t('Individual') }}</label>

                        <input type="radio" id="type_shared" value="shared" v-model="type" />
                        <label for="type_shared">Shared {{$t('up to 3 users')}}</label>
                    </div>
                    <div>
                        <input type="radio" id="type_ip_4" value="4" v-model="ip_type" />
                        <label for="type_ip_4">IPv4</label>

                        <input v-show="type=='dedicated'" type="radio" id="type_ip_6" value="6" v-model="ip_type" />
                        <label v-show="type=='dedicated'" for="type_ip_6">IPv6</label>
                    </div>
                </div>

                <div class="all__countries">
                    <h3 class="">{{$t('Country')}}</h3>
                    <div class="all__countries--search">
                        <input type="text" v-model="countryQuery" :placeholder="$t('Search country')">
                    </div>
                    <template v-if="findCountry">
                        <div class="all__countries--list">
                            <template v-for="item in countries">
                                <div class="all__countries--item" v-show="item.show">
                                    <div class="all__countries--content">
                                        <input type="radio" :value="item.code" v-model="country" :id="'country_' + item.code" />
                                        <label :for="'country_' + item.code">
                                            <span class="flag" :style="'background-image: url('+ item.flag_small +')'"></span>

                                            <span v-if="lang=='ru'" v-text="item.name_ru"></span>

                                            <span v-else v-text="item.name"></span>

                                        </label>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                    <template v-if="!findCountry">
                        <div class="all__countries--not-fount">
                            {{$t('Country not found')}}
                        </div>
                    </template>
                </div>

                <div class="main__calc--count">
                    <h3 class="">{{$t('Quantity')}}</h3>
                    <div class="main__calc__count-info">{{$t('You can order more through multiple orders. This is a limit for one order.') }}</div>
                    <div class="main__calc__counts">
                        <div class="main__calc--qty">
                            <button type="button" @click="qtyMinus">-</button>
                            <input type="number" class="main__calc--number" v-model="count" @change="countValidate" min="1">
                            <button type="button" @click="qtyPlus">+</button>
                        </div>
                        <span class="btn" @click="count = 10">10</span>
                        <span class="btn" @click="count = 50">50</span>
                        <span class="btn" @click="count = 100">100</span>
                        <span class="btn" @click="count = 250">250</span>
                        <span class="btn" @click="count = 500">500</span>
                        <span class="btn" @click="count = 1000">1000</span>
                        <span class="btn" @click="count = 2000">2000</span>
                    </div>
                </div>

                <div class="main__calc--period">
                    <h3 class="">{{$t('Period') }}</h3>
                    <div class="main__calc--period-wrapper">

                        <div :class="classDropdown">
                            <span class="main__calc--dropdown-active" @click="dropdown_open=!dropdown_open"><span v-text="period"></span> {{$t('days')}}</span>
                            <div class="dropdown__block">
                                <div class="dropdown__list">
                                    <template v-for="item in days">
                                        <div class="dropdown__list-item" @click="setPeriod(item)"><span v-text="item"></span> {{$t('days')}}</div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="main__calc--more-ips">
                            <span class="main__calc--more-ips-btn" @click="openModalProxy">{{$t('Select IP manually') }}</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="main__calc--onesum">
                <div class="onesum__title">
                    <span class="onesum__name">{{$t('Price for 1 piece')}}:</span>
                    <span class="onesum__price">
                        <span class="sum__price--old" v-show="show_sale_sum" v-text="price"></span>
                        <span class="onesum__price--current" v-text="sale_price"></span>
                        <template v-if="lang=='ru'">
                            $
                            <span class="onesum__price--usd">&#8776;<span class="onesum__price--usdsum" v-text="price_rub"></span>&#8381;</span>
                        </template>
                        <template v-else>
                            $
                        </template>

                    </span>
                </div>

                <div class="main__calc--allsumm">
                    <span class="allsumm__text">{{$t('Amount to pay')}}:</span>
                    <span class="allsumm__old-price" v-show="show_sale_sum" v-text="total"></span>
                    <span class="allsumm__price" v-text="total_sale"></span>
                    <span class="allsumm__symbol">$</span>

                    <span v-if="lang=='ru'" class="usdsum">&#8776; <span v-text="total_rub"></span> &#8381;</span>

                </div>
            </div>
        </div>
    </div>

    <div v-show="open" class="select__proxy--overflow" @click="open=false"></div>
    <div v-show="open" id="select__proxy-modal" class="select__proxy-modal">
        <button class="close__b" @click="open=false">×</button>
        <div class="proxy-modal__title">{{$t('Select IP manually')}}</div>
        <div class="select-modal__content">
            <div class="search__country">
                <input :placeholder="$t('Search by IP / subnet or city (in Latin)')" type="text" v-model="search">
            </div>
            <div v-show="select_proxy.length" class="selected-proxy__count">
                <div>{{$t('Selected')}}: <span v-text="select_proxy.length"></span></div>
            </div>
            <div v-show="select_proxy.length" class="select-modal__select">
                <template v-for="item in select_proxy">
                    <div class="item">
                        <span><span class="remove" @click="removeSelect(item)">x</span><span v-text="item.text"></span></span>
                    </div>
                </template>
            </div>
            <button v-show="select_proxy.length" type="button" class="custom__close btn" @click="open=false">{{$t('Ready')}}</button>
            <div class="select-modal__list">
                <div class="select-modal__list-content">
                    <template v-for="item in filter_list">
                        <div :class="itemClass(item)" @click="pushSelected(item)"><span v-text="item.text"></span></div>
                    </template>
                    <div v-show="!filter_list.length" class="select-modal__empty">{{$t('No results were found for your search.')}}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="main__payments container">
        <h2 class="">
            {{$t('Order a proxy')}}
        </h2>
        <div class="main__payments--wrapper">
            <template v-for="(item, index) in payments" :key="index">
                <div class="pay-item">
                    <div class="pay-item__header" :style="'background-image:url('+item.logo_path+')'">
                        {{ item.name }}
                    </div>
                    <div class="pay-item__text" v-if="lang=='ru'" v-html="item.description_ru">

                    </div>
                    <div class="pay-item__text" v-else>
                        {{ item.description_en }}
                    </div>

                    <div class="pay-item__items">
                        <template v-for="(item, index) in item.options" :key="index">
                            <div class="items__radio">
                                <input type="radio" v-model="payment_method" :value="item.value" :id="item.value">
                                <label :for="item.value">
                                    <span class="pay-item__icon" v-if="item.icon_path">
                                        <img :src="item.icon_path" alt="pay-methods">
                                    </span>
                                    <span class="pay-item__name">
                                        <strong v-if="lang=='ru'">{{item.name_ru}}</strong>
                                        <strong v-else>{{item.name_en}}</strong>
                                    </span>
                                </label>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div class="main__pay container">
        <div class="main__pay--top">
            <h3>{{$t('You choosed')}}</h3>
            <div class="pay__top--content">
                <div class="pay_selected__content">
                    <div class="pay_selected__list">
                        <div class="pay_selected__item">
                            <span class="pay_selected__name">{{$t('Country')}}:</span>
                            <span class="pay_selected__country">
                                <span class="flag" :style="flagStyle"></span>
                                <span v-text="countryFull"></span>
                            </span>
                        </div>
                        <div class="pay_selected__ips_list pay_selected__item" v-show="select_proxy.length">
                            <span class="pay_selected__name">{{$t('Selected IPs')}}:</span>
                            <template v-for="(item, index) in select_proxy" :key="index">
                                <template v-if="index < 15">
                                    <span class="value" v-text="item.text"></span>
                                </template>
                            </template>
                            <div v-show="select_proxy.length > 15" class="item__btn"><span class="btn btn-orange select-ip-modal" data-id="select-ip-modal">{{$t('Show all')}}</span>
                            </div>
                        </div>
                        <div class="pay_selected__item">
                            <span class="pay_selected__name">{{$t('Quantity')}}:</span>
                            <span class="value qnt"><span v-text="count"></span> {{$t('pc.')}}</span>
                        </div>
                        <div class="pay_selected__item">
                            <span class="pay_selected__name">{{$t('Period (days)')}}:</span>
                            <span class="value period"><span v-text="period"></span>{{$t('days')}}</span>
                        </div>
                        <div class="pay_selected__item">
                            <span class="pay_selected__name">{{$t('Price for 1 piece')}}:</span>
                            <span class="value price">
                                <span class="price__old" v-show="show_sale_sum" v-text="price"></span>
                                <span class="price__current" v-text="sale_price"></span>
                                <template v-if="lang=='ru'">
                                    $
                                    <span class="price__usd">&#8776; <span class="price__usdsum" v-text="price_rub"></span>&#8381;</span>
                                </template>
                                <template v-else>
                                    $
                                </template>

                            </span>
                        </div>
                    </div>
                    <div class="pay_selected__fields">
                        <div class="pay_selected__input">
                            <label>{{$t('Coupon')}}</label>
                            <input type="text" name="coupon" v-model="coupon">
                            <span class="pay_selected__btn" v-show="!show_sale_sum" @click="couponCheck">{{$t('Apply coupon')}}</span>

                            <span v-show="show_sale_sum" class="disount-summ">{{$t('Your discount')}}: <span v-text="sale"></span>%</span>
                        </div>
                        <div class="pay_selected__input">
                            <label>{{$t('Email')}}</label>
                            <input type="email" name="email" v-model="email" required>

                            <p class="pay__info" v-if="lang=='ru'" v-html="$t('Specify the email to which the access will be sent. <br>Check your SPAM folder!')">

                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="main__pay--bottom">
            <div class="main__calc--allsumm">
                <span class="allsumm__text">{{$t('Amount to pay')}}:</span>
                <span class="allsumm__old-price" v-show="show_sale_sum" v-text="total"></span>
                <span class="allsumm__price" v-text="total_sale"></span>
                <span class="allsumm__symbol">$</span>

                <span v-if="lang=='ru'" class="usdsum">&#8776; <span v-text="total_rub"></span> &#8381;</span>

            </div>
            <div class="payment__method-section">
                <span class="name">{{$t('Payment method')}}:</span>
                <span class="value payment-method-section__name">

                    <span class="payment-method-section__title"><span class="pay-item__icon"><img :src="payIcon"></span><span v-text="payName"></span></span>
                </span>
            </div>

            <div class="main__pay--btn">
                <span :class="payButtonClasses" @click="pay">{{$t('Pay')}}</span>
                <div class="agree">
                    <div class="one-agree">
                        <input type="checkbox" name="licens" id="agree" required="required" v-model="licens" value="on">
                        <label for="agree">{{$t('I agree with')}} <a :href="lang == 'ru' ? '/polzovatelskoe-soglashenie' : '/'+lang+'/polzovatelskoe-soglashenie'" target="_blank">{{$t('terms of use')}}</a></label>

                    </div>

                    <div class="one-agree">
                        <input type="checkbox" name="agree" id="agree1" required="required" v-model="agree" value="on">
                        <label for="agree1">{{$t('I agree with')}} <a :href="lang == 'ru' ? '/private-policy' : '/'+lang+'/private-policy'" target="_blank">{{$t('privacy policy')}}</a></label>

                    </div>

                </div>
                <div class="one-agree-text">
                    {{$t('*You must agree to the terms of use and privacy policy')}}

                </div>

            </div>
            <div v-show="error">
                <div class="pay--errors" id="pay_errors" v-html="error"></div>
            </div>
        </div>
    </div>
    <template v-for="(item, index) in countries_list" :key="index">
        <div class="allcountries__shadow hidden"></div>
        <div class="allcountries  select__proxy-modal hidden" :id="'allcountries_'+index">
            <button class="close__b">×</button>
            <div class="allcountries__wrapper">
                <div class="allcountries__title">{{$t('All countries')}}</div>
                <hr>
                <div class="allcountries__popup-list">
                    <template v-for="(country, index) in item" :key="index">
                        <div class="allcountries__item">
                            <span class="flag" :style="'background-image: url('+country.flag_small +')'"></span> <span v-if="lang == 'ru'">{{country.name_ru}}</span><span v-else>{{country.name}}</span>
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </template>

    <div class="allips_list__shadow hidden"></div>
    <div class="allips_list  select__proxy-modal hidden pay_selected__content" id="select-ip-modal">
        <button class="close__b">×</button>
        <div class="pay_selected__ips_list pay_selected__item">
            <template v-for="(item, index) in select_proxy" :key="index">

                <span class="value" v-text="item.text"></span>

            </template>
        </div>
    </div>

</div>
</template>

<script>
import axios from 'axios';
import {
    getActiveLanguage
} from 'laravel-vue-i18n';
import { watch } from 'vue';
export default {
    name: "MainPaymentComponent",
    props: [
        'data_all', 'payments', 'countries_list'
    ],
    data() {
        return {

            open: false,
            country: 'ru',
            countryFull: false,
            countries: [],
            countryQuery: '',
            findCountry: true,
            flag: '',
            count: 1,
            default_limit: 2000,
            limit: 2000,
            limits: [],
            type: 'dedicated',
            ip_type: 4,
            days: [5, 10, 20, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 360],
            period: 5,
            dropdown_open: false,
            select_proxy: [],
            filter_list: [],
            list: [],
            search: '',
            prices: [],
            price: 0,
            sale_price: 0,
            price_usd: 0,
            price_rub: 0,
            total: 0,
            total_sale: 0,
            total_usd: 0,
            total_rub: 0,
            usd_curse: 0,
            sale: 0,
            show_sale: false,
            show_sale_sum: false,
            coupon: '',
            coupon_default: 'FERSTPAY10',
            email: '',
            payment_method: 212,
            licens: false,
            agree: false,
            error: null,

            lang: getActiveLanguage(),
            payName: '',
            payIcon: '',

        }
    },

    mounted() {

        this.getPanelData();

        this.payMethodName(this.payment_method);
        //setTimeout(() => this.getProxyList(), 3000);

        this.$watch('search', () => {
            this.filterListProcess();
        });

        watch(this.select_proxy, () => {
            
            if (this.select_proxy.length) {
                this.count = this.select_proxy.length;
                 
            }
        });

        this.$watch('counry', () => {
            this.getProxyList();
            this.setCountriesList(this.countriesList);
            this.getPrice();
            this.setLimit();
        });

        this.$watch('type', () => {
            if (this.type == 'shared') {
                this.ip_type = 4;
            }
            this.country = 'ru';
            this.filterCountries();
            this.getPrice();
            this.setLimit();
        });

        this.$watch('ip_type', () => {
            if (this.type == 'shared') {
                this.ip_type = 4;
            }
            this.country = 'ru';
            this.filterCountries();
            this.getPrice();
            this.setLimit();
        });

        this.$watch('count', () => {
            if (this.count > this.limit) this.count = this.limit;
            this.getPrice();
        });

        this.$watch('period', () => {
            this.getPrice();
        });

        this.$watch('sale', () => {
            this.getPrice();
        });

        this.$watch('countryQuery', () => {
            this.searchCountry();
        });

        this.$watch('payment_method', () => {
            this.payMethodName(this.payment_method);
        });

    },

    methods: {
        getPanelData() {

            // set countries
            this.countriesList = this.data_all.countries;
            this.filterCountries();
            this.setCountriesList(this.countriesList);

            //set prices
            this.prices = this.data_all.prices.prices;
            this.usd_curse = this.data_all.prices.rub;
            this.getPrice();

            //set limits
            this.default_limit = this.data_all.limits.default_limit;
            this.limits = this.data_all.limits.limits;
            this.setLimit();

        },

        roundAmount(amount) {
            return Math.ceil(amount * 100) / 100
        },

        setCountriesList(list) {
            var key = this.type + ':' + this.ip_type;

            if (list[key][this.country] !== 'undefined') {
                this.countryFull = this.lang === 'ru' ? list[key][this.country].name_ru : list[key][this.country].name;
                this.countryFull = this.countryFull + ' (' + list[key][this.country].name_local + ')';
                this.flag = list[key][this.country].flag_small;
            }
        },
        filterCountries() {
            this.countries = [];

            var key = this.type + ':' + this.ip_type;

            if (this.countriesList[key] !== 'undefined') {
                this.countries = this.countriesList[key];

                for (const property in this.countries) {
                    this.countries[property].show = true;
                }
            } else {
                this.findCountry = false;
            }

        },
        searchCountry() {
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
                } else {
                    this.countries[property].show = false;
                }
            }
        },
        qtyPlus() {
            this.count++;
        },
        qtyMinus() {
            this.count--;
            if (this.count <= 0) this.count = 1;
        },
        countValidate() {
            if (this.count <= 0) this.count = 1;
        },
        setPeriod(item) {
            this.period = item;
            this.dropdown_open = false;
        },

        itemClass(item) {
            return {
                'item': true,
                'active': this.hasInSelected(item)
            }
        },
        getProxyList() {

            fetch(`https://panel.proxyline.net/get-ip-list/?ip_type=${this.type}&ip_version=${this.ip_type}&country=${this.country}`)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    this.list = data;
                    this.filter_list = this.list;
                });

        },
        /*getLimits() {
            fetch(this.apiUrl + 'order-limits/')
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    this.default_limit = data.default_limit;
                    this.limits = data.limits;

                    this.setLimit();
                });
        },*/
        setLimit() {
            var key = [this.country, this.type, this.ip_type].join(':');
            if (key in this.limits) this.limit = this.limits[key];
            else this.limit = this.default_limit;
        },

        getPrice() {
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

            this.total_rub = (this.total_sale * this.usd_curse).toFixed(2);
        },
        setSalePrice() {
            return (this.price - (this.price / 100 * this.sale)).toFixed(2);
        },
        filterListProcess() {
            this.filter_list = [];
            for (var i = 0; i < this.list.length; i++) {
                if (this.list[i].text.toLowerCase().indexOf(this.search) != -1) {
                    this.filter_list.push(this.list[i]);
                }
            }
        },
        pushSelected(item) {
            if (!this.hasInSelected(item)) {
                this.select_proxy.push(item);
                 
            }
        },
        hasInSelected(item) {
            for (var i = 0; i < this.select_proxy.length; i++) {
                if (this.select_proxy[i].id == item.id) {
                    return true;
                }
            }
            return false;
        },
        removeSelect(item) {
            for (var i = 0; i < this.select_proxy.length; i++) {
                if (this.select_proxy[i].id == item.id) {
                    this.select_proxy.splice(i, 1);
                    break;
                }
            }
        },
        flagClass() {
            return 'flag ' + this.country;
        },

        pay() {

            if (!this.licens || !this.agree) return false;

            var selected_ips_ids = [];

            if (this.select_proxy.length) {
                for (var i = 0; i < this.select_proxy.length; i++) {
                    selected_ips_ids.push(this.select_proxy[i].id);
                }
            }

            var data = {
                itarif: 'ipv' + this.ip_type,
                ip_type: this.type,
                ip_version: this.ip_type,
                country: this.country,
                quantity: this.count,
                period: this.period,
                summ: this.total_sale,
                email: this.email,
                coupon: this.coupon === '' ? this.coupon_default : this.coupon,
                payment_method: this.payment_method,
                ip_list: selected_ips_ids,
                licens: this.licens ? 'on' : '',
                agree: this.agree ? 'on' : ''
            };

            //data = jQuery.param(data, true);

            /*axios.post('https://webapi.proxyapis.com/api/web/v1/1/landing/order',data).then(response=>{
                if (typeof response.redirect_url !== 'undefined') {
                        window.location.href = response.redirect_url;
                    } else if (typeof response.errors !== 'undefined' && response.errors.length) {
                        let errorText = [];
                        for (let i = 0; i < response.errors.length; i++) {
                            let string = response.errors[0].title ? response.errors[0].title + ': ' : '';
                            errorText.push(string + response.errors[0].message);
                        }
                        if (errorText !== '') {
                            this.error = errorText.join('<br>');
                        }
                    }
                    console.log(this.error);
            })
            .catch(function (error) {
                console.log(error);
            });  */

            const newdata = new FormData();
            for (var key in data) {
                newdata.append(key, data[key])
            }

            fetch('https://panel.proxyline.net/new-order/', {
                    method: 'POST',

                    body: newdata,

                })
                .then((response) => {
                    return response.json();
                }).then((data) => {
                    console.log(data);
                    if (typeof data.redirect_url !== 'undefined') {
                        window.location.href = data.redirect_url;
                    } else if (typeof data.errors !== 'undefined' && data.errors.length) {
                        let errorText = [];
                        for (let i = 0; i < data.errors.length; i++) {
                            let string = data.errors[0].title ? data.errors[0].title + ': ' : '';
                            errorText.push(string + data.errors[0].message);
                        }
                        if (errorText !== '') {
                            this.error = errorText.join('<br>');
                        }
                    }
                    console.log(this.error);
                })

        },

        couponCheck() {
            if (this.coupon === '') {
                if (this.lang === 'ru') {
                    //alert('Заполните правильно поле "Купон"');
                    document.querySelector('input[name="coupon"]').classList.add('redborder');
                } else {
                    //alert('Enter the correct data in the field "Coupon"');
                    document.querySelector('input[name="coupon"]').classList.add('redborder');
                }
                return false;
            } else {
                axios.post('/api/coupon', {
                        coupon: this.coupon
                    })
                    .then((response) => {
                        console.log(response);
                        if (response) {
                            this.getDiscountData(response.data);
                        } else {
                            if (this.lang === 'ru') {
                                //alert('Заполните правильно поле "Купон"');
                                document.querySelector('input[name="coupon"]').classList.add('redborder');

                            } else {
                                //alert('Enter the correct data in the field "Coupon"');
                                document.querySelector('input[name="coupon"]').classList.add('redborder');

                            }
                        }
                    });
            }
        },

        getDiscountData(order) {
            var coupon = order || {},
                option;

            this.sale = 0;
            this.show_sale = false;
            this.show_sale_sum = false;

            if (coupon.discount_percent !== undefined) {
                if (coupon.discount_percent !== null) {
                    this.sale = coupon.discount_percent;
                    this.show_sale = true;

                    this.show_sale_sum = true;
                } else {
                    for (i = 0; i < coupon.options.length; i++) {
                        option = coupon.options[i];
                        if (this.count >= option.quantity_from && this.count <= option.quantity_to) {
                            this.sale = option.discount_percent;
                            this.show_sale = true;
                            this.show_sale_sum = true;
                            break;
                        }
                    }
                }
            }
            if (this.sale === 0) {
                alert('Failed to get coupon data');
            }

        },

        openModalProxy() {
            this.open = !this.open
            this.getProxyList();
        },

        payMethodName(idpayment) {

            this.payments.forEach(element => {
                element.options.forEach(element => {

                    if (element.value == idpayment) {
                        console.log(element.value);
                        if (this.lang == 'ru') {
                            this.payName = element.name_ru
                            console.log(this.payName);
                        } else {
                            this.payName = element.name_en
                        }
                        this.payIcon = element.icon_path
                    }
                });

            });
        },
    },

    computed: {
        classDropdown() {
            return {
                'main__calc--dropdown': true,
                'open': this.dropdown_open
            }
        },

        flagStyle() {
            return {
                'background-image': 'url(' + this.flag + ')'
            };
        },

        payButtonClasses() {
            return {
                'pay__main--btn': true,
                'pay__btn_cena': true,
                'blocked': !this.licens || !this.agree
            };
        },

    }
};
</script>

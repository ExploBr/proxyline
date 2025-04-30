<template lang="">
<div>
    <div class="main__payments container">

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

        <div class="main__pay">
            <div class="main__pay--top">
                <h3>{{$t('You choosed')}}</h3>
                <div class="pay__top--content">
                    <div class="pay_selected__content">
                        <div class="pay_selected__list">
                            <div class="pay_selected__item">
                                <span class="pay_selected__name">{{$t('Country')}}:</span>
                                <span class="pay_selected__country">
                                    <span class="flag" :style="'background-image:url('+country_flag+')'"></span>
                                    <span v-text="country_name"></span>
                                </span>
                            </div>
                            <div class="pay_selected__ips_list pay_selected__item" v-show="select_proxy.length">
                                <span class="pay_selected__name">{{$t('Selected IPs')}}:</span>
                                <template v-for="(item, index) in select_proxy_name" :key="index">
                                    <template v-if="index < 15">
                                        <span class="value" v-text="item"></span>
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
    </div>

    <div class="allips_list__shadow hidden"></div>
    <div class="allips_list  select__proxy-modal hidden pay_selected__content" id="select-ip-modal">
        <button class="close__b">×</button>
        <div class="pay_selected__ips_list pay_selected__item">
            <template v-for="(item, index) in select_proxy_name" :key="index">

                <span class="value" v-text="item"></span>

            </template>
        </div>
    </div>
</div>
</template>

<script>
import {
    getActiveLanguage
} from 'laravel-vue-i18n';

export default {
    name: 'PayComponent',
    props: [
        'data_all', 'payments', 'data'
    ],
    data() {
        return {
            open: false,

            itarif: this.data.tarif ? this.data.tarif : '',
            ip_type: this.data.ip_type ? this.data.ip_type : '',
            type: this.data.ip_type ? this.data.ip_type : '',

            ip_version: this.data.ip_version ? this.data.ip_version : '',
            country: this.data.country ? this.data.country : '',

            count: this.data.quantity ? this.data.quantity : '',
            period: this.data.period ? this.data.period : '',

            total_sale: this.data.total ? this.data.total : '',
            total: this.data.total ? this.data.total : '',
            country_name: this.data.country_name ? this.data.country_name : '',
            country_flag: this.data.country_flag ? this.data.country_flag : '',
            dropdown_open: false,
            select_proxy: this.data.ip_list ? this.data.ip_list : '',
            select_proxy_name: this.data.ip_list_name ? this.data.ip_list_name : '',

            sale: 0,
            show_sale: false,
            show_sale_sum: false,

            price: this.data.price ? this.data.price : '',

            usd_curse: this.data.usd_curse ? this.data.usd_curse : '',

            sale_price: this.data.price ? this.data.price : '',
            price_rub: this.data.price_rub ? this.data.price_rub : '',

            total_rub: this.data.total_rub ? this.data.total_rub : '',
            prices: this.data_all.prices.prices,
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
        console.log(this.select_proxy_name);
        this.payMethodName(this.payment_method);

        this.$watch('payment_method', () => {
            this.payMethodName(this.payment_method);
        });
        this.$watch('sale', () => {
            this.getPrice();
        });
    },

    methods: {
        pay() {

            if (!this.licens || !this.agree) return false;

            var selected_ips_ids = [];

            if (this.select_proxy.length) {
                for (var i = 0; i < this.select_proxy.length; i++) {
                    selected_ips_ids.push(this.select_proxy[i].id);
                }
            }

            var newdata = {
                itarif: 'ipv' + this.ip_version,
                ip_type: this.type,
                ip_version: this.ip_version,
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

            const newdata2 = new FormData();
            for (var key in newdata) {
                newdata2.append(key, newdata[key])
            }

            fetch('https://panel.proxyline.net/new-order/', {
                    method: 'POST',
                    body: newdata2,

                })
                .then((response) => {
                    console.log(response);
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
        roundAmount(amount) {
            return Math.ceil(amount * 100) / 100
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

            this.price = this.roundAmount(this.price);

            this.sale_price = this.setSalePrice();

            this.price_rub = (this.sale_price * this.usd_curse).toFixed(2);

            this.total = (this.price * this.count).toFixed(2);

            this.total_sale = (this.sale_price * this.count).toFixed(2);

            this.total_rub = (this.total_sale * this.usd_curse).toFixed(2);
        },
        setSalePrice() {
            return (this.price - (this.price / 100 * this.sale)).toFixed(2);
        },

        payMethodName(idpayment) {

            this.payments.forEach(element => {
                element.options.forEach(element => {

                    if (element.value == idpayment) {

                        if (this.lang == 'ru') {
                            this.payName = element.name_ru

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
        payButtonClasses() {
            return {
                'pay__main--btn': true,
                'pay__btn_cena': true,
                'blocked': !this.licens || !this.agree
            };
        },
    }

}
</script>

<style lang="">

</style>

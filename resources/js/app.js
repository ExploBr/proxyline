/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 
import { createApp } from 'vue';
 

import './bootstrap';
import { i18nVue } from 'laravel-vue-i18n';

import CalculatorComponent from './components/layouts/CalculatorComponent.vue';
import AffilateComponent from './components/layouts/AffilateComponent.vue';
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const calculator = createApp({
    components: {
      CalculatorComponent
      },
});
  
calculator.use(i18nVue, {
  resolve: async lang => {
      const langs = import.meta.glob('../../lang/*.json');
      return await langs[`../../lang/${lang}.json`]();
  }
}).mount('#calculator');


const affilate = createApp({
  components: {
    AffilateComponent
    }
});

affilate.mount('#affilate__counter');


  
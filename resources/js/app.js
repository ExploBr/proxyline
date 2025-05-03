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
import HeaderSlider from './components/layouts/HeaderSlider.vue';
import StatsData from './components/layouts/StatsData.vue';
import PartnerComponent from './components/layouts/PartnerComponent.vue';
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
  
if(document.querySelector('#calculator')){
calculator.use(i18nVue, {
  resolve: async lang => {
      const langs = import.meta.glob('../../lang/*.json');
      return await langs[`../../lang/${lang}.json`]();
  }
}).mount('#calculator');
}

if(document.querySelector('#affilate__counter')){
const affilate = createApp({
  components: {
    AffilateComponent
    }
});

affilate.mount('#affilate__counter');
}

if(document.querySelector('#partner__counter')){
const partner__counter = createApp({
  components: {
    PartnerComponent
    }
}).use(i18nVue, {
  
  resolve: async lang => {
      const langs = import.meta.glob('../../lang/*.json');
      return await langs[`../../lang/${lang}.json`]();
  }
}).mount('#partner__counter');
}

if(document.querySelector('#social__swiper')){
const HeadeSlider = createApp({
  components: {
    HeaderSlider
    }
});

HeadeSlider.mount('#social__swiper');  

}

if(document.querySelector('#stats_data')){
const statsData = createApp({
  components: {
    StatsData
    }
}).use(i18nVue, {
  
  resolve: async lang => {
      const langs = import.meta.glob('../../lang/*.json');
      return await langs[`../../lang/${lang}.json`]();
  }
}).mount('#stats_data');  
}
 



document.querySelector('.menu__toggle').addEventListener('click', function(){
  document.querySelector('.mobile__menu').classList.toggle('show__menu');
  document.querySelector('html').classList.toggle('menu__show')
})

document.querySelector('.close__menu').addEventListener('click', function(){
  document.querySelector('.mobile__menu').classList.toggle('show__menu');
  document.querySelector('html').classList.toggle('menu__show')
})

document.querySelectorAll('a.current').forEach(element => {
  element.addEventListener('click', function(e){
    e.preventDefault();
    this.closest('.language').classList.toggle('show');
   
  })
});
 
 

 
let tab = document.querySelectorAll('.head-tab'),
maintab = document.querySelector('.tabs'),
tabContent = document.querySelectorAll('.tabcontent');
if(maintab){
  function hideTabContent(a) {
    for (let i = a; i < tabContent.length; i++) {
        tabContent[i].classList.remove('show');
        tabContent[i].classList.add('hide');

        tab[i].classList.remove('activetab');
  
    }
  }

  hideTabContent(1);

  function showTabContent(b) {
    if (tabContent[b].classList.contains('hide')) {
        tabContent[b].classList.remove('hide');
        tabContent[b].classList.add('show');
 
        tab[b].classList.add('activetab');
    }
  }

  maintab.addEventListener('click', function(event) {
    let target = event.target;
    if (target && target.classList.contains('head-tab')) {
        for(let i = 0; i < tab.length; i++) {
            if (target == tab[i]) {
                hideTabContent(0);
                showTabContent(i);
                break;
            }
        }
    }

  });
}

if(document.querySelector('.faq__item')){
  let faqitem = document.querySelectorAll('.faq__item');
  faqitem.forEach(element => {
    element.addEventListener('click', function() {
      this.classList.toggle('active');
    })
  });
  
}
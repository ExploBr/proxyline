/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 
import { createApp } from 'vue';
 

import './bootstrap';
import { i18nVue } from 'laravel-vue-i18n';

import MainPaymentComponent from './components/layouts/MainPaymentComponent.vue';


if(document.querySelector('#main__payment')){
    const main__payment = createApp({
      components: {
        MainPaymentComponent
        }
    }).use(i18nVue, {
      
      resolve: async lang => {
          const langs = import.meta.glob('../../lang/*.json');
          return await langs[`../../lang/${lang}.json`]();
      }
    }).mount('#main__payment');
    }


let countyLink = document.querySelectorAll('.pices-block__all-link'),
countyModal = document.querySelectorAll('.allcountries');

countyModal.forEach(element => {
  var parent = element;
  console.log(element.childNodes[0]);
  element.childNodes[0].addEventListener('click', function(event) {
    parent.classList.add('hidden')
    element.previousElementSibling.classList.add('hidden')
    document.querySelector('html').classList.toggle('menu__show')
  });
  element.previousElementSibling.addEventListener('click', function(event) {
    parent.classList.add('hidden')
    this.classList.add('hidden')
    document.querySelector('html').classList.toggle('menu__show')
  })

});
countyLink.forEach(element => {
  element.addEventListener('click', function(event) {

    countyModal.forEach(element => {
      if(this.getAttribute('data-id') == element.id){
        element.previousElementSibling.classList.remove('hidden')
        element.classList.remove('hidden')
        document.querySelector('html').classList.toggle('menu__show')
      }else{
        element.previousElementSibling.classList.add('hidden')
        element.classList.add('hidden')
      }
      console.log(element.id);
    })
    console.log(this.getAttribute('data-id'));
  });
});


let SelectIp = document.querySelector('.select-ip-modal'),
SelectIpModal = document.querySelector('.allips_list');

SelectIp.addEventListener('click', function(event) {
  SelectIpModal.classList.remove('hidden')
  SelectIpModal.previousElementSibling.classList.remove('hidden')
  document.querySelector('html').classList.toggle('menu__show')
})


SelectIpModal.childNodes[0].addEventListener('click', function(event) {
  SelectIpModal.classList.add('hidden')
  SelectIpModal.previousElementSibling.classList.add('hidden')
  document.querySelector('html').classList.toggle('menu__show')
});
SelectIpModal.previousElementSibling.addEventListener('click', function(event) {
  SelectIpModal.classList.add('hidden')
  this.classList.add('hidden')
  document.querySelector('html').classList.toggle('menu__show')
})
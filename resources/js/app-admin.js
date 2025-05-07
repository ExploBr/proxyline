/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 
import { createApp } from 'vue';
 

import './bootstrap';

import PageComponent from './components/PageComponent.vue';
import UpdatePageComponent from './components/UpdatePageComponent.vue';
import LoginComponent from './components/LoginComponent.vue';
import AdminMainComponent from './components/AdminMainComponent.vue';
import MainContentComponent from './components/MainContentComponent.vue';
import MainOptionComponent from './components/MainOption/MainOptionComponent.vue';
import CreatePostComponent from './components/Posts/CreatePostComponent.vue';
import UpdatePostComponent from './components/Posts/UpdatePostComponent.vue';
import CatalogComponent from './components/CatalogComponent.vue';
import CountryComponent from './components/CountryComponent.vue';
 
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({

    components: {
        PageComponent,
        UpdatePageComponent,
        LoginComponent,
        AdminMainComponent,
        MainContentComponent,
        MainOptionComponent,
        CreatePostComponent,
        UpdatePostComponent,
        CatalogComponent,
        CountryComponent,

        
      },

       

});
 

 
app.mount('#app');

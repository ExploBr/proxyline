<template lang="">
    <div>

            <div class="form-group col-3">
                        <label for="title">Язык</label>
                        <select class="form-control" v-model="lang">
                            <option value="all" >Для всех</option>
                            <option value="ru" selected="selected">Русский</option>
                             
                        </select>
             </div>
            <div class="form-group">
                <label for="title">Имя</label>
                <input class="form-control"
                value="" v-model="title"
                type="text"   id="title">
                
            </div>

            <div class="form-group  ">
                <label for="title">Url | Slug</label>
                <input class="form-control"
                value="" v-model="slug"
                type="text"   id="slug">
                
            </div>
            <div class="form-group  ">
                <label for="title">Шаблон</label>
                <select class="form-control" v-model="template" @change="templateChange($event)"> 
                                <option value="txtpage" selected="selected">Текстовая страница</option>
                            <option value="main">Главная</option>
                            <option value="contact">Контакты</option>
                            <option value="partner">Партнёрская программа</option>
                            <option value="ipv">ipv</option>
                            <option value="optovikam">Оптовикам</option>
                            <option value="ceny">Цены</option>
                            <option value="pay">Оплата</option>
                            <option value="checker">Прокси Чекер</option>
                            <option value="speed">Скорость</option>
                            <option value="ports">Порты</option>
                            <option value="blacklist">Черный список</option>
                            <option value="checkipv6">Проверка iPv6</option>
                            <option value="freeproxy">Бесплатные прокси</option>
                            <option value="myip">Мой IP</option>
                            <option value="anonymous">Анонимность</option>
                            
                </select>
            </div>
            <div class="form-group">
                <label for="summernote">Контент</label>

                <div class="card card-outline card-info">
                  
                    <div class="card-body">
                    <textarea v-model="content"   id="summernote">
                            
                    </textarea>
                    </div>
                </div>
             
            </div>
            <div class="form-group">
            
            <div class="icheck-primary d-inline">
                    <input type="checkbox" v-model="publish" id="publish"  >
                    <label for="publish">
                    Опубликовано
                    </label>
            </div>

            



            <div class="form-group" v-if="template">    
                <h2>Метаданные</h2>
                <div class="from-group" v-if="template == 'main'">
                    
                    
                </div>
                <div class="from-group" v-if="template == 'txtpage'">
                    <div class="from-group" >
                        <label class="mb-25">Изображение к заголовку (Если нужен)</label>
                        <textarea v-model="metas.zagolovok" id="zagolovok" ref="zagolovok"  >
                                        {{ metas.zagolovok }}
                        </textarea>
                    </div>

                    <div class="from-group" >
                        <label class="mb-25">Произвольный класс (для кастомных стилей)</label>
                        <input class="form-control"
                        value="" v-model="metas.class"
                        type="text"   id="class">
                    </div>
                    
                    <div class="from-group" >
                        <label class="mb-25">Партнерская программа</label>
                        <input class=" custom__checkbox"
                         value="true" v-model="metas.partner_block"
                        type="checkbox"   id="class">
                    </div>
                </div>

                <div class="from-group" v-if="template == 'contact'">
                    <div class="from-group" >

                        <label for="title">Заголовок для страницы</label>
                        <input class="form-control"
                        value="" v-model="metas.zagolovok"
                        type="text"   id="zagolovok">

                    </div>
 
                </div>


                <div class="from-group" v-if="template == 'ipv'">
                    <div class="from-group" >
                        <label for="">изображение Сверху</label>
                            <textarea v-model="metas.ipv_content_top" id="ipv_content_top" ref="ipv_content_top">
                                            {{ metas.ipv_content_top }}
                            </textarea>
                    </div>

                    <div class="from-group" >
                        <label for="">Контент Снизу</label>
                            <textarea v-model="metas.ipv_content_bottom" id="ipv_content_bottom" ref="ipv_content_bottom">
                                            {{ metas.ipv_content_bottom }}
                            </textarea>
                    </div>
                    
                </div>


                <div class="from-group" v-if="template == 'partner'">
                    
                    <label class="mb-25">Заголовок с изображением</label>
                    <textarea v-model="metas.zagolovok" id="zagolovok" ref="zagolovok"  >
                                    {{ metas.zagolovok }}
                    </textarea>
 
                    <label class="mb-25">Шаги</label>
                    <textarea v-model="metas.steps" id="steps" ref="steps"  >
                                    {{ metas.steps }}
                    </textarea>
 

                    <label class="mb-25">Типы трафиика</label>
                    <textarea v-model="metas.trafic" id="trafic" ref="trafic" class="mb-25 w-100" rows="7">
                                    {{ metas.trafic }}
                    </textarea>
 
                </div>



                <div class="from-group" v-if="template == 'optovikam'">
                    <div class="from-group" >
                        <label for="">Количество</label>
                            <textarea v-model="metas.opt_kolvo" id="opt_kolvo" ref="opt_kolvo" class="w-100" rows="5">
                                            {{ metas.opt_kolvo }}
                            </textarea>
                    </div>

                    <div class="from-group" >
                        <label for="">Контент Снизу</label>
                            <textarea v-model="metas.opt_content" id="opt_content" ref="opt_content">
                                            {{ metas.opt_content }}
                            </textarea>
                    </div>
                    
                </div>
                

                <div class="from-group" v-if="template == 'ceny'">
                    <div class="from-group" >
                        <label for="">Заголовок для страницы</label>
                            <textarea v-model="metas.ceny_zagolovok" id="ceny_zagolovok" ref="ceny_zagolovok" >
                                            {{ metas.ceny_zagolovok }}
                            </textarea>
                    </div>
 
                </div>

                <div class="from-group" v-if="template == 'checker'">
                    <div class="from-group" >
                        <label for="">Список</label>
                            <textarea v-model="metas.spisok" class="w-100" rows="5">
                                            {{ metas.spisok }}
                            </textarea>
                    </div>
 
                </div>

                <div class="from-group" v-if="template == 'speed'">
                    <div class="from-group" >
                        <label for="">Заголовок для страницы</label>
                            <textarea v-model="metas.zagolovok" class="w-100" rows="5" id="zagolovok">
                                            {{ metas.zagolovok }}
                            </textarea>
                    </div>
 
                </div>

                <div class="from-group" v-if="template == 'ports'">
                    <div class="from-group" >
                        <label for="">Заголовок для страницы</label>
                            <textarea v-model="metas.zagolovok" class="w-100" rows="5" id="zagolovok">
                                            {{ metas.zagolovok }}
                            </textarea>
                    </div>
 
                </div>

                <div class="from-group" v-if="template == 'blacklist'">
                    <div class="from-group" >
                        <label for="">Заголовок для страницы</label>
                            <textarea v-model="metas.zagolovok" class="w-100" rows="5" id="zagolovok">
                                            {{ metas.zagolovok }}
                            </textarea>
                    </div>
 
                </div>

                <div class="from-group" v-if="template == 'freeproxy'">
                    <div class="from-group" >
                        <label for="">Заголовок для страницы</label>
                            <textarea v-model="metas.zagolovok" class="w-100" rows="5" id="zagolovok">
                                            {{ metas.zagolovok }}
                            </textarea>
                    </div>
 
                </div>

            </div>

            <div class="seo mt-25">
                <h2>Блок СЕО</h2>
                <div class="from-group" >
                        <label for="title" class="mt-25">Title</label>
                        <input class="form-control"
                        value="" v-model="metas.seo_title"
                        type="text"   id="seo_title">
                </div>
                <div class="from-group" >
                        <label for="title" class="mt-25">Description</label>
                        <textarea class="form-control"
                        value="" v-model="metas.seo_description"
                        type="text"   id="seo_description" rows="5"></textarea>
                </div>

                <div class="from-group" >
                       
                        <input class="custom__checkbox"
                        value="" v-model="metas.seo_noindex"
                        type="checkbox"   id="seo_noindex">
                        <label for="title" class="mt-25">NoIndex</label>
                </div>
            </div>

        </div>


        <button type="submit" class="btn btn-primary " @click.prevent="addPage">Добавить</button>
    </div>
</template>
<script>

import api from '../api';
import axios from 'axios';

export default {
    name:"PageCreateComponent",

    data() {
        return {
            title:null,
            slug:null,
            content:null,
            publish:null,
            template:null,
            lang:'ru',
            metas:{

            }
            
        }
    },
    mounted(){
        // this.templateChange();
        var $vm = this;

        if($('#summernote')){
                $('#summernote').summernote({
                height: 300,

                callbacks: {
                    onChange: function(contents) {
                        $vm.content = contents; // сохраняем новые данные
                    }
                }
                
                })
                 
            }

            var $vm = this;

         
            
           

        },
    
    methods: {

        templateChange(event){
            
             console.log(event.target.value);
            
             Object.keys(this.metas).forEach(element => {
                delete this.metas[element];

            });

            this.$nextTick(function () {  
                var $vm = this;
                if($('#ipv_content_top')){
                $('#ipv_content_top').summernote({
                height: 300,

                callbacks: {
                    onChange: function(contents) {
                        $vm.metas.ipv_content_top = contents; // сохраняем новые данные
                    }
                }
                
                })
                 
            }
            

                
                if($('#ipv_content_bottom')){
                    $('#ipv_content_bottom').summernote({
                    height: 300,

                    callbacks: {
                        onChange: function(contents) {
                            $vm.metas.ipv_content_bottom = contents; // сохраняем новые данные
                        }
                    }
                    
                    })
                    
                }
                

                if($('#steps')){
                $('#steps').summernote({
                height: 300,

                callbacks: {
                    onChange: function(contents) {
                        $vm.metas.steps = contents; // сохраняем новые данные
                    }
                }
                
                })
                 
            }

            if($('#opt_content')){
                $('#opt_content').summernote({
                height: 300,

                callbacks: {
                    onChange: function(contents) {
                        $vm.metas.opt_content = contents; // сохраняем новые данные
                    }
                }
                
                })
                 
            }

            if($('#ceny_zagolovok')){
                $('#ceny_zagolovok').summernote({
                height: 300,

                callbacks: {
                    onChange: function(contents) {
                        $vm.metas.ceny_zagolovok = contents; // сохраняем новые данные
                    }
                }
                
                })
                 
            }

            if($('#zagolovok')){
                $('#zagolovok').summernote({
                height: 300,

                callbacks: {
                    onChange: function(contents) {
                        $vm.metas.zagolovok = contents; // сохраняем новые данные
                    }
                }
                
                })
                
            }


             

             
        })

        },
       addPage(){
         
            api.post('/api/auth/admin/page', {lang: this.lang, title:this.title, slug: this.slug, content: this.content, publish: this.publish, template: this.template, metas: this.metas})
           .then(res=>{
            console.log(res);
           })
           .catch(function (error) {
            console.log(error);
           });  

        },
 
        
    },

    computed:{
        
    }
}
</script>
<style lang="">
    
</style>
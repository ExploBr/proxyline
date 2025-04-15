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
                                <option value="txtpage" selected="selected">txtpage</option>
                            <option value="main">main</option>
                            <option value="contact">contact</option>
                            
                            <option value="ipv">ipv</option>
                            
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
                    <div class="from-group" >

                        <label for="title">Заголовок</label>
                        <input class="form-control"
                        value="" v-model="metas.zagolovok"
                        type="text"   id="zagolovok">

                    </div>

                    <div class="from-group" >

                        <label for="title">Подзаголовок</label>
                        <input class="form-control"
                        value="" v-model="metas.podzagolovok"
                        type="text"   id="podzagolovok">

                    </div>
                    
                </div>
                <div class="from-group" v-if="template == 'txtpage'">
                    <div class="from-group" >
                         
                    </div>
                    
                </div>

                <div class="from-group" v-if="template == 'contact'">
                    <div class="from-group" >

                        <label for="title">Подзаголовок</label>
                        <input class="form-control"
                        value="" v-model="metas.podzagolovok"
                        type="text"   id="podzagolovok">

                    </div>

                    <div class="from-group" >

                        <label for="title">Контакты</label>
                        <input class="form-control"
                        value="" v-model="metas.contact"
                        type="text"   id="contact">

                    </div>
                    
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

        },
    
    methods: {

        templateChange(event){
            
             console.log(event.target.value);
            
             Object.keys(this.metas).forEach(element => {
                delete this.metas[element];

            });
 

        },
       addPage(){
           
           api.post('/api/auth/admin/page', {title: this.title, slug: this.slug, content: this.content, publish: this.publish, template: this.template, metas: this.metas})
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
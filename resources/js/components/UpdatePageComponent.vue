<template lang="">
    <div>

        <div class="form-group col-3">
                        <label for="title">Язык</label>
                        <select class="form-control" v-model="lang" @change="langChange">
                            <option value="all" >Для всех</option>
                            <option value="ru" selected="selected">Русский</option>
                            <option value="en">Английский</option>
                            <option value="fr">Французкий</option>
                        </select>
                    </div>

        <template v-for="(item, index) in maindata" :key="index">
            <div class="" v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                <div class="row"> 
                     
                    
                </div>
                <div class="row"> 
                    <div class="form-group col-6">
                            <label for="title">Имя</label>
                            <input
                                class="form-control"
                                v-model="item.title"
                                type="text"
                                id="title"
                            />
                    </div>
                    <div class="form-group col-6">
                        <label for="title">Url | Slug</label>
                        <input class="form-control" v-model="item.slug" type="text" id="slug" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="title">Шаблон</label>
                        <select
                            class="form-control"
                            v-model="item.template"
                            @change="templateChange($event)"
                            >
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
                            <option value="checkipv6">Проверка iPv6</option>
                            <option value="freeproxy">Бесплатные прокси</option>
                            <option value="myip">Мой IP</option>
                            <option value="anonymous">Анонимность</option>
                            <option value="faq">Faq</option>
                            <option value="apipage">Api</option>
                            <option value="instruction">Общая инструкций</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summernote">Контент</label>

                    <div class="card card-outline card-info">
                        <div class="card-body">
                            <textarea v-model="item.content" id="summernote">
                                    {{ item.content }}
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="icheck-primary d-inline" v-if="index == 0">
                        <input type="checkbox" id="publish"  v-model="getPublish" @change="publishChange"   />
                        <label for="publish"> Опубликовано </label>
                </div>



                <div class="form-group">
            

                <div class="form-group" v-if="item.template" >
                    <h2>Метаданные</h2>
                    <div class="from-group" v-if="item.template == 'main'">
                        <MainComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></MainComponent>
                    </div>


                    <div class="from-group" v-if="item.template == 'ipv'">
                        <IpvComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></IpvComponent>
                    </div>


                    <div class="from-group" v-if="item.template == 'txtpage'">
                        <TxtComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></TxtComponent>
                    </div>
                    

                    <div class="from-group" v-if="item.template == 'contact'">
                        <ContactComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></ContactComponent>
                    </div>

                    <div class="from-group" v-if="item.template == 'partner'">
                        <PartnersComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></PartnersComponent>
                    </div>

                    <div class="from-group" v-if="item.template == 'optovikam'">
                        <OptComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></OptComponent>
                    </div>

                    <div class="from-group" v-if="item.template == 'ceny'">
                        <CenyComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></CenyComponent>
                    </div>
                    <div class="from-group" v-if="item.template == 'checker'">
                        <div class="from-group" >
                        <label for="">Список</label>
                            <textarea v-model="metas[0].spisok" class="w-100" rows="5">
                                            {{ metas[0].spisok }}
                            </textarea>
                        </div>
                    </div>

                    <div class="from-group" v-if="item.template == 'speed'">
                        <label>Заголовок</label>
                        <textarea v-model="metas[0].content" class="w-100" rows="5" id="zagolovok">
                                            {{ metas[0].content }}
                            </textarea>
                    </div>


                    <div class="from-group" v-if="item.template == 'ports'">
                        <label>Заголовок</label>
                        <textarea v-model="metas[0].content" class="w-100" rows="5" id="zagolovok">
                                            {{ metas[0].content }}
                            </textarea>
                    </div>

                    <div class="from-group" v-if="item.template == 'freeproxy'">
                        <label>Заголовок</label>
                        <textarea v-model="metas[0].content" class="w-100" rows="5" id="zagolovok">
                                            {{ metas[0].content }}
                            </textarea>
                    </div>

                    <div class="from-group" v-if="item.template == 'faq'">
                        <FaqComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></FaqComponent>
                    </div>

                    <div class="from-group" v-if="item.template == 'apipage'">
                        <textarea v-model="metas[0].content" class="w-100" rows="5" id="zagolovok">
                                            {{ metas[0].content }}
                            </textarea>
                    </div>


                </div>


                <div class="form-group mt-25">
                    <h2>СЕО</h2>
                    <div class="from-group">
                        <SeoComponent :seo="seo" :newlang = "lang == 'all' ? 'ru' : lang"></SeoComponent>
                    </div>
                </div>

            </div>
             
             
        </div>

         
    </template>
         
     
        <button
            type="submit"
            class="btn btn-primary"
            @click.prevent="updatePage"
        >
            Обновить
        </button>
    </div>
</template>
<script>
import api from "../api";
import MainComponent from "./templates/MainComponent.vue";
import ContactComponent from "./templates/ContactComponent.vue";
import IpvComponent from "./templates/IpvComponent.vue";
import PartnersComponent from "./templates/PartnersComponent.vue";
import OptComponent from "./templates/OptComponent.vue";
import CenyComponent from "./templates/CenyComponent.vue";
import TxtComponent from "./templates/TxtComponent.vue";
import SeoComponent from "./templates/SeoComponent.vue";
import FaqComponent from "./templates/FaqComponent.vue";
export default {
    name: "UpdatePageComponent",

    props: ["data", "datameta" , 'dataseo'],
    data() {
        return {
            lang: 'ru',
            title: null,
            slug: null,
            content: null,
            publish: null,
            template: null,
            metas: this.datameta === null ? [] :   this.datameta,
            maindata:this.data === null ? [] :   this.data,
            seo:this.dataseo === null ? [] :   this.dataseo,
        };
    },
    mounted() {
        console.log(this.metas);
        // this.templateChange();
         this.langChange();
    },

    methods: {
        updatePage() {
      
            this.maindata.forEach(element => {
                
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                    
                let metadata = [];
                let seo_data = [];
                console.log(this.metas);
                this.metas.forEach(element => {
                   
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru'))
                    metadata.push(element);
                });

              console.log(this.seo);
                this.seo.forEach(element => {     
                            
                     if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru'))
                     seo_data.push(element);
                 });
                

                api.patch(`/api/auth/admin/page/${element.slug}`, {
                    title: element.title,
                    slug: element.slug,
                    content: element.content,
                    publish: this.maindata[0].publish,
                    template: element.template,
                    metas: metadata,
                    seo:seo_data,
                    lang : this.lang
                 })
                .then((res) => {
                    console.log(res);
                })
                .catch(function (error) {
                    console.log(error);
                });

                return
                }
                
            });
             
             

            
        },
        templateChange(event) {

            let LangData = [];
            let LangSeo = [];


            // Adding languages ​​available in the array

            this.metas.forEach((element,index) => {
                LangData.push(element.lang)
            })

            this.dataseo.forEach((element,index) => {
                LangSeo.push(element.lang)
            })



            // If there is no current language,
            // add empty data to display in the current language

            if(LangData.includes(this.lang) == false && this.lang != 'all'){

                this.datameta.forEach(element => {
                    if(element.lang == 'ru'){
                     this.metas.push({name:element.name,content:"", lang: this.lang})
                    }
                });
                 

            }
            if(LangSeo.includes(this.lang) == false && this.lang != 'all'){

                this.seo.forEach(element => {
                    if(element.lang == 'ru'){
                     this.seo.push({name:element.name,content:"", lang: this.lang})
                    }
                });
                 

            }


           this.metas.forEach(element => {
                if(element.lang == this.lang){
                    
                    this.metas = this.datameta;
                }
            });
           this.seo.forEach(element => {
                if(element.lang == this.lang){
                    
                    this.seo = this.dataseo;
                }
            });


            this.$nextTick(function () { 
                 
                 this.maindata.forEach((element,index) => {
                 if(element.lang == this.lang){
                     
                      
                     if ($("#summernote")) {
                         $("#summernote").summernote({
                             height: 300,
                             
                             callbacks: {
                                 
                                 onChange: function (contents) {
                                     $vm.maindata[index].content = contents; // сохраняем новые данные
                                     
                                 },
                                 onKeydown: function(e) {
                                     e.stopPropagation();
                                     }
                                 
                             },
                         });
                     }
                  
 
                     
                 }
             })
  
             var $vm = this;
                 this.metas.forEach((element,index) => {
                     if(element.lang == this.lang){
 
                     if($(`textarea#${element.name}`)){
                     $(`textarea#${element.name}`).summernote({
                     height: 300,
 
                     callbacks: {
                         onChange: function(contents) {
                             
                             $vm.metas[index].content = contents; // сохраняем новые данные
                         }
                     }
                     
                     })
                     
                     }
                  
 
                 }
 
             });
         });
              
             
        },
        langChange(){

            

            let LangData = [];

            let LangSeo = [];


            // Adding languages ​​available in the array

            this.dataseo.forEach((element,index) => {
                LangSeo.push(element.lang)
            })

            this.maindata.forEach((element,index) => {
                LangData.push(element.lang)
            })

            if(LangData.includes(this.lang) == false && this.lang != 'all'){
                this.maindata.push({title: '', slug: null, content: null,publish: this.maindata[0].publish, template: this.data[0].template, lang: this.lang})
                
                this.datameta.forEach(element => {
                    if(element.lang == 'ru'){
                     this.metas.push({name:element.name,content:"", lang: this.lang})
                    }
                });
            }

            if(LangSeo.includes(this.lang) == false && this.lang != 'all'){

            this.seo.forEach(element => {
                if(element.lang == 'ru'){
                this.seo.push({name:element.name,content:"", lang: this.lang})
                }
            });
            

            }

             
            
            var $vm = this;
            this.maindata.forEach(element => {
                if(element.lang == this.lang){
                    $vm.content = element.content
                }
            });
           


            // use nextTick for initialization summernote
            // and compare languages ​​for the required update

            this.$nextTick(function () { 
                 
                this.maindata.forEach((element,index) => {
                if(element.lang == this.lang){
                    
                     
                    if ($("#summernote")) {
                        $("#summernote").summernote({
                            height: 300,
                            
                            callbacks: {
                                
                                onChange: function (contents) {
                                    $vm.maindata[index].content = contents; // сохраняем новые данные
                                    
                                },
                                onKeydown: function(e) {
                                    e.stopPropagation();
                                    }
                                
                            },
                        });
                    }
                    
                }
            })
            
               

            var $vm = this;
                this.metas.forEach((element,index) => {
                    console.log(element.name);
                    if(element.lang == this.lang){

                    if($(`textarea#${element.name}`)){
                    $(`textarea#${element.name}`).summernote({
                    height: 300,

                    callbacks: {
                        onChange: function(contents) {
                             
                            $vm.metas[index].content = contents; // сохраняем новые данные
                        }
                    }
                    
                    })
                    
                    }
                }

            });
        });
             
        },
         
        publishChange(){
            
            this.maindata[0].publish = !this.maindata[0].publish;
        }
         
    },
    components: {
        MainComponent,
        ContactComponent,
        IpvComponent,
        PartnersComponent,
        OptComponent,
        CenyComponent,
        TxtComponent,
        SeoComponent,
        FaqComponent,
    },
    computed: {
        getPublish:{
            get() {
                return this.maindata[0].publish == 1 ? true : false;
            },
            
            
        }
       
    }
    
};
</script>
<style lang=""></style>

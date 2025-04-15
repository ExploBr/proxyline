<template lang="">
    <div>
        <template v-for="(item, index) in data" :key="index">
            <div class="" v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                <div class="row"> 
                    <div class="form-group col-3">
                        <label for="title">Язык</label>
                        <select class="form-control" v-model="lang" @change="langChange">
                            <option value="all" >Для всех</option>
                            <option value="ru" selected="selected">Русский</option>
                            <option value="en">Английский</option>
                            <option value="fr">Французкий</option>
                        </select>
                    </div>
                    
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
                            <option value="txtpage" selected="selected">txtpage</option>
                            <option value="main">main</option>
                            <option value="contact">contact</option>

                            <option value="ipv">ipv</option>
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

                <div class="icheck-primary d-inline" >
                        <input type="checkbox" id="publish"  v-model="getPublish[index]"   />
                        <label for="publish"> Опубликовано </label>
                </div>



                <div class="form-group">
            

                <div class="form-group" v-if="item.template" >
                    <h2>Метаданные</h2>
                    <div class="from-group" v-if="item.template == 'main'">
                        <MainComponent :metas="metas" :newlang = "lang == 'all' ? 'ru' : lang"></MainComponent>
                    </div>
                    <div class="from-group" v-if="item.template == 'txtpage'">
                        <div class="from-group"></div>
                    </div>

                    <div class="from-group" v-if="item.template == 'contact'">
                        <ContactComponent :metas="metas"></ContactComponent>
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

export default {
    name: "UpdatePageComponent",

    props: ["data", "datameta"],
    data() {
        return {
            lang: 'ru',
            title: null,
            slug: null,
            content: null,
            publish: null,
            template: null,
            metas: this.datameta,
        };
    },
    mounted() {
         
        // this.templateChange();
         this.langChange();
    },

    methods: {
        updatePage() {

            this.data.forEach(element => {
                
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                    
                let metadata = [];
                this.metas.forEach(element => {
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru'))
                    metadata.push(element);
                });

                console.log(metadata);
                api.patch(`/api/auth/admin/page/${element.slug}`, {
                    title: element.title,
                    slug: element.slug,
                    content: this.content,
                    publish: element.publish,
                    template: element.template,
                    metas: metadata,
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
             
            /*   translate(){
               axios.post('http://127.0.0.1:8000/api/translate', {"text": "Hello, how are you?", "language": "Spanish"}).then(res=>{
               console.log(res);
              })
              .catch(function (error) {
               console.log(error);
              }); 
           }, */

            
        },
        templateChange(event) {
            console.log(event.target.value);

            this.metas = this.datameta;
        },
        langChange(){
   
            console.log(this.data);
            var $vm = this;
            this.data.forEach(element => {
                if(element.lang == this.lang){
                    $vm.content = element.content
                }
            });
            if ($("#summernote")) {
                $("#summernote").summernote({
                    height: 300,
                    
                    callbacks: {
                        
                        onChange: function (contents) {
                            $vm.content = contents; // сохраняем новые данные
                            
                        },
                        onKeydown: function(e) {
                            e.stopPropagation();
                            }
                        
                    },
                });
            }
             
        },
         

         
    },
    components: {
        MainComponent,
        ContactComponent,
    },
    computed: {
        // corrections start
        getPublish() {
            return this.data.map(function(item) {
                return item.publish == 1 ? true : false;
            });
        }
    }
    
};
</script>
<style lang=""></style>

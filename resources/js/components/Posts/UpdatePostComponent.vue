<template lang="">
<div>
    <div class="form-group col-3">
        <label for="title">Язык</label>
        <select class="form-control" v-model="lang" @change="langChange">
            <option value="all">Для всех</option>
            <option value="ru" selected="selected">Русский</option>
            <option value="en">Английский</option>
            <option value="fr">Французкий</option>
        </select>
    </div>

    <template v-for="(item, index) in maindata" :key="index">
        <div class="" v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang">
            <div class="row">
                <div class="form-group col-6">
                    <label for="title">Имя</label>
                    <input class="form-control" v-model="item.title" type="text" id="title" />
                </div>
                <div class="form-group col-6">
                    <label for="title">Url | Slug</label>
                    <input class="form-control" v-model="item.slug" type="text" id="slug" />
                </div>
                <div class="form-group  col-6">
                    <label for="title">Дата создания</label>
                    <input class="form-control" value="" v-model="item.created" type="text" id="created">

                </div>

            </div>

            <div class="form-group">
                <label for="summernote">Превью</label>

                <div class="card card-outline card-info">
                    <div class="card-body">
                        <textarea v-model="item.preview" id="preview">
                        {{ item.preview }}
                        </textarea>
                    </div>
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
                <input type="checkbox" id="publish" v-model="getPublish" @change="publishChange" />
                <label for="publish"> Опубликовано </label>
            </div>

            <div class="form-group mt-25">
                <h2>СЕО</h2>
                <div class="from-group">
                    <SeoComponent :seo="seo" :newlang="lang == 'all' ? 'ru' : lang"></SeoComponent>
                </div>
            </div>

        </div>
    </template>

    <button type="submit" class="btn btn-primary" @click.prevent="updatePage">
        Обновить
    </button>
</div>
</template>

<script>
import api from '../../api';
import SeoComponent from '../templates/SeoComponent.vue';

export default {
    name: "UpdatePostComponent",

    props: ["data", 'dataseo'],

    data() {
        return {
            lang: 'ru',
            title: null,
            slug: null,
            content: null,
            publish: null,
            preview: null,
            maindata: this.data === null ? [] : this.data,
            seo: this.dataseo === null ? [] : this.dataseo,
        };
    },
    mounted() {
        this.langChange();
    },
    methods: {
        updatePage() {

            this.maindata.forEach(element => {

                if (element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')) {

                    let seo_data = [];
                    
                    console.log(this.seo);
                    this.seo.forEach(element => {

                        if (element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru'))
                            seo_data.push(element);
                    });
                    console.log(element);
                    api.patch(`/api/auth/admin/post/${element.slug}`, {
                            title: element.title,
                            slug: element.slug,
                            content: element.content,
                            publish: this.maindata[0].publish,
                            preview: element.preview,
                            created:element.created,
                            seo: seo_data,
                            lang: this.lang
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
        langChange(){
            var $vm = this;
            let LangData = [];
            let LangSeo = [];

            this.dataseo.forEach((element,index) => {
                LangSeo.push(element.lang)
            })

            this.maindata.forEach((element,index) => {
                LangData.push(element.lang)
            })

            if(LangData.includes(this.lang) == false && this.lang != 'all'){
                this.maindata.push({title: '', slug: null, content: null,publish: this.maindata[0].publish, preview: this.data[0].preview, lang: this.lang})

            }

            if(LangSeo.includes(this.lang) == false && this.lang != 'all'){

            this.seo.forEach(element => {
                if(element.lang == 'ru'){
                this.seo.push({name:element.name,content:"", lang: this.lang})
                }
            });
            

            }

            this.seo.forEach(element => {
                if(element.lang == this.lang){
                    
                    this.seo = this.dataseo;
                }
            });


            this.$nextTick(function () { 
                this.maindata.forEach((element,index) => {
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

                     if ($("#preview")) {
                         $("#preview").summernote({
                             height: 300,
                             
                             callbacks: {
                                 
                                 onChange: function (contents) {
                                     $vm.maindata[index].preview = contents; // сохраняем новые данные
                                     
                                 },
                                 onKeydown: function(e) {
                                     e.stopPropagation();
                                     }
                                 
                             },
                         });
                     }
                    })

            })




        },

        publishChange(){
            
            this.maindata[0].publish = !this.maindata[0].publish;
        }

    },
    components: {
        SeoComponent,
    },
    computed: {
        getPublish:{
            get() {
                return this.maindata[0].publish == 1 ? true : false;
            },       
        }
       
    }
}
</script>

<style lang="">

</style>

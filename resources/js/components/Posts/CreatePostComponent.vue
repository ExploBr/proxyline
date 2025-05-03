<template lang="">
    <div>
        <div class="form-group col-3">
        <label for="title">Язык</label>
        <select class="form-control" v-model="lang">
            <option value="all">Для всех</option>
            <option value="ru" selected="selected">Русский</option>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Имя</label>
        <input class="form-control" value="" v-model="title" type="text" id="title">

    </div>

    <div class="form-group  ">
        <label for="title">Url | Slug</label>
        <input class="form-control" value="" v-model="slug" type="text" id="slug">

    </div>

    <div class="form-group  ">
        <label for="title">Дата создания</label>
        <input class="form-control" value="" v-model="created" type="text" id="created">

    </div>

    <div class="form-group">
        <label for="summernote">Превью</label>

        <div class="">

        
                <textarea v-model="content" id="preview">

                    </textarea>
           
        </div>

    </div>

    <div class="form-group">
        <label for="summernote">Контент</label>

        <div class="card card-outline card-info">

            <div class="card-body">
                <textarea v-model="content" id="summernote">

                    </textarea>
            </div>
        </div>

    </div>

    <div class="form-group">
        <div class="icheck-primary d-inline">
            <input type="checkbox" v-model="publish" id="publish">
            <label for="publish">
                Опубликовано
            </label>
        </div>
    </div>

    <div class="seo mt-25">
            <h2>Блок СЕО</h2>
            <div class="from-group mt-25">
                <label for="title" class=" ">Title</label>
                <input class="form-control" value="" v-model="seo.seo_title" type="text" id="seo_title">
            </div>
            <div class="from-group mt-25">
                <label for="title" class=" ">Description</label>
                <textarea class="form-control" value="" v-model="seo.seo_description" type="text" id="seo_description" rows="5"></textarea>
            </div>

            <div class="from-group mt-25">

                <label for="">NoIndex</label>
                <input class="form-control" value="index, follow" v-model="seo.seo_noindex" type="text" id="seo_noindex">

            </div>

            <div class="from-group mt-25">

                <label for="">OG title</label>
                <input class="form-control" value="index, follow" v-model="seo.seo_og_title" type="text" id="seo_noindex">

            </div>
            <div class="from-group mt-25">

                <label for="">OG image</label>
                <input class="form-control" value="index, follow" v-model="seo.seo_og_image" type="text" id="seo_noindex">

            </div>
            <div class="from-group mt-25">

                <label for="">OG type</label>
                <input class="form-control" value="index, follow" v-model="seo.seo_og_type" type="text" id="seo_noindex">

            </div>
            <div class="from-group mt-25">

                <label for="">OG description</label>
                <input class="form-control" value="index, follow" v-model="seo.seo_og_description" type="text" id="seo_noindex">

            </div>

        </div>

        <button type="submit" class="btn btn-primary " @click.prevent="addPage">Добавить</button>
    </div>
</template>
<script>
import api from '../../api';
export default {
    name:"CreatePostComponent",

    data() {
        return {
            title: null,
            slug: null,
            content: null,
            publish: null,
            lang: 'ru',
            created:'',
            seo: {

            },
            preview:''

        }
        
    },

    mounted() {

 
    var $vm = this;

    if ($('#summernote')) {
        $('#summernote').summernote({
            height: 300,

            callbacks: {
                onChange: function (contents) {
                    $vm.content = contents; // сохраняем новые данные
                }
            }

        })

    }
    if ($('#preview')) {
        $('#preview').summernote({
            height: 300,

            callbacks: {
                onChange: function (contents) {
                    $vm.preview = contents; // сохраняем новые данные
                }
            }

        })

    }

    var $vm = this;

    },
    methods: {
         addPage() {

            console.log(this.metas);
            api.post('/api/auth/admin/post', {
                    lang: this.lang,
                    title: this.title,
                    slug: this.slug,
                    content: this.content,
                    publish: this.publish,
                    preview:this.preview,
                    created:this.created,
                    seo: this.seo
                })
                .then(res => {
                    console.log(res);
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
    },

}
</script>
<style lang="">
    
</style>
<template lang="">
    <div>
        
        <div class="form-group col-3">
                        <label for="title">Язык</label>
                        <select class="form-control" v-model="lang" @change="langChange">
                            <option value="all" >Для всех</option>
                            <option value="ru" selected="selected">Русский</option>
                            <option value="en">Английский</option>
                            <option value="de">Немецкий</option>
                            <option value="ze">Китайский</option>
                            <option value="hi">Хинди</option>
                            <option value="fr">Французкий</option>
                            <option value="es">Испанский</option>
                            <option value="pt">Португальский</option>
                            <option value="uk">Украинский</option>
                            <option value="be">Белорусский</option>
                            <option value="lt">Литовский</option>
                            <option value="lv">Латышский</option>
                            <option value="pl">Польский</option>
                            <option value="cs">Чешский</option>
                            <option value="az">Азербайджанский</option>
                            <option value="sk">Словацкий</option>
                            <option value="et">Эстонский</option>
                            <option value="ro">Румынский</option>
                            <option value="kk">Казахский</option>
                            <option value="it">Итальянский</option>
                            <option value="nl">Нидерландский</option>
                            <option value="tr">Турецкий</option>
                            <option value="id">Индонезийский</option>
                        </select>
        </div>

        <div class="from-group" >
            
           
            <ul class="nav nav-tabs" id="content-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="adv-tab-tab" data-toggle="pill" href="#adv-tab" role="tab" aria-selected="true" aria-controls="adv-tab">Преимущества</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="whereuse-tab-tab" data-toggle="pill" href="#whereuse-tab" role="tab" aria-selected="false" aria-controls="whereuse-tab">Где использовать</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="seo-tab-tab" data-toggle="pill" href="#seo-tab" role="tab" aria-selected="false" aria-controls="seo-tab">СЕО блок</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="affilate-tab-tab" data-toggle="pill" href="#affilate-tab" role="tab" aria-selected="false" aria-controls="affilate-tab">Партнеры блок</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="calculator-tab-tab" data-toggle="pill" href="#calculator-tab" role="tab" aria-selected="false" aria-controls="calculator-tab">Калькулятор блок</a>
                </li>
                
            </ul>
            <div class="tab-content" id="content-tabContent">  
                <div class="tab-pane fade show active" id="adv-tab" role="tabpanel" aria-labelledby="adv-tab">
                    <template v-for="(item, index) in advantages" :key="index">
                    <div v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                        <label class="mt-25">Изображения</label>    
                        <div ref="adv_images" id="adv_images"  class="from-group w-100 bg-dark p-5 text-center adv_images admin-images">
                            
                        </div>

                        <label >Текст</label>    
                        
                        <template v-for="(adv, index2) in item.content" :key="index2"> 
                            
                            <div class="from-group d-flex g-10 a-start"> 
                                <input class="form-control d-block w-75 mb-25"
                                value="" v-model="adv.content"
                                type="text"  >
                                <button type="submit" class="btn btn-primary " @click.prevent="removeAdvantages(index2)">X</button>
                            </div>
                            
                        </template>
                    </div>         
                    </template>
                    <button type="submit" class="btn btn-primary " @click.prevent="addAdvantages">Добавить Преимущества</button>
                </div>

                <div class="tab-pane fade" id="whereuse-tab" role="tabpanel" aria-labelledby="whereuse-tab"> 
                    <template v-for="(item, index) in whereuse" :key="index">
                        <div v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                            <label class="mt-25">Изображения</label>

                            <div ref="whereuse_image" id="whereuse_image"  class="from-group w-50 bg-dark p-5 text-center  admin-images">
                                    
                            </div>

                            <label class="mt-25">Контент</label>    
                            <textarea v-model="item.content.content" id="summernote" ref="summernote">
                                            {{ item.content.content }}
                            </textarea>
                        </div>
                    </template>
                </div>
                <div class="tab-pane fade" id="seo-tab" role="tabpanel" aria-labelledby="seo-tab">

                    <template v-for="(item, index) in seodata" :key="index">
                        <div v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                            <label class="mt-25">Контент</label>
                            <textarea v-model="item.content" id="summernote_seo" ref="summernote_seo">
                                            {{ item.content }}
                            </textarea>
                        </div>
                    </template>

                </div>

                <div class="tab-pane fade" id="affilate-tab" role="tabpanel" aria-labelledby="affilate-tab">

                    <template v-for="(item, index) in affilatedata" :key="index">
                        <div v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                            <label class="mt-25">Контент</label>
                            <textarea v-model="item.content" id="summernote_affilate" ref="summernote_affilate">
                                            {{ item.content }}
                            </textarea>
                        </div>
                    </template>

                </div>


                <div class="tab-pane fade" id="calculator-tab" role="tabpanel" aria-labelledby="calculator-tab">

                <template v-for="(item, index) in calculatordata" :key="index">
                    <div v-if="(this.lang == 'all' && item.lang == 'ru') || item.lang == this.lang"> 
                        <label class="mt-25">Контент</label>
                        
                        <template v-for="(content, index) in item.content"> 
                            <div class="mt-25"> 
                            Попап-{{index+1}}
                            <textarea class="w-100" v-model="content.popup" rows="14"  >
                                            {{ content.popup }}
                            </textarea>
                            </div>
                        </template>
                    </div>
                </template>

                </div>
                 

            </div>
          
             
        </div>

        <button type="submit" class="btn btn-primary mt-25" @click.prevent="storeContent">Обновить</button>


         
 
    </div>

    
</template>

 
<script>
import axios from 'axios';
import Dropzone from 'dropzone';
import api from '../api';
 

export default {
    name: 'MainContentComponent',

    props: [
        'data_adv', 'data_whereuse', 'data_seo', 'data_affilate', 'data_calculator'
    ],
    data() {
        return {
            advantages:this.data_adv === null ? [] :   this.data_adv,
            adv_images : [],
            lang: 'ru',
             
            whereuse: this.data_whereuse === null ? [] :   this.data_whereuse,
            whereuse_image : [],

            seodata: this.data_seo === null ? [] :   this.data_seo,

            affilatedata: this.data_affilate === null || this.data_affilate === undefined ? [] :   this.data_affilate,

            calculatordata: this.data_calculator === null || this.data_calculator === undefined ? [] :   this.data_calculator,
        }
    },
    
    mounted(){
 
        // We receive data, some comes in different forms from, here json.parse
        this.advantages.forEach((element,index) => {   
                 this.advantages[index].content = JSON.parse(this.advantages[index].content)
        })
        this.whereuse.forEach((element,index) => {   
                 this.whereuse[index].content = JSON.parse(this.whereuse[index].content)
        })
        this.seodata.forEach((element,index) => {   
                 this.seodata[index].content = (this.seodata[index].content)
        })

        this.affilatedata.forEach((element,index) => {   
                 this.affilatedata[index].content = (this.affilatedata[index].content)
        })

        this.calculatordata.forEach((element,index) => {   
                 this.calculatordata[index].content = JSON.parse(this.calculatordata[index].content)
        })
        this.langChange();
        
    },

    methods: {

        langChange(){
             // add new lang if empty

            let LangAdv = [];
            let LangWhere = [];
            let LangSeo = [];
            let LangAffilate = [];
            let LangCalculator = [];
            
            
            // Adding languages ​​available in the array

            this.advantages.forEach((element,index) => {
                LangAdv.push(element.lang)
            })
 
            this.whereuse.forEach((element,index) => {
                LangWhere.push(element.lang)
            })

            this.seodata.forEach((element,index) => {
                LangSeo.push(element.lang)
            })

            this.affilatedata.forEach((element,index) => {
                LangAffilate.push(element.lang)
            })

            this.calculatordata.forEach((element,index) => {
                LangCalculator.push(element.lang)
            })


            // If there is no current language,
            // add empty data to display in the current language

            if(LangAdv.includes(this.lang) == false && this.lang != 'all'){
                this.advantages.push({content: [], lang: this.lang})
            }

            if(LangWhere.includes(this.lang) == false && this.lang != 'all'){
                this.whereuse.push({content: {content:null}, lang: this.lang})
            }

            if(LangSeo.includes(this.lang) == false && this.lang != 'all'){
                this.seodata.push({content: '', lang: this.lang})
            }

            if(LangAffilate.includes(this.lang) == false && this.lang != 'all'){
                this.affilatedata.push({content: '', lang: this.lang})
            }
            
            if(LangCalculator.includes(this.lang) == false && this.lang != 'all'){
                this.calculatordata.push({content: [{popup:null}, {popup:null}, {popup:null}], lang: this.lang})
            }
            // end "add lang"
          

            // START IMAGES

           if(this.$refs.adv_images[0] == undefined){
            this.$nextTick(function () {
                this.adv_images = new Dropzone(this.$refs.adv_images[0], {
                    url:'/api/auth/admin/main-content',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить'
                })
            })
            }else{
                this.adv_images = new Dropzone(this.$refs.adv_images[0], {
                    url:'/api/auth/admin/main-content',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить'
                })
            }

            
            if(this.$refs.whereuse_image[0] == undefined){
            this.$nextTick(function () {
                this.whereuse_image = new Dropzone(this.$refs.whereuse_image[0], {
                    url:'/api/auth/admin/main-content',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить'
                })
            })
            }else{
                this.whereuse_image = new Dropzone(this.$refs.whereuse_image[0], {
                    url:'/api/auth/admin/main-content',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить'
                })
            }

       

            // END IMAGES


            // SORT IMAGE

            let thisAdvImage = this.adv_images;
            let thisWhereImage = this.whereuse_image;

                $('#adv_images').sortable({
                    stop: function () { 
                         
                        var queue = thisAdvImage.files; 
                         
                        var newQueue = []; 
                        $('.adv_images .dz-preview .dz-filename [data-dz-name]').each(function (count, el) { 
                            var name = el.innerHTML; 
                            queue.forEach(function (file) { 
                                if (file.name === name) { 
                                    newQueue.push(file); 
                                } 
                            }); 
                        }); 
                        thisAdvImage.files = newQueue; 
                       
                    }
                    
                 });


                 // END SORT


                // PREVIEW IMAGES

                if(this.advantages){
                this.advantages.forEach(element => {
                        if(element.lang == this.lang && element.content){
                            element.content.forEach(element2 => {
                                let file = { name: element2.image.name, size: element2.image.size };
                                this.adv_images.files.push({'name': element2.image.name,'path':element2.image.path, 'url' : element2.image.url});
                                this.adv_images.displayExistingFile(file, element2.image.url)
                            });
                        }
                        
                 }); 
                }
               
                if(this.whereuse){
                this.whereuse.forEach(element => {
                         
                        if(element.lang == this.lang && element.content){
                        
                            if(element.content.image){
                                let file = { name: element.content.image.name, size: element.content.image.size };
                                this.whereuse_image.files.push({'name': element.content.image.name,'path':element.content.image.path, 'url' : element.content.image.url});
                                this.whereuse_image.displayExistingFile(file, element.content.image.url)
                            }
                             
                        }
                    
                        
                 }); 
                }

                // END PREVIEW
                 
                // REMOVE IMAGES 
                
                if(this.adv_images.length>0 ){
                    this.adv_images.on('removedfile',(file)=>{                 
                    thisAdvImage.files = thisAdvImage.files.filter((el) => el.name !== file.name);     
                    })
                }

                 
                if(this.whereuse_image.files.length>0 ){
                   
                    this.whereuse_image.on('removedfile',(file)=>{                 
                    thisWhereImage.files = thisWhereImage.files.filter((el) => el.name !== file.name);
                    
                    })
                }

                // END REMOVE


                // TEXTEDITOR 

                            // use nextTick for initialization summernote
                            // and compare languages ​​for the required update
                            this.$nextTick(function () {  

                                var $vm = this;
                          
                                this.whereuse.forEach((element,index) => {
                                    if(element.lang == this.lang){
                                  
                                            $vm.whereuse[index].content.content = element.content.content
                                            if ($("#summernote")) {
                                                $("#summernote").summernote({
                                                    height: 300,    
                                                    callbacks: {   
                                                        onChange: function (contents) {
                                                            $vm.whereuse[index].content.content = contents; // сохраняем новые данные     
                                                        },
                                                        onKeydown: function(e) {
                                                            e.stopPropagation();
                                                            }
                                                        },
                                                    });
                                                }                             
                                        }
                                    });
                                    
                                    console.log(this.seodata);
                                    this.seodata.forEach((element,index) => {
                                    if(element.lang == this.lang){
                                            $vm.seodata[index].content = element.content
                                            if ($("#summernote_seo")) {
                                                $("#summernote_seo").summernote({
                                                    height: 300,    
                                                    callbacks: {   
                                                        onChange: function (contents) {
                                                            $vm.seodata[index].content = contents; // сохраняем новые данные     
                                                        },
                                                        onKeydown: function(e) {
                                                            e.stopPropagation();
                                                            }
                                                        },
                                                    });
                                                }                             
                                        }
                                    }); 



                                    this.affilatedata.forEach((element,index) => {
                                    if(element.lang == this.lang){
                                            $vm.affilatedata[index].content = element.content
                                            if ($("#summernote_affilate")) {
                                                $("#summernote_affilate").summernote({
                                                    height: 300,    
                                                    callbacks: {   
                                                        onChange: function (contents) {
                                                            $vm.affilatedata[index].content = contents; // сохраняем новые данные     
                                                        },
                                                        onKeydown: function(e) {
                                                            e.stopPropagation();
                                                            }
                                                        },
                                                    });
                                                }                             
                                        }
                                    }); 


                            })
                                    

                // END TEXTEDITOR

        },
        addAdvantages(){
            this.advantages.forEach((element,index) => {
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                 this.advantages[index].content.push({  
                    content: '', 
                    image:{}
                    });
                }else{
                   if(this.advantages[index].content.length == 0){
                        this.advantages[index].content.push({  
                            content: '', 
                            image:{}
                        });
                    }
                }          
        })
                 
        },
        removeAdvantages(thisindex){
        
            this.advantages.forEach((element,index) => {
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                    element.content.splice(thisindex, 1);
                }       
            })           
        },
 
        storeContent(){
             
            const data = new FormData();
            let files
            data.append('lang', this.lang)

            // ADVANTAGES DATA
            if(this.adv_images.files){
                let adv_sort, adv_name;  
                // Add data to sorting, for the total number of all images  
                // and saving existing images 
                this.adv_images.files.forEach((element,index) => {
                    if(element instanceof File != true){
                        adv_sort = index
                        adv_name = element.name
                        data.append(`adv_imageshas[${index}][name]`, element.name) 
                        data.append(`adv_imageshas[${index}][path]`, element.path) 
                        data.append(`adv_imageshas[${index}][url]`, element.url)                                           
                    }else{
                        adv_sort = index
                        adv_name = element.upload.filename  
                    }                     
                      data.append(`adv_sort[${index}][name]`, adv_name) 
                      data.append(`adv_sort[${index}][sort]`, adv_sort) 
                      
                });
            }

            files = this.adv_images.getAcceptedFiles();
            files.forEach((file,index) => {
                file.sort = index;
                console.log(file);
                data.append('adv_images[]', file) 
                 
            });

            this.advantages.forEach((element,index) => {
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                    element.content.forEach(element2 => {
                       
                        data.append('adv_content[]', element2.content)
                    })
                }
            });

             // END ADVANTAGES


             // START WHEREUSE 
                
            let WhereFiles;

        
             //  saving existing images
            this.whereuse_image.files.forEach((element,index) => {
                    if(element instanceof File != true){
                       
                        data.append(`whereuse_imageshas[${index}][name]`, element.name) 
                        data.append(`whereuse_imageshas[${index}][path]`, element.path) 
                        data.append(`whereuse_imageshas[${index}][url]`, element.url)                                           
                    }                      
                });

             WhereFiles = this.whereuse_image.getAcceptedFiles();
                WhereFiles.forEach((file,index) => {
                    file.sort = index;
                    console.log(file);
                    data.append('whereuse_image[]', file) 
                    
                });



                this.whereuse.forEach((element,index) => {
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                        
                        data.append('whereuse_content[]', element.content.content)
                       
                    }
                });

             // END WHEREUSE


             // START SEOBLOCK

             this.seodata.forEach((element,index) => {
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                        
                        data.append('seoblock_content[]', element.content)
                       
                    }
                });


             // END SEOBLLOCK

             // START AFFILATE

             this.affilatedata.forEach((element,index) => {
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                        
                        data.append('affilateblock_content[]', element.content)
                       
                    }
                });

             // END AFFILATE


             // START CALCULATOR

             this.calculatordata.forEach((element,index) => {
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                        element.content.forEach(content => {
                            data.append('calculatorblock_content[]', content.popup)
                        });
                        
                       
                    }
                });
                
             // END CALCULATOR
            
            api.post('/api/auth/admin/main-content', data)
        },
    },
    computed:{
        itemContent(){
            
            this.advantages.forEach((element,index) => {
                if(element.lang != this.lang){
                    return   null;
                } 
            });
        }
    }
}
</script>
<style lang="">
    
</style>
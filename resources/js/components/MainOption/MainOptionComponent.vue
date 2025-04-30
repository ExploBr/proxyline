<template lang="">
    <div>
 
        <ul class="nav nav-tabs" id="content-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="main-tab-tab" data-toggle="pill" href="#main-tab" role="tab" aria-selected="true" aria-controls="main-tab">Основное</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews_ru-tab-tab" data-toggle="pill" href="#reviews_ru-tab" role="tab" aria-selected="false" aria-controls="reviews_ru-tab">Отзывы рус</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews_en-tab-tab" data-toggle="pill" href="#reviews_en-tab" role="tab" aria-selected="false" aria-controls="reviews_en-tab">Отзывы en</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="socials-tab-tab" data-toggle="pill" href="#socials-tab" role="tab" aria-selected="false" aria-controls="socials-tab">Контакты - ссылки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="menu__top-tab-tab" data-toggle="pill" href="#menu__top-tab" role="tab" aria-selected="false" aria-controls="menu__top-tab">Меню основное</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="menu__ifno-tab-tab" data-toggle="pill" href="#menu__info-tab" role="tab" aria-selected="false" aria-controls="menu__info-tab">Меню информация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="menu__main-bottom-tab-tab" data-toggle="pill" href="#menu__main-bottom-tab" role="tab" aria-selected="false" aria-controls="menu__info-tab">Меню основное(футер)</a>
                </li>
        </ul>

        <div class="tab-content" id="content-tabContent">  
            <div class="tab-pane fade show active" id="main-tab" role="tabpanel" aria-labelledby="main-tab">

                <div class="from-group" >
                    <h3 class="d-block">Логотип</h3>
                    <div>
                        <div ref="logo_image" id="logo_image"  class="from-group w-50 bg-dark p-5 text-center adv_images admin-images">
                                
                        </div>
                    </div>
                </div>

                <div class="from-group mt-25" >
                    <h3 class="d-block">Методы оплаты</h3>
                    <div>
                        <div ref="methods_image" id="methods_image"  class="from-group w-50 bg-dark p-5 text-center adv_images admin-images">
                                
                        </div>
                    </div>
                </div>


            </div>
         
            <div class="tab-pane fade" id="reviews_ru-tab" role="tabpanel" aria-labelledby="reviews_ru-tab">
                <h3>Изображения</h3>
                <div ref="reviews_ru_image" id="reviews_ru_image"  class="from-group w-50 bg-dark p-5 text-center adv_images admin-images">
                                
                </div>

                <h3 class="mt-25">Отзывы</h3>
                        <template v-for="(item, index) in reviews_ru[0]" :key="index"> 
                             
                            <div class="from-group d-flex g-10 a-start"> 
                                <input class="form-control d-block w-45 mb-25"
                                value="" v-model="item.name"
                                type="text"  >
                                <textarea class="form-control d-block w-45 mb-25"
                                value="" v-model="item.text" rows="3"
                                type="text"  placeholder="text">
                                </textarea>
                                <button type="submit" class="btn btn-primary " @click.prevent="removeReviewsRu(index)">X</button>
                            </div>
                            
                        </template>
                        <button type="submit" class="btn btn-primary " @click.prevent="addViewsRu">Добавить Отзыв</button>
            </div>


            <div class="tab-pane fade" id="reviews_en-tab" role="tabpanel" aria-labelledby="reviews_en-tab">
                <h3>Изображения</h3>
                <div ref="reviews_en_image" id="reviews_en_image"  class="from-group w-50 bg-dark p-5 text-center adv_images admin-images">
                                
                </div>

                <h3 class="mt-25">Отзывы</h3>

                <template v-for="(item, index) in reviews_en[0]" :key="index"> 
                            
                            <div class="from-group d-flex g-10 a-start"> 
                                <input class="form-control d-block w-45 mb-25"
                                value="" v-model="item.name"
                                type="text"  placeholder="name">
                                <textarea class="form-control d-block w-45 mb-25"
                                value="" v-model="item.text" rows="3"
                                type="text"  placeholder="text">
                                </textarea>
                                <button type="submit" class="btn btn-primary " @click.prevent="removeReviewsEn(index)">X</button>
                            </div>
                            
                </template>
                <button type="submit" class="btn btn-primary " @click.prevent="addViewsEn">Добавить Отзыв</button>
                 
            </div>

            <div class="tab-pane fade" id="menu__top-tab" role="tabpanel" aria-labelledby="menu__top-tab">
                <template v-for="(item, index) in menu_top_data" :key="index">
                    <div class="from-group d-flex w-100 g-10 a-bottom mb-25">
                        <div class="w-40"> 
                        <label>Название</label>
                        <input class="form-control d-block"
                            value="" v-model="item.name"
                            type="text"  placeholder="Название">
                        </div>
                        <div class="w-40">
                            <label>Url</label>
                            <select class="form-control" v-model="item.slug">
                                <template v-for="(page, index) in all_page" :key="index"> 
                                    <option 
                                        :value="page.slug"
                                    >
                                        {{page.slug}}
                                    </option>
                                </template>
                            </select> 
                        </div>      
                        <button type="submit" class="btn btn-primary  h-50" @click.prevent="removeMenu(menu_top_data,index)">X</button>    
                        <div class="d-flex directon-column ml-25 navigation-btn">
                            <i class="right fas fa-angle-left" @click = "MoveTop(menu_top_data, index)" style="transform: rotate(90deg);"></i>
                            <i class="right fas fa-angle-left" @click = "MoveBottom(menu_top_data, index)" style="transform: rotate(-90deg);"></i>
                        </div>         
                    </div>
                </template>
                <button type="submit" class="btn btn-primary " @click.prevent="addMenu(menu_top_data)">Добавить меню</button>
            </div>


            <div class="tab-pane fade" id="menu__info-tab" role="tabpanel" aria-labelledby="menu__info-tab">
                <template v-for="(item, index) in menu_info_data" :key="index">
                    <div class="from-group d-flex w-100 g-10 a-bottom mb-25">
                        <div class="w-40"> 
                        <label>Название</label>
                        <input class="form-control d-block"
                            value="" v-model="item.name"
                            type="text"  placeholder="Название">
                        </div>
                        <div class="w-40">
                            <label>Url</label>
                            <select class="form-control" v-model="item.slug">
                                <template v-for="(page, index) in all_page" :key="index"> 
                                    <option 
                                        :value="page.slug"
                                    >
                                        {{page.slug}}
                                    </option>
                                </template>
                            </select> 
                        </div>      
                        <button type="submit" class="btn btn-primary  h-50" @click.prevent="removeMenu(menu_info_data,index)">X</button>    
                        <div class="d-flex directon-column ml-25 navigation-btn">
                            <i class="right fas fa-angle-left" @click = "MoveTop(menu_info_data, index)" style="transform: rotate(90deg);"></i>
                            <i class="right fas fa-angle-left" @click = "MoveBottom(menu_info_data, index)" style="transform: rotate(-90deg);"></i>
                        </div>         
                    </div>
                </template>
                <button type="submit" class="btn btn-primary " @click.prevent="addMenu(menu_info_data)">Добавить меню</button>
            </div>


            <div class="tab-pane fade" id="menu__main-bottom-tab" role="tabpanel" aria-labelledby="menu__main-bottom-tab">
                <template v-for="(item, index) in menu_main_bottom_data" :key="index">
                    <div class="from-group d-flex w-100 g-10 a-bottom mb-25">
                        <div class="w-40"> 
                        <label>Название</label>
                        <input class="form-control d-block"
                            value="" v-model="item.name"
                            type="text"  placeholder="Название">
                        </div>
                        <div class="w-40">
                            <label>Url</label>
                            <select class="form-control" v-model="item.slug">
                                <template v-for="(page, index) in all_page" :key="index"> 
                                    <option 
                                        :value="page.slug"
                                    >
                                        {{page.slug}}
                                    </option>
                                </template>
                            </select> 
                        </div>      
                        <button type="submit" class="btn btn-primary  h-50" @click.prevent="removeMenu(menu_main_bottom_data,index)">X</button>    
                        <div class="d-flex directon-column ml-25 navigation-btn">
                            <i class="right fas fa-angle-left" @click = "MoveTop(menu_main_bottom_data, index)" style="transform: rotate(90deg);"></i>
                            <i class="right fas fa-angle-left" @click = "MoveBottom(menu_main_bottom_data, index)" style="transform: rotate(-90deg);"></i>
                        </div>         
                    </div>
                </template>
                <button type="submit" class="btn btn-primary " @click.prevent="addMenu(menu_main_bottom_data)">Добавить меню</button>
            </div>

            <div class="tab-pane fade" id="socials-tab" role="tabpanel" aria-labelledby="socials-tab">
                 
                <template v-for="(item, index) in socials_data" :key="index">
                    <div class="from-group">
                        <label>Изображение</label>
                        <div class="d-flex f-wrap g-10"> 
                            <input class="form-control d-block w-20"
                                value="" @change="fileSelected($event,socials_data,index)"
                                type="file"  placeholder="Изображение">

                            <div class="d-block w-40">
                                    <img v-if="item.image.url" :src="item.image.url" />
                            </div>
                        </div>
                        <div class="d-flex f-wrap g-10"> 
                         

                        <input class="form-control d-block w-40"
                            value="" v-model="item.link"
                            type="text"  placeholder="Ссылка">

                        <input class="form-control d-block w-40"
                            value="" v-model="item.name"
                            type="text"  placeholder="Название">

                        <input class="form-control d-block w-40"
                            value="" v-model="item.podpis"
                            type="text"  placeholder="Подпись">

                        </div>
                    </div>
                </template>
                <button type="submit" class="btn btn-primary " @click.prevent="addSocials(socials_data)">Добавить</button>
            </div>
         

        </div>


        <button type="submit" class="btn btn-primary mt-25" @click.prevent="storeContent">Обновить</button>
    </div>
</template>
<script>
import axios from 'axios';
import Dropzone from 'dropzone';
import api from '../../api';

export default {
    name: "MainOptionComponent",
    props:[
        'data', 'data_methods', 'data_reviews_ru', 'data_reviews_en', 'all_page', 'socials', 'menu_top', 'menu_info', 'menu_main_bottom'
    ],
    data() {
        return {
            logo_image : [this.data === null ? [] : this.data] ,
            methods_image : [this.data_methods === null ? [] : this.data_methods] ,
            reviews_ru_image : [] ,
            reviews_en_image : [],
            reviews_ru : [this.data_reviews_ru === null || this.data_reviews_ru === undefined ?  [{"text":"","name": ""}] : this.data_reviews_ru] ,
            reviews_en : [this.data_reviews_en === null || this.data_reviews_en === undefined ? [{"text":"", "name": ""}] : this.data_reviews_en] ,
            menu_top_data: this.menu_top === null || this.menu_top === undefined ? [{"name":"", "slug": ""}] : this.menu_top,
            menu_info_data: this.menu_info === null || this.menu_info === undefined ? [{"name":"", "slug": ""}] : this.menu_info,
            menu_main_bottom_data: this.menu_main_bottom === null || this.menu_main_bottom === undefined ? [{"name":"", "slug": ""}] : this.menu_main_bottom,
            socials_data: this.socials === null || this.socials === undefined ? [{"name":"", "link": "","podpis":"","image":{} }] : this.socials
        }
    },
    mounted() {

           console.log(this.menu_top);
            // add image
            this.logo_image = new Dropzone(this.$refs.logo_image, {
                    url:'/api/auth/admin/main-option',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить',
                    maxFiles:1
                })
                 
                this.methods_image = new Dropzone(this.$refs.methods_image, {
                    url:'/api/auth/admin/main-option',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить',
                    
                })

                this.reviews_ru_image = new Dropzone(this.$refs.reviews_ru_image, {
                    url:'/api/auth/admin/main-option',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить',
                    
                })

                this.reviews_en_image = new Dropzone(this.$refs.reviews_en_image, {
                    url:'/api/auth/admin/main-option',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить',
                    
                })
             // end image add

              // preview image  

                    if(this.data){
                    if(this.data.image){
                       
                        let file = { name: this.data.image.name, size: this.data.image.size };
                        this.logo_image.files.push({'name': this.data.image.name,'path':this.data.image.path, 'url' : this.data.image.url});      
                        this.logo_image.displayExistingFile(file, this.data.image.url,null,null,false)
                      
                      }
                    }
                    if(this.data_methods){
                      if(this.data_methods.image){
                       
                       let file = { name: this.data_methods.image.name, size: this.data_methods.image.size };
                       this.methods_image.files.push({'name': this.data_methods.image.name,'path':this.data_methods.image.path, 'url' : this.data_methods.image.url});        
                       this.methods_image.displayExistingFile(file, this.data_methods.image.url,null,null,false)
                         
                    }
                    }

                    
                    if(this.reviews_ru[0]){
                       this.reviews_ru[0].forEach(element => {

                            let file = { name: element.image.name, size: element.image.size };             
                            this.reviews_ru_image.files.push({'name': element.image.name,'path':element.image.path, 'url' : element.image.url});        
                            this.reviews_ru_image.displayExistingFile(file, element.image.url,null,null,false)
                       });
                        
                         
                    }

                    if(this.reviews_en[0]){
                        this.reviews_en[0].forEach(element => {
                            let file = { name: element.image.name, size: element.image.size };
                            this.reviews_en_image.files.push({'name': element.image.name,'path':element.image.path, 'url' : element.image.url});          
                            this.reviews_en_image.displayExistingFile(file, element.image.url,null,null,false)
                        });
                    }
                   
                   
            // End preview images

 
            let thisdataImage = this.logo_image;
            let thisMethodsImage = this.methods_image;
            let thisReviewsRuImg = this.reviews_ru_image;
            let thisReviewsEnImg = this.reviews_en_image;



              // REMOVE IMAGES 
            
              if(this.logo_image.files.length>0 ){
                    this.logo_image.on('removedfile',(file)=>{                 
                        thisdataImage.files = thisdataImage.files.filter((el) => el.name !== file.name);     
                        
                    })
                }

                 
                if(this.methods_image.files.length>0 ){
                   
                    this.methods_image.on('removedfile',(file)=>{                 
                    thisMethodsImage.files = thisMethodsImage.files.filter((el) => el.name !== file.name);
                    
                    })
                }


                if(this.reviews_en_image.files.length>0 ){
                   
                   this.reviews_en_image.on('removedfile',(file)=>{           
                        
                    thisReviewsEnImg.files = thisReviewsEnImg.files.filter((el) => el.name !== file.name);
                   
                   })
                }


                   if(this.reviews_ru_image.files.length>0 ){
                     
                   this.reviews_ru_image.on('removedfile',(file, index)=>{       

                    thisReviewsRuImg.files = thisReviewsRuImg.files.filter((el) => el.name !== file.name);
                   
                   })
               }
                // END REMOVE         

                 
                $('#reviews_ru_image').sortable({
                    stop: function () { 
                         
                        var queue = thisReviewsRuImg.files; 
                         
                        var newQueue = []; 
                        $('#reviews_ru_image .dz-preview .dz-filename [data-dz-name]').each(function (count, el) { 
                            var name = el.innerHTML; 
                            queue.forEach(function (file) { 
                                if (file.name === name) { 
                                    newQueue.push(file); 
                                } 
                            }); 
                        }); 
                        thisReviewsRuImg.files = newQueue; 
                       
                    }
                    
                 });
               
    },
    methods: {

        fileSelected(e,data, index){
                console.log(e.target.files);
                const file = e.target.files[0];
                data[index].image.url = URL.createObjectURL(file);
                data[index].image.file = file;
        },
        addViewsRu(){

            this.reviews_ru[0].push({  
                    text: '', 
                    name:'',
                    image:{}
                });
         
        },

        

        addViewsEn(){

            this.reviews_en[0].push({  
                    text: '', 
                    name:'',
                    image:{}
                });

            },


            addMenu(data){

                data.push({  
                    name: '', 
                    slug:''
                });

            },

            addSocials(data){

                data.push({  
                    name: '', 
                    link:'',
                    podpis:'',
                    image:{},
                });

            },

        removeMenu(data,index){
            data.splice(index, 1);   
        },
        removeReviewsRu(thisindex){
        
        this.reviews_ru[0].splice(thisindex, 1);   
        console.log(this.reviews_ru[0]);
                   
        },

        removeReviewsEn(thisindex){
        
        this.reviews_en[0].splice(thisindex, 1);   
                   
        },
        storeContent(){
 
            // logo add
             const data = new FormData();
             let files
             if(this.logo_image.files.length == 0){
                data.append('logo_image[]', '') 
            }else{
                files = this.logo_image.getAcceptedFiles();
                files.forEach((file,index) => {             
                 console.log(file);
                 data.append('logo_image[]', file) 
                  
             });
            }
             
             // end logo add


             // methods add
            if(this.methods_image.files.length == 0){
                data.append('methods_image[]', '') 
            }else{
             let files_mehods
             files_mehods = this.methods_image.getAcceptedFiles();           
             files_mehods.forEach((file,index) => {
               
                 data.append('methods_image[]', file) 
                  
             });
            }
             // end methods add



             // add reviews ru

              
             if(this.reviews_ru_image.files){

                // Add data to sorting, for the total number of all images  
                // and saving existing images
                let reviews_ru_sort, reviews_ru_name;   
                this.reviews_ru_image.files.forEach((element,index) => {
                    if(element instanceof File != true){
                        reviews_ru_sort = index
                        reviews_ru_name = element.name
                        data.append(`reviews_ru_imageshas[${index}][name]`, element.name) 
                        data.append(`reviews_ru_imageshas[${index}][path]`, element.path) 
                        data.append(`reviews_ru_imageshas[${index}][url]`, element.url)                                           
                    }else{
                        reviews_ru_sort = index
                        reviews_ru_name = element.upload.filename  
                    }                     
                      data.append(`reviews_ru_sort[${index}][name]`, reviews_ru_name) 
                      data.append(`reviews_ru_sort[${index}][sort]`, reviews_ru_sort) 
                      
                });
            }
 
             let files_reviews_ru
             files_reviews_ru = this.reviews_ru_image.getAcceptedFiles();           
             files_reviews_ru.forEach((file,index) => {
               
                 data.append('reviews_ru_images[]', file) 
                  
             });

            
             this.reviews_ru[0].forEach((element,index) => {

                        data.append('reviews_ru_content[]', element.text)
                        data.append('reviews_ru_name[]', element.name)
                    
            });

             // end reviews ru



             // add reviews en
             if(this.reviews_en_image.files){

                // Add data to sorting, for the total number of all images  
                // and saving existing images
                let reviews_en_sort, reviews_en_name;   
                this.reviews_en_image.files.forEach((element,index) => {
                    if(element instanceof File != true){
                        reviews_en_sort = index
                        reviews_en_name = element.name
                        data.append(`reviews_en_imageshas[${index}][name]`, element.name) 
                        data.append(`reviews_en_imageshas[${index}][path]`, element.path) 
                        data.append(`reviews_en_imageshas[${index}][url]`, element.url)                                           
                    }else{
                        reviews_en_sort = index
                        reviews_en_name = element.upload.filename  
                    }                     
                      data.append(`reviews_en_sort[${index}][name]`, reviews_en_name) 
                      data.append(`reviews_en_sort[${index}][sort]`, reviews_en_sort) 
                      
                });
            }
 
             let files_reviews_en
             files_reviews_en = this.reviews_en_image.getAcceptedFiles();           
             files_reviews_en.forEach((file,index) => {
               
                 data.append('reviews_en_images[]', file) 
                  
             });


             this.reviews_en[0].forEach((element,index) => {
                    
                        data.append('reviews_en_content[]', element.text)
                        data.append('reviews_en_name[]', element.name)
                    
            });

             // end reviews en


            // SOCIALS DATA

            this.socials_data.forEach((element,index) =>{
                console.log(element);
                data.append('socials_name[]', element.name)  
                data.append('socials_link[]', element.link)  
                data.append('socials_podpis[]', element.podpis)  
                if(element.image.file){
                    data.append('socials_image[]', element.image.file)  
                }else{
                    data.append('socials_imageName[]', element.image.name)
                    data.append('socials_imagePath[]', element.image.path)       
                    data.append('socials_imageUrl[]', element.image.url)       
                    data.append('socials_imageSize[]', element.image.size)       
                }
                 
            })

            // END SOCIALS


            // add MENU_TOP

            this.menu_top_data.forEach((element,index) =>{
                console.log(element);
                data.append('menu_top_name[]', element.name)  
                data.append('menu_top_slug[]', element.slug)  
            })

            // End MENU_TOP


             // add MENU_INFO

             this.menu_info_data.forEach((element,index) =>{
                
                data.append('menu_info_name[]', element.name)  
                data.append('menu_info_slug[]', element.slug)  
            })

            // End MENU_INFO

              // add MENU_MAIN_BOTTOM

              this.menu_main_bottom_data.forEach((element,index) =>{
                
                data.append('menu_main_bottom_name[]', element.name)  
                data.append('menu_main_bottom_slug[]', element.slug)  
            })

            // End MENU_MAIN_BOTTOM

             api.post('/api/auth/admin/main-option', data)
         },



         MoveTop(data,index){
            if(index != 0){
            [data[index-1], data[index]] = [data[index], data[index-1]];
            }
         },
         MoveBottom(data,index){
            if(index != data.length-1){
            [data[index], data[index+1]] = [data[index+1], data[index]];
            }
         }
    },
}
</script>
<style lang="">
    
</style>
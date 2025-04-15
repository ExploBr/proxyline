<template lang="">
    <div>
        <div class="from-group" >
            <h3 class="d-block">Логотип</h3>
            <div>
                <div ref="logo_image" id="logo_image"  class="from-group w-50 bg-dark p-5 text-center adv_images admin-images">
                        
                </div>
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
        'data'
    ],
    data() {
        return {
            logo_image : [this.data === null ? [] : this.data] ,
        }
    },
    mounted() {
        console.log(this.logo_image[0].image);
         
                     

            this.logo_image = new Dropzone(this.$refs.logo_image, {
                    url:'/api/auth/admin/main-option',
                    autoProcessQueue: false,
                    addRemoveLinks:true,      
                    dictRemoveFile:'Удалить',
                    maxFiles:1
                })
                 
                
                if(this.data.image){
                       
                    let file = { name: this.data.image.name, size: this.data.image.size };
                    console.log(this.data.image.url);         
                    this.logo_image.displayExistingFile(file, this.data.image.url,null,null,false)
                      
                      }
 
                 
    },
    methods: {
        storeContent(){
             
             const logoimg = new FormData();
             let files
 
             files = this.logo_image.getAcceptedFiles();
             console.log(this.logo_image);
             files.forEach((file,index) => {
                 
                 console.log(file);
                 logoimg.append('logo_image[]', file) 
                  
             });
  

             api.post('/api/auth/admin/main-option', logoimg)
         },
    },
}
</script>
<style lang="">
    
</style>
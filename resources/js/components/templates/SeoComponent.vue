<template lang="">
    <div>
        <div v-if="seo.length > 0"> 
        <template v-for="(item, index) in seo" :key="index">
            <div class="from-group"   v-if="item.lang == newlang">

                
                <div class="from-group mt-25" v-if="item.name == 'seo_noindex'">  
                        <label for="">{{ getTitle(item.name) }}</label>
                        <input  class="form-control"
                        value="index, follow" v-model="item.content"
                        type="text"   id="seo_noindex">
                         
                            
                </div>
                <div class="from-group mt-25" v-else-if="item.name == 'seo_description' || item.name == 'seo_og_description'">
                        <label for="">{{ getTitle(item.name) }}</label>

                        <textarea class="form-control"
                        value="" v-model="item.content"
                        type="text"   id="seo_description" rows="5"></textarea>
 
                            
                </div>
                <div class="from-group mt-25" v-else>
                        <label for="">{{ getTitle(item.name) }}</label>

                        <input class="form-control"
                        value="" v-model="item.content"
                        type="text"   id="">
                            
                </div>
 

            </div>
        </template>
        </div>
       
    </div>
</template>
<script>
export default {
    name: "SeoComponent",
    data() {
        return {
            checked:false,
            attrs:[
                {'name':'seo_title'},
                {'name':'seo_description'},
                {'name':'seo_noindex'},
                {'name':'seo_og_title'},
                {'name':'seo_og_image'},
                {'name':'seo_og_type'},
                {'name':'seo_og_description'},
                ]
        }
    },
    props:['seo', 'newlang'],
    mounted() {
         
        if(this.seo.length == 0){
            this.attrs.forEach(element => {
                this.seo.push({'name':element.name, 'content':'','lang': this.newlang})
            });
        }
        
        var allseoname = [];
        this.seo.forEach(element => {
            allseoname.push(element.name)
        });
        
        if(this.seo.length < 7){
            this.attrs.forEach((element,index) => {
                console.log(element.name);
                if(allseoname.includes(element.name) == false){
                    if(this.seo[index] == null || element.name != this.seo[index].name){
                    this.seo.push({'name':element.name, 'content':'','lang': this.newlang})
                    }
                }
                 
            })
             
        }
        
      
    },
    methods: {
        getTitle(name){
            if (name == 'seo_title'){
                return 'Сео title'
            }
            if (name == 'seo_description'){
                return 'Сео description'
            }
            if (name == 'seo_noindex'){
                return 'Сео noindex'
            }
            if (name == 'seo_og_title'){
                return 'Сео OG title'
            }
            if (name == 'seo_og_image'){
                return 'Сео OG img url'
            }
            if (name == 'seo_og_type'){
                return 'Сео OG type'
            }
            if (name == 'seo_og_description'){
                return 'Сео OG description'
            }

            return name
        },
    

    },
    computed:{
     
 
       
    }
    
}
</script>
<style lang="">
    
</style>
<template lang="">

    <CreatePageComponent></CreatePageComponent>
   <!-- <div>
        ssas
        <button @click="say">Name</button>
         

        <div v-for="person in persons">
            <div>Name: {{person.name}}</div>
            <div>age: {{person.age}}</div>
        </div>
    </div>-->
    
</template>
<script>
import axios from 'axios';
import CreatePageComponent from './CreatePageComponent.vue';
 
export default {
        name: 'PageComponent',
        data() {
            return {
                name:'art',
               
                persons:null
            }
        },
        mounted(){
            
        },
        methods: {
          
        },
        components:{
            CreatePageComponent,
          
        }
       
}
</script>
<style lang="">
    
</style>
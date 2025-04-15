<template lang="">
    <div>
        
    </div>
</template>
<script>
export default {
    name: 'AdminMainComponent',

    props:[
         'user' 
        ],
    mounted(){
        
         this.login();
    },
    methods: {
        login(){
            if(this.user){
            localStorage.setItem('access_token', this.user[0].original.access_token)
            console.log(localStorage.getItem('access_token'))
            }
            if(localStorage.getItem('access_token')){
                //location.href = '/admin'
            }
                     
                 
            }
        }


}
</script>
<style lang="">
    
</style>
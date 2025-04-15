<template lang="">
    <div>
            <div class="form-group">
                <label for="title">Email</label>
                <input class="form-control"
                v-model="email"  
                type="text" id="email">
                
            </div>

            <div class="form-group">
                <label for="title">Password</label>
                <input class="form-control"
                v-model="password"  
                type="text" id="password">
                
            </div>


            <button type="submit" class="btn btn-primary " @click.prevent="login">Войти</button>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name:"LoginComponent",

    data() {
        return {
            email:null,
            password:null,
        }
    },
    methods: {
        login(){
            axios.post('/api/auth/login', {email: this.email, password: this.password}).then((result) => {
                console.log(result);

                localStorage.setItem('access_token', result.data.access_token)

                //if(localStorage.getItem('access_token')){
                // location.href = '/admin'
                //}
            }).catch((err) => {
                
            });
        }
        
    },
}
</script>
<style lang="">
    
</style>
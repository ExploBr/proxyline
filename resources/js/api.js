import axios from "axios";

const api = axios.create();

// start request
api.interceptors.request.use(config=>{

    if(localStorage.getItem('access_token')){
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
         
    }
    return config
},
error => {

}

)
// end request

api.interceptors.response.use(config=>{
    document.querySelector('.succes').classList.add('show');
    setTimeout(() => {
        document.body.querySelector('.succes').classList.remove('show');
    }, 1200);
    return config
},
error => {
    console.log(error.response);
    if(error.response.status === 500){
        alert('Ошибка ' + error.response.data.message + ' in ' + error.response.data.file);
   }
    if(error.response.status === 401){
         location.href = '/logout'
    }
})

export default api 
<template lang="">
<div>
    <div class="form-group col-3">
        <label for="title">Язык</label>
        <select class="form-control" v-model="lang" @change="langChange">
            <option value="all">Для всех</option>
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
    <div class="d-flex g-10 mb-25 mt-25">
        <label>Поиск (по коду)</label>
        <input type="text" v-model="countrySearch">
    </div>
    <template v-for="(item, index) in countries" :key="index">
        <div v-if="lang == item.lang">

            <template v-for="(item, index) in item.country" :key="index">
                
                <div class="d-flex g-10 form-group" v-show="item.show">
                    <div class="w-20">
                        <label class="mb-25">Код страны</label>
                        <input class="form-control" value="" v-model="item.code" type="text" id="class">
                    </div>
                    <div class="w-70">
                        <label class="mb-25">Контент</label>
                        <textarea v-model="item.content" :id="'summernote'+index" ref="zagolovok">

                            </textarea>
                    </div>

                    <button style="height:40px;margin-top:50px" type="submit" class="btn btn-primary " @click.prevent="removeCountry(index)">X</button>
                </div>
            </template>
            <button type="submit" class="btn btn-primary " @click.prevent="addCountry">Добавить</button>
        </div>
    </template>
    <button type="submit" class="btn btn-primary " @click.prevent="addData">Обновить</button>
     
</div>
</template>

<script>
import api from '../api';

export default {
    name: "CountruComponent",
    props: [
        'countries_data'
    ],
    data() {
        return {
            countries: this.countries_data === null || this.countries_data === undefined ? [{
                'country': [{
                    'code': '',
                    'content': ''
                }],
                'lang': 'ru'
            }] : this.countries_data,
            lang: 'ru',
            countrySearch:''
        }
    },

    mounted() {
        console.log(this.countries[0].countries);
        this.langChange()

        this.$watch('countrySearch', ()=>{
                this.searchCountry();
            });
    },
    methods: {

        addData(){
            this.countries.forEach((element, index) => {
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){

                    api.post('/api/auth/admin/country', {
                    countries:element
                        })
                        .then(res => {
                            console.log(res);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            })
             
        },
        textEditor(){
            let $vm = this;
            this.$nextTick(function () {
                this.countries.forEach((element, index) => {
                    if (element.lang == this.lang) {
                        if (element.country.lenght != 0) {
                            element.country.forEach((element2, index) => {
                                element2.show = true
                                if ($(`#summernote${index}`)) {
                                    $(`#summernote${index}`).summernote({
                                        height: 200,

                                        callbacks: {
                                            onChange: function (contents) {
                                                element2.content = contents; // сохраняем новые данные              
                                            },
                                            onKeydown: function (e) {
                                                e.stopPropagation();
                                            }

                                        },
                                    });
                                }
                            })
                        }

                    }
                })

            })
        },
        langChange() {
            let LangData = [];
            this.countries.forEach((element, index) => {
                LangData.push(element.lang)
            })

            if (LangData.includes(this.lang) == false && this.lang != 'all') {
                this.countries.push({
                    'country': [{
                        'code': '',
                        'content': ''
                    }],
                    'lang': this.lang
                })

            }
            this.textEditor()
        
        },
        addCountry(){
            this.countries.forEach((element,index) => {
               element.country.push({
                        'code': '',
                        'content': ''               
                    })
            })
            this.textEditor()
        },
        removeCountry(thisindex){

                this.countries.forEach((element,index) => {
                    if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){
                        element.country.splice(thisindex, 1);
                    }       
               })           
       
        },

        searchCountry(){

            this.countries.forEach((element,index) => {
                if(element.lang == this.lang || (this.lang == 'all' && element.lang == 'ru')){

                    for (const property in element.country) {
                        if (
                            element.country[property]['code'].toLowerCase().includes(this.countrySearch.toLowerCase())
                        ) {
                            element.country[property].show = true;
                            
                        }
                        else {
                            element.country[property].show = false;
                        }
                    }
                }
            })
            console.log(this.countries);
        },
    },
}
</script>   

<style lang="">

</style>

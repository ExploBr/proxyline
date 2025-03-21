<template lang="">
    <div class="card-body p-0">      
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th style="width: 20%">
                                    Название
                                </th>
                                <th>
                                    Контент
                                </th>
                                 
                                <th style="width: 8%" class="text-center">
                                    Статус
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                       

                           
                            <tr>
                                <td> </td>
                                <td> </td>
                               
                                <td> </td>
                                <td class="project-state">
                                    <span class="badge badge-success"> </span>
                                </td>
                                <td class="project-actions text-right" style="width: 30%">
                                    <a class="btn btn-info btn-sm" href=" ">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                        Удалить
                                    </a>
                                </td>
                            </tr>

                       
                        </tbody>     
                    </table>
                     
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'PageIndexComponent',

    data() {
        return { 
            
        }
    },
    mounted(){
        this.getAllPages();
    },

    methods: {
        getAllPages(){
            axios.get('/api/admin/page')
            .then(res=>{
                console.log(res);
            })
        }
    },
}
</script>
<style lang="">
    
</style>
@extends('layouts.admin')

@section('breadcrumbs')
 
@endsection
@section('content')


<section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="g-10"> 
                        <h3 class="card-title">
                            Инструкции
                        </h3>
                        <div>
                            <div class="input-group" data-widget="sidebar-page">
                                <form method="GET" class="input-group"> 
                                 
                                    <input class="form-control form-control-sidebar" value="{{ isset($_GET['search']) ? $_GET['search'] : ''}}" name="search" type="search" placeholder="Поиск" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar" type="submit">
                                        <i class="fas fa-search fa-fw"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-tools">
                        <a href="{{route('admin.post.create')}}" class="btn btn-sm btn-primary">Добавить</a>
                    </div>
                     
                </div>
                 
               <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                
                                <th style="width: 20%">
                                    Название
                                </th>
                                <th>
                                    slug
                                </th>
                                 
                                <th style="width: 8%" class="text-center">
                                    Статус
                                </th>
                                <th style="width: 30%">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($posts as $post)

                           
                            <tr>
                                 
                                <td>{{ $post->title }}</td>
                               
                                <td>{!! $post->slug !!}</td>
                                <td class="project-state">
                                    <span class="badge badge-success">{{ $post->publish == 1 ? "Опубликовано" : "Черновик" }}</span>
                                </td>
                                <td class="project-actions text-right" style="width: 30%">
                                
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.post.edit',$post->slug) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-post{{ $post->id }}">
                                    <i class="fas fa-trash">
                                    </i>
                                     Удалить
                                    </button>
                                    
                                </td>
                            </tr>

                        @endforeach
                        </tbody>     
                    </table>
                    <div class="card-footer">
                        {{ $posts->withQueryString()->onEachSide(1)->links('pagination::custompagination') }}
                    </div>
                </div>  
            </div>

        </section>
        <div class="modals">
            @foreach ($posts as $post)
            <div class="modal fade" id="modal-post{{ $post->id }}" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Удаление</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <h3>Удалить страницу {{ $post->title }} ?</h3>
                    <p>Все данные связанные с этой страницей будут удалены</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <form action="{{ route('admin.post.delete',$post->slug) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary" type="submit">Удалить</button>
                    </form>
                     
                    </div>
                </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
             
             
            </div>
         @endforeach
        </div>    

        

@endsection
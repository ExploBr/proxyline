@extends('layouts.admin')

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.page') }}
@endsection
@section('content')


<section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Страницы
                    </h3>
                    <div class="card-tools">
                        <a href="{{route('admin.page.create')}}" class="btn btn-sm btn-primary">Добавить</a>
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
                        @foreach ($pages as $page)

                           
                            <tr>
                                 
                                <td>{{ $page->title }}</td>
                               
                                <td>{!! $page->slug !!}</td>
                                <td class="project-state">
                                    <span class="badge badge-success">{{ $page->publish == 1 ? "Опубликовано" : "Черновик" }}</span>
                                </td>
                                <td class="project-actions text-right" style="width: 30%">
                                
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.page.edit',$page->slug) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-page{{ $page->id }}">
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
                        {{ $pages->withQueryString()->onEachSide(1)->links('pagination::custompagination') }}
                    </div>
                </div>  
            </div>

        </section>
        <div class="modals">
            @foreach ($pages as $page)
            <div class="modal fade" id="modal-page{{ $page->id }}" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Удаление</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <h3>Удалить страницу {{ $page->title }} ?</h3>
                    <p>Все данные связанные с этой страницей будут удалены</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <form action="{{ route('admin.page.delete',$page->slug) }}" method="POST">
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
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
                <div id="app"> 
              
                </div>
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
                                <td>{{ $page->page_id }}</td>
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
                                    <a class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                        Удалить
                                    </a>
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
         

        

@endsection
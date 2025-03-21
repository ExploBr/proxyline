@extends('layouts.admin')

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.page.edit' , $page) }}
@endsection
@section('content')


<div class="margin-top">
    <form action="{{route('admin.page.update',$page->slug)}}" method="POST">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="title">Имя</label>
            <input class="form-control"
            value="{{$page->title}}"
            type="text" name="title" id="title">
            @error('title')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group  ">
            <label for="title">Url | Slug</label>
            <input class="form-control"
            value="{{$page->slug}}"
            type="text" name="slug" id="slug">
            @error('slug')
            <p>{{ $message }}</p>
            @enderror
        </div>
 
        <div class="form-group">
            <label for="summernote">Контент</label>

            <div class="card card-outline card-info">
                <!-- /.card-header -->
                <div class="card-body">
                <textarea  name="content" id="summernote">
                        {{$page->content}}
                </textarea>
                </div>
            </div>
            @error('content')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <h2>Метаданные</h2>
        </div>
        @if (isset($page->template))
            @include('admin.page.templates.'.$page->template.'.edit')
        @endif

        <div class="form-group">
        
                <div class="icheck-primary d-inline">
                        <input type="checkbox" id="publish" name="publish" checked="{{ $page->publish == 1 ? 'checked' : '' }}">
                        <label for="publish">
                        Опубликовано
                        </label>
                </div>
 
                 
  
        </div>

 
        <button type="submit" class="btn btn-primary ">Обновить</button>
    </form>
</div> 



@endsection
@extends('layouts.admin')

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.page.edit' , $firstPage) }}
@endsection
@section('content')


<div class="margin-top" id="app">
    <!-- #endregion -->
     
    <update-page-component
        :data = '@json($page)'
        :datameta = '@json($page_metas)'
    ></update-page-component>
  
</div> 



@endsection
@extends('layouts.admin')

 
@section('content')


<div class="margin-top" id="app">
    <!-- #endregion -->
     
    <update-post-component
        :data = '@json($post)'
        :dataseo = '@json($post_seo)'
    ></update-post-component>
  
</div> 



@endsection
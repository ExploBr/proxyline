@extends('layouts.admin')

 
@section('content')


<div class="margin-top" id="app">
    
    <main-option-component 
    :data = '@json($data)'
    :data_methods = '@json($data_methods)'
    :data_reviews_ru = '@json($data_reviews_ru)'
    :data_reviews_en = '@json($data_reviews_en)'
    :all_page = '@json($all_page)'
    :socials = '@json($socials)'
    :menu_top = '@json($menu_top)'
    :menu_info = '@json($menu_info)'
    :menu_main_bottom = '@json($menu_main_bottom)'
    :menu_main_country = '@json($menu_main_country)'
    :menu_main_podmenu = '@json($menu_main_podmenu)'
    ></main-option-component>
    
     
         
</div> 



@endsection
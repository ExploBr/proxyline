@extends('layouts.admin')

 
@section('content')


<div class="margin-top" id="app">
    
    <catalog-component 
    :all_page = '@json($all_page)'
    :catalog = '@json($catalog)'
    
    ></catalog-component>
    
     
         
</div> 



@endsection
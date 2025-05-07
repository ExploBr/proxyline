@extends('layouts.admin')

 
@section('content')


<div class="margin-top" id="app">
    
    <country-component 
     
    :countries_data = '@json($newCountry)'
    
    ></country-component>
    
     
         
</div> 



@endsection
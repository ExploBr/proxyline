@extends('layouts.admin')

 
@section('content')


<div class="margin-top" id="app">
    
    <main-content-component 
    :data_adv = '@json($data_advContent)'
    :data_whereuse = '@json($data_whereuse)'
    :data_seo = '@json($data_seo)'
    :data_affilate = '@json($data_affilate)'
    :data_calculator = '@json($data_calculator)'
    >
    </main-content-component>
    
     
         
</div> 



@endsection
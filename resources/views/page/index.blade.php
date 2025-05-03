@extends('layouts.main')
 
@section('content')
 
@if($page->template == 'ipv')
 
<div class="main__banner">
    <div class="inner__banner container"> 
        <div class="breadcrumbs container white__bread">
        
        {{ Breadcrumbs::view('layouts.breadcrumb.pagecrumb', 'page.show' , $page) }}
            
        </div>
        <div class="inner__title">
            @foreach ($page_metas as $item)
                @if ($item->name == 'ipv_content_top')
                <div class="inner__title--img">{!! $item->content !!}</div>
                @endif
            @endforeach
            <h1>{{ $page->title }}</h1>
        </div>
         
          <div class="inner__banner--content">{!! $page->content !!} </div> 
    </div>
</div>
@else
<div class="breadcrumbs container">
    
{{ Breadcrumbs::view('layouts.breadcrumb.pagecrumb', 'page.show' , $page) }}
    
</div>
@endif


<div class="inner__content">

    @if (View::exists('page.templates.'.$page->template.''))
    @include('page.templates.'.$page->template.'')
    @else

    @endif
</div>
 
@endsection


 
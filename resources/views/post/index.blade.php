@extends('layouts.main')

@section('content')

<div class="breadcrumbs container">
    
{{ Breadcrumbs::view('layouts.breadcrumb.pagecrumb', 'post.show' , $page) }}
    
</div>
<div class="instruction__single txtpage container about__page">
    <div class="top__title">
        <h1>{!! $page->title !!}</h1>
    </div>
    @if (isset($page->created))
        <p>{{ $page->created }}</p>
    @else
        <p>{{ $page->created_at }}</p>
    @endif

    <div class="instruction__single--content">
        <div class="instruction__single--img">
         {!! $page->preview !!}
        </div>
         <div>
            {!! $page->content !!}
         </div>
    </div>


     

</div>

@include('includes.templates.affilate')
@endsection


 
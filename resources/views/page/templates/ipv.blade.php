@include('includes.templates.advantages')
@include('includes.templates.calculator')

<div class="inner__content--main container">

@foreach ($page_metas as $item)
        @if ($item->name == 'ipv_content_bottom')
            {!! $item->content !!}
        @endif
@endforeach
    
</div>

@include('includes.templates.reviews')
@include('includes.templates.affilate')
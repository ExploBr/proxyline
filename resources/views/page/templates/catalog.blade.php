 
@include('includes.templates.calculator')

<div class="txtpage catalog__page container">

    

    <div class="catalog__wrapper">
        @foreach ($catalogpages  as $catalog)
            <div class="catalog__item">
                <a href="{{ route('page.show',$catalog['slug'] ) }}">{{ $catalog['name'] }}</a>
                <div class="child__catalog">
                    @foreach ($catalog['links'] as $items)
                    <div> 
                    {!! $items['img'] !!}
                    <a href="{{ route('page.show',$items['slug'] )}}">{{ $items['title'] }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>


   
</div>
 @include('includes.templates.affilate')
 
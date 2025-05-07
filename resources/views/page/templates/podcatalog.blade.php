 
 

<div class="txtpage catalog__page container about__page">

<div class="top__title">

                <h1>{!! $page->title !!}</h1>

    </div>

    <div class="podcatalog__wrapper">
        
        @foreach ($catalogpages  as $catalog)
 
                <div class="child__catalog">
                    @foreach ($catalog['links'] as $items)
                    <div> 
                    {!! $items['img'] !!}
                    <a href="{{ route('page.show',$items['slug'] )}}">{{ $items['title'] }}</a>
                    </div>
                    @endforeach
                </div>
 
        @endforeach
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>


   
</div>
 @include('includes.templates.affilate')
 
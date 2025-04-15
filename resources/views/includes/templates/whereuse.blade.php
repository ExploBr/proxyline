@if (isset($whereuse))
<div class="whereuse container"> 
        <div class="top__title whereuse__top">
            <img src="{{ asset('storage/images/whereuse/where-hover.svg') }}" alt="">
            <h3>{{ __('Where to use proxies?') }}</h3>
        </div>
        <div class="whereuse__wrapper">
            <div class="whereuse__content">{!! $whereuse->content !!}</div>
            <div class="whereuse__img">
                
                @if(isset($whereuse->image))
                <img  src="{{ asset('storage/'.$whereuse->image->path.'') }}" alt="">
                
                @endif
            </div>
             
        </div> 
</div>
@endif
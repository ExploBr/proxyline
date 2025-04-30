<div class="txtpage container speed__page">
<div class="top__title">
     
            @if (count($page_metas) == 0)
                <h1>{!! $page->title !!}</h1>
            @else
            @foreach ($page_metas as $item)
                @if ($item->name == 'zagolovok')
                    {!! $item->content !!}
                @endif
                @break
            @endforeach
            @endif
 
    </div>
     <div class="black__list checkipv6">
            <div  div class="check">
                <input type="text" class="js-ip js-url" placeholder="http(s)://">
                <button class="js-ipv6-support-check"><span>{{ __('Start checking') }}</span></button>

            </div>

            <div class="">
                <div class="js-ip6-support">
                    <div class="js-ip6-support-yes" style="display: none">{{ __('Congratulations, the site supports IPv6') }}</div>
                    
                    <div class="js-ip6-support-no" style="display: none">{{ __('The site does not support IPv6') }}</div>
                </div>
            </div>
         
     </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>
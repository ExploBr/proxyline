<div class="opt_page container">
    <div class="top__title"> 
        <img src="{{ asset('storage/images/opt_top.svg') }}" alt="">
        <h1>{!! $page->title !!}</h1> 
    </div>

    <div class="opt__wrapper">
        <div class="opt__wrapper--left">
            <div class="opt__wrapper--content">
                {!! $page->content !!}
            </div>
            <div>
                <div class="contact__ul footer__links">
                    <ul class="contacts"> 
                        @foreach ($socials as $item)
                        
                        <li>
                            <a href="{{ $item->link }}">
                                <img src="{{ asset('storage/'. $item->image->path ) }}" alt="">
                                <span class="footer__link--content">
                                    <span class="boldname">{{ $item->name }}</span>
                                    <span>{!! $item->podpis !!}</span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="opt__wrapper--right">
            <div class="image_wrap7 ani7">
                    <img src="{{ asset('storage/images/opt_main.svg') }}" alt="">
            </div>
        </div>  
        

    </div>
    <div class="opt__count">
            @foreach ($page_metas as $item)
                    @if ($item->name == 'opt_kolvo')
                    @php
                        $count = mb_substr( trim(strip_tags($item->content)) , -4);
                        $usd_count = number_format((floatval($count) * $course_usd), 2, '.', '');
                        
                    @endphp
                       @if(app()->getLocale() == 'ru')
                        {!! str_replace($count, ' '.$count.'$ (≈' . $usd_count . ' руб.)', $item->content) !!} 
                       @else
                        {!! str_replace($count, ''.$count.'$', $item->content) !!} 
                       @endif
                    @endif
            @endforeach
    </div>
    <div class="opt__content">
            @foreach ($page_metas as $item)
                    @if ($item->name == 'opt_content')
                        {!! $item->content !!}
                    @endif
            @endforeach
    </div>
</div>

@include('includes.templates.affilate')
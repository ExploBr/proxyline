<div class="partner__page container"> 
    <div class="top__title"> 
    @foreach ($page_metas as $item)
            @if ($item->name == 'zagolovok')
                {!! $item->content !!}
            @endif
    @endforeach
    </div>
    <div class="steps__main">
        <div class="steps__wrapper"> 
        @foreach ($page_metas as $item)
                @if ($item->name == 'steps')
                    {!! $item->content !!}
                @endif
        @endforeach
        </div>
        <div class="partner__main--image">
            <div>
                <img src="{{ asset('storage/images/partner-main.svg') }}" alt="">
            </div>
        </div>
    </div>



    <div class="partner__content">
        <div>
            {!! $page->content !!}
        </div>
        <div class="partner__counter">
            <div class="partner__counter--info">
                <span>{{ __('Our partners') }}</span>
                {{ __('already earned') }}
                <div class="counter" id="partner__counter">
                    <partner-component :course_usd = '@json($course_usd)'></partner-component>
                </div>
            </div>
            <div class="image_wrap9 ani9">
                <img src="{{ asset('storage/images/rocket.svg') }}">
            </div>
        </div>
    </div>

    <div class="trafic__wrapper">
        <div class="top__title">
            <img src="{{ asset('storage/images/trafic-top.svg') }}">
            <h3>{{ __('Traffic Types') }}</h3>
        </div>
        <div class="trafic__content">
            @foreach ($page_metas as $item)
                    @if ($item->name == 'trafic')
                        {!! $item->content !!}
                    @endif
            @endforeach
        </div>
    </div>



</div>
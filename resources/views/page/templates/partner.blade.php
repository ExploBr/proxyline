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
                    <partner-component :course_usd='@json($course_usd)'></partner-component>
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

    <div class="block__banners">
        <div class="top__title">
            <img src="{{ asset('storage/images/banners.svg') }}">
            <h3>{{ __('Our banners') }}</h3>
        </div>
        @php
            $c = 0;
            $c1 = 0;
            $classlogo = '';
            $sizes = ['LOGO', '1500x372', '1000x248', '900x100', '728x90', '640x100', '468x60', '336x280', '300x500', '300x250', '250x360', '250x250', '240x400', '200x200', '160x600', '150x150', '120x600', '88x31'];
            $end1 = ['png', 'gif', 'gif', 'jpg', 'png', 'gif', 'png'];
        @endphp
        <div class="row tabs2">
            @foreach ($sizes as $key => $sizesvalue)
                @if($c == 0)
                    <div class="head-tab2 activetab" data-href="#{{ $sizesvalue }}">{{ $sizesvalue }}</div>
                @else
                    <div class="head-tab2 " data-href="#{{ $sizesvalue }}">{{ $sizesvalue }}</div>
                @endif
                @php $c++ @endphp
            @endforeach
        </div>
        @foreach ($sizes as $key => $sizesvalue)
            @php $c1++ @endphp
            <div class="tabcontent2 {{ $c1 == 1 ? 'show' : 'hide' }}">
                @php $endcount = 1 @endphp

                @foreach ($end1 as $end)
                    @if($sizesvalue == '150x150' || $sizesvalue == '250x360')
                        <div class="one-banner-row">
                            <img loading="lazy"
                                src="{{ asset('storage/images/banners/' . app()->getLocale() . '/' . $sizesvalue . '-' . $endcount . '.' . $end) }}"
                                alt="">
                            <div class="one-banner-info">
                                <div class="one-banner-info-inner">
                                    <span
                                        data-text="<a rel='bookmark' href='https://proxyline.net/' target='_blank'><img src='{{ asset('storage/images/banners/' . app()->getLocale() . '/' . $sizesvalue . '-' . $endcount . '.' . $end) }}' alt='banner-{{ $sizesvalue }}'></a>">https://proxyline.net/storage/images/banners/{{ app()->getLocale() . '/' . $sizesvalue . '-' . $endcount . '.' . $end }}</span>
                                </div>
                                <a class="copyit">
                                    {{__('Copy banner code')}}
                                </a>
                            </div>
                        </div>
                        @break
                    @else
                        @if($sizesvalue == '200x200')
                            @php
                                if ($endcount == 5)
                                    $end = 'gif';
                                if ($endcount == 6)
                                    $end = 'png';

                            @endphp
                        @endif

                        @if(
                            ($sizesvalue == '250x250' || $sizesvalue == '300x250' || $sizesvalue == '336x280' ||
                                $sizesvalue == '468x60' || $sizesvalue == '728x90' || $sizesvalue == '900x100')
                        )
                            @php if($endcount==6)$end = 'png'; @endphp
                        @endif

                        @if($sizesvalue == '1000x248' || $sizesvalue == '1500x372')
                            @php
                                $end = 'jpg';
                                if ($endcount == 3)
                                    break;

                            @endphp
                        @endif

                        @if($sizesvalue == 'LOGO')
                            @php
                                $classlogo = 'logo';
                                $end = 'svg';
                                if ($endcount == 2 || $endcount == 4 || $endcount == 5) {
                                    $classlogo = 'logo dark';
                                }
                                if ($endcount == 6)
                                    break;

                            @endphp
                        @else
                            @php $classlogo = '' @endphp
                        @endif

                        <div class="one-banner-row {{ $classlogo }}">
                            <img loading="lazy"
                                src="{{ asset('storage/images/banners/' . app()->getLocale() . '/' . $sizesvalue . '-' . $endcount . '.' . $end) }}"
                                alt="">
                            <div class="one-banner-info">
                                <div class="one-banner-info-inner">
                                    <span
                                        data-text="<a rel='bookmark' href='https://proxyline.net/' target='_blank'><img src='{{ asset('storage/images/banners/' . app()->getLocale() . '/' . $sizesvalue . '-' . $endcount . '.' . $end) }}' alt='banner-{{ $sizesvalue }}'></a>">https://proxyline.net/storage/images/banners/{{ app()->getLocale() . '/' . $sizesvalue . '-' . $endcount . '.' . $end }}</span>
                                </div>
                                <a class="copyit">
                                    {{__('Copy banner code')}}
                                </a>
                            </div>
                        </div>
                        @if(($sizesvalue != '200x200' || $sizesvalue != '240x400' || $sizesvalue != '468x60' || $sizesvalue != '900x100') && $endcount == 6)
                            @break
                        @endif
                        @if(($sizesvalue == '160x600' || $sizesvalue == '640x100') && $endcount == 5)
                            @break
                        @endif
                    @endif

                    @php $endcount++ @endphp
                @endforeach


            </div>
        @endforeach
    </div>
</div>
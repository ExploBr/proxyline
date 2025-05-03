<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (isset($page_seo) && count($page_seo) > 0)
        @foreach ($page_seo as $item)
             
            @if ($item->name == 'seo_title')
                @if(($item->content != '' && $item->content != null))
                    <title>{{ $item->content }}</title>
                    @continue
                 @else 
                    <title>{{ $page->title }}</title>
                    @continue
                @endif
            @endif
 
            @if ($item->name == 'seo_description')
                <meta name="description" content="{{ $item->content }}">
                @continue
            @endif

            @if($item->name == 'seo_noindex')
                @if($item->content != '')
                    <meta name="robots" content="{{ $item->content }}">
                    @continue
                @else
                    <meta name="robots" content="index, follow">
                    @continue
                @endif
            @endif
            
        @endforeach
 
    @else

        <title>{{ $page->title }}</title>
        <meta name="description" content="{{ mb_substr(strip_tags($page->content),0, 150) }}">
        <meta name="robots" content="index, follow">
    @endif

    <meta property="og:site_name" content="proxyline.net">
    <meta property="og:locale" content="{{ app()->getLocale() }}">
    <meta property="og:url" content="{{  url()->full() }}">
     
    @if (isset($page_seo) && count($page_seo) > 0)
        @foreach ($page_seo as $item)
            @if($item->name == 'seo_og_title')
                @if ($item->content != '')
                    <meta property="og:title" content="{{ $item->content }}">
                    @continue
                @else
                    <meta property="og:title" content="{{ $page->title }}">
                    @continue
                @endif
            @endif

            @if($item->name == 'seo_og_image')
                @if($item->content != '')
                    <meta property="og:image" content="{{ $item->content }}">
                    @continue
                @else
                    <meta property="og:image" content="https://proxyline.net/storage/images/logo.svg">
                    @continue
                @endif
            @endif

            @if($item->name == 'seo_og_type')
                @if ($item->content != '')
                    <meta property="og:type" content="{{ $item->content }}">
                    @continue
                @else
                    <meta property="og:type" content="website">
                    @continue
                @endif
            @endif

            @if($item->name == 'seo_og_description')
                @if ($item->content != '')
                    <meta property="og:description" content="{{ $item->content }}">
                    @continue
                @else
                    <meta property="og:description" content="Сервис по аренде Индивидуальных IP адресов для вашего бизнеса">
                    @continue
                @endif
            @endif


        @endforeach

    @else
        <meta property="og:title" content="{{ $page->title }}">
        <meta property="og:image" content="https://proxyline.net/storage/images/logo.svg">
        <meta property="og:type" content="website">
        <meta property="og:description" content="Сервис по аренде Индивидуальных IP адресов для вашего бизнеса">
    @endif
 
    
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/images/favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/images/favicons/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/images/favicons/apple-touch-icon.png') }}">

    @if (isset($page) && isset($page->template) && ($page->template == 'checker' ||
     $page->template == 'speed' || $page->template == 'ports' || 
     $page->template == 'blacklist' || $page->template == 'checkipv6' ||  $page->template == 'freeproxy' ||
      $page->template == 'myip' || $page->template == 'anonymous'))

        @vite(['resources/sass/app.scss', 'resources/sass/response.scss','resources/sass/checkers.scss'])
    @else
        @vite(['resources/sass/app.scss', 'resources/sass/response.scss'])
    @endif
</head>

<body>
    <header>
        <div class="container header__container">

            <div class="site__header">

                <div id="logo" class="header__logo">


                @if (app()->getLocale() == 'ru')
                    @if (isset($page) && $page->template == 'main')
                    <a class="logo rrl current_page_item" href="" style="pointer-events: none;">
                        <img src="{{ asset('storage/images/logo.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                    @else
                    <a class="logo rrl current_page_item" href="/">
                        <img src="{{ asset('storage/images/logo.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                    @endif    
                
                @else
                    @if (isset($page) && $page->template == 'main')
                    <a class="logo rrl current_page_item" href="" style="pointer-events: none;">
                            <img src="{{ asset('storage/images/logo_en.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                    @else
                    <a class="logo rrl current_page_item" href="/{{ app()->getLocale() }}">
                            <img src="{{ asset('storage/images/logo_en.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                        @endif
                @endif

                     

                    <div class="menu__toggle">
                        <span></span>
                    </div>
                </div>
                <div class="main__navigation--wrapper">
                    <div class="main__navigation">
                        <ul>
                        @foreach ($menu_top as $item)
                            <li><a href="{{ route('page.show',$item->slug) }}">{{ __($item->name) }}</a></li>
                        @endforeach
                        </ul>
                    </div>



                    <div class="user-links">

                        <a href="https://panel.proxyline.net/login/" rel="nofollow" class="nbtn" target="_blank">{{ __('Login') }}</a>

                        <a href="https://panel.proxyline.net/register/" rel="nofollow" class="nbtn" target="_blank">{{ __('Registration') }}</a>

                    </div>



                    <ul class="language">

                @foreach (App\Helpers\Langs::LOCALES as $key => $locale)

                @if ($locale == app()->getLocale())
                <li class="ru showed">
                    <a href="" class="current"><img src="{{ asset('storage/images/round_flags/'.$locale.'.svg') }}" alt=""><span>{{ $locale }}</span></a>
                </li>
                <div>
                    <li class="ru active__lang"><a><img src="{{ asset('storage/images/round_flags/'.$locale.'.svg') }}" alt=""><span>{{ App\Helpers\Langs::LOCALESNAME[$key] }}</span> </a></li>

                    @endif

                    @endforeach
                    @foreach (App\Helpers\Langs::LOCALES as $key => $locale)
                    @if ($locale != app()->getLocale())
                    <li class=""><a href="{{ route('setlang', $locale) }}"><img src="{{ asset('storage/images/round_flags/'.$locale.'.svg') }}" alt=""><span>{{ App\Helpers\Langs::LOCALESNAME[$key] }}</span></a></li>
                    @endif
                    @endforeach

                </div>
            </ul>


                </div>
            </div>
            <div class="bottom__navigation">



                <div class="bottom__navigation--wrapper">


                    <a href="/proxy-checker/">
                       <img src="{{ asset('storage/images/header/proxychecker.svg') }}" width="20" height="20" alt="checker">
                           
                        {{ __('Proxy checker') }}</a>

                    <a href="/proverka-skorosti/">
                    <img src="{{ asset('storage/images/header/speedtest.svg') }}" width="20" height="20" alt="checker">

                       {{ __('Speed') }}</a>

                    <a href="/proverit-port/">
                        <img src="{{ asset('storage/images/header/portchecker.svg') }}" width="20" height="20" alt="checker">

                        {{ __('Ports') }}</a>

                    <a href="/ip-moego-servera/">
                        <img src="{{ asset('storage/images/header/myip.svg') }}" width="20" height="20" alt="checker">

                        {{ __('My IP') }}</a>

                    <a href="/proverit-svoju-anonimnost/">
                        <img src="{{ asset('storage/images/header/myip.svg') }}" width="20" height="20" alt="checker">
                        {{ __('anonymity') }}</a>

                    <a href="/proverka-ip-na-chernye-spiski-i-spamnye-bazy/">
                        <img src="{{ asset('storage/images/header/blacklist.svg') }}" width="20" height="20" alt="checker">

                        {{ __('blacklist') }}</a>

                    <a href="/proverka-ipv6-podkljuchenija-onlajn/">
                        <img src="{{ asset('storage/images/header/ipv6.svg') }}" width="20" height="20" alt="checker">
                        IPV6</a>

                    <a href="/api-info/">
                        <img src="{{ asset('storage/images/header/api.svg') }}" width="20" height="20" alt="checker">
                        API</a>
                    <a href="/besplatnye-onlajn-proksi-servera/">
                        <img src="{{ asset('storage/images/header/freeproxy.svg') }}" width="20" height="20" alt="checker">
                        {{ __('Free proxies') }}</a>

                </div>

            </div>


        </div>
    </header>

    @yield('content')

</body>
<footer class="">
    <div class="container">
        <div class="footer__grid"> 
        <div class="footer__menu">
            <div class="footer__img--group"> 

                @if (app()->getLocale() == 'ru')
                    @if (isset($page) && $page->template == 'main')
                    <a class="footer__logo" href="" style="pointer-events: none;">
                        <img src="{{ asset('storage/images/logo.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                    @else
                    <a class="footer__logo" href="/">
                        <img src="{{ asset('storage/images/logo.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                    @endif    
                
                @else
                    @if (isset($page) && $page->template == 'main')
                    <a class="footer__logo" href="" style="pointer-events: none;">
                            <img src="{{ asset('storage/images/logo_en.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                    @else
                    <a class="footer__logo" href="/{{ app()->getLocale() }}">
                            <img src="{{ asset('storage/images/logo_en.svg') }}" alt="proxyline.net — анонимные прокси">
                    </a>
                        @endif
                @endif
                
                <img class="footer__pay-m" src="{{ asset('storage/images/pay-m.svg') }}" alt="">
            </div>
            <div class="footer__methods">
                <span class="all__methods--btn">
                    {{ __('view all payment methods') }}
                </span>
                <a href="" class="abuse__btn">Abuse</a>
            </div>
        </div>

        <div class="footer__links--group"> 
            <div class="footer__menu">
                <h4>{{ __('By country') }}</h4>
                <div class="footer__links">
                    <ul>
                        <li><a href="">Прокси России</a></li>
                        <li><a href="">Прокси Украина</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__menu">
                <h4>{{ __('Basics') }}</h4>
                <div class="footer__links">
                    <ul>
                        @foreach ($menu_main_bottom as $item)
                            <li><a href="{{ route('page.show',$item->slug) }}">{{ __($item->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="footer__menu">
                <h4>{{ __('Information') }}</h4>
                <div class="footer__links">
                    <ul>
                        @foreach ($menu_info as $item)
                            <li><a href="{{ route('page.show',$item->slug) }}">{{ __($item->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="footer__menu footer__contacts">
                <h4>{{__('Contacts')}}</h4>
                <div class="footer__links">
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
        </div>
    </div>

    <div class="footer__bottom">
        <p>© 2017 - {{date('Y')}} «ProxyLine» — {{ __('rent individual proxies') }}</p>
        <p>{{ __('Technical support and online chat works 24/7 7 days a week') }}</p>
    </div>
</footer>

<div class="mobile__menu">
    <div class="close__b close__menu"></div>
    <div class="mobile__menu--content"> 
        <div class="logo__mobile">
            @if (app()->getLocale() == 'ru')    
                <a href="/"> <img src="{{ asset('storage/images/proxyline_rus_black.png') }}" alt=""></a>
            @else
                <a href="/{{ app()->getLocale() }}"><img src="{{ asset('storage/images/proxyline_eng_black.png') }}" alt=""></a>
            @endif
        </div>
        <div class="contact__mobile">

        <ul class="mobile__contacts--ul">
                        <li>
                            <a href="mailto:admin@proxyline.net">
                                <img src="{{ asset('storage/images/icons/mail.svg') }}" alt="">
                                <span class="boldname">admin@proxyline.net</span>
                                
                            </a>
                        </li>
                        <li>
                            <a href="https://t.me/proxyLine_bot">
                                <img src="{{ asset('storage/images/icons/tg.svg') }}" alt="">
                                <span class="boldname">@ProxyLine_bot</span>
                                 
                            </a>
                        </li>

                        <li class="alltime__support">
                                <img src="{{ asset('storage/images/icons/supporttime.svg') }}" alt="">
                                <span class="aside-contact">

                                    <span>{{ __('24 hour support') }}</span> 
                                    <span> {{ __('No days off') }}</span>

                                </span>
                        </li>

            </ul>
            <ul class="language">

                @foreach (App\Helpers\Langs::LOCALES as $key => $locale)

                @if ($locale == app()->getLocale())
                <li class="ru showed">
                    <a href="" class="current"><img src="{{ asset('storage/images/round_flags/'.$locale.'.svg') }}" alt=""><span>{{ App\Helpers\Langs::LOCALESNAME[$key] }}</span></a>
                </li>
                <div>
                    <li class="ru active__lang"><a><img src="{{ asset('storage/images/round_flags/'.$locale.'.svg') }}" alt=""><span>{{ App\Helpers\Langs::LOCALESNAME[$key] }}</span> </a></li>

                    @endif

                    @endforeach
                    @foreach (App\Helpers\Langs::LOCALES as $key => $locale)
                    @if ($locale != app()->getLocale())
                    <li class=""><a href="{{ route('setlang', $locale) }}"><img src="{{ asset('storage/images/round_flags/'.$locale.'.svg') }}" alt=""><span>{{ App\Helpers\Langs::LOCALESNAME[$key] }}</span></a></li>
                    @endif
                    @endforeach

                </div>
            </ul>

        </div>

        <div class="mobile__menu--wrapper">
            <ul>
                @foreach ($menu_top as $item)
                    <li><a href="{{ route('page.show',$item->slug) }}">{{ __($item->name) }}</a></li>
                @endforeach
                 
            </ul>
        </div>

        <div class="mobile__auth--btn">

            <a href="https://panel.proxyline.net/login/">{{ __('Login') }} / {{ __('Registration') }}</a>

        </div>
    </div>

    <div class="mobile__menu--overlay">
        
    </div>
</div>
 


@if (isset($page) && isset($page->template) && $page->template == 'ceny')
    @vite(['resources/js/app.js','resources/js/ceny.js']) 
 
@elseif (isset($page) && isset($page->template) && $page->template == 'pay')
    @vite(['resources/js/app.js','resources/js/pay.js']) 
 
@elseif (isset($page) && isset($page->template) && ($page->template == 'checker' ||
    $page->template == 'speed' || $page->template == 'ports' ||
    $page->template == 'blacklist' || $page->template == 'checkipv6' ||
     $page->template == 'myip' || $page->template == 'anonymous' ))
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" ref="jquery"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    @vite(['resources/js/app.js','resources/js/checkers.js'])
 
@else
    @vite(['resources/js/app.js'])
@endif
</html>
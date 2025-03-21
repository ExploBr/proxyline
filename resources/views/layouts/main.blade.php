<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div class="container header__container">

            <div class="site__header">

                <div id="logo" class="header__logo">


                    <a class="logo rrl current_page_item">

                        <img src="" alt="proxyline.net — анонимные прокси">



                        <!-- <img src="https://proxyline.net/wp-content/themes/proxyline/img/logo_ru-ny.svg"

                                alt="proxyline.net — анонимные прокси">  -->
                    </a>


                </div>

                <div class="main__navigation">
                    <ul>
                        <li class="parent"><a href="#">Прокси серверы</a>
                            <ul class="navigation__child">
                                <div class="navigation__child--block">
                                    <li>Страны</li>
                                    <ul>
                                        <li><a href="">Россия</a></li>
                                        <li><a href="">Украина</a></li>
                                    </ul>
                                </div>
                            </ul>
                        </li>
                        <li><a href="#">Прокси серверы</a></li>
                        <li><a href="#">Прокси серверы</a></li>
                    </ul>
                </div>



                <div class="user-links">

                    <a href="https://panel.proxyline.net/login/" rel="nofollow" class="nbtn" target="_blank">Авторизация</a>

                    <a href="https://panel.proxyline.net/register/" rel="nofollow" class="nbtn" target="_blank">Регистрация</a>

                </div>



                <ul class="language">

                @foreach (App\Helpers\Langs::LOCALES as $locale)

                    @if ($locale == app()->getLocale())
                        <li class="ru showed">
                            <a href="#" class="current"><img src="" alt="">{{ $locale }}</a>
                        </li>
                        <div> 
                        <li class="ru active__lang"><a>{{ $locale }} </a></li>
 
                    @endif
                
                @endforeach
                @foreach (App\Helpers\Langs::LOCALES as $locale)
                    @if ($locale != app()->getLocale())
                        <li class=""><a href="{{ route('setlang', $locale) }}">{{ $locale }}</a></li>
                    @endif
                @endforeach

                    </div>
                </ul>


            </div>

            <div class="bottom__navigation">



                <div class="bottom__navigation--wrapper">


                    <a href="/proxy-checker/">



                        Прокси чекер</a>

                    <a href="/proverka-skorosti/">



                        Скорость</a>

                    <a href="/proverit-port/">



                        Порты</a>

                    <a href="/ip-moego-servera/">

                        Мой IP</a>

                    <a href="/proverit-svoju-anonimnost/">



                        Анонимность</a>

                    <a href="/proverka-ip-na-chernye-spiski-i-spamnye-bazy/">



                        Черный список</a>

                    <a href="/proverka-ipv6-podkljuchenija-onlajn/">



                        IPV6</a>

                    <a href="/api-info/">



                        API</a>

                    <a href="/besplatnye-onlajn-proksi-servera/">

                        <svg class="menu-checker-icon">
                            <use xlink:href="/wp-content/themes/proxyline/img/menu_sprite.svg#i9"></use>
                        </svg>

                        Бесплатные прокси</a>

                </div>

            </div>

        </div>
    </header>

    @yield('content')
    <div id="app" style="margin-top:30px; margin-bottom: 30px;">
        <page-component></page-component>

    </div>

</body>
<footer>
    <div class="" >
       
        <div class="footer__menu">
            <a href="" class="footer__logo">
                <img src="" alt="">
            </a>
            <img src="" alt="">
            <div> 
                <span class="all__methods--btn">
                    посмотреть все способы оплаты
                </span>
                <a href="" class="abuse__btn">Abuse</a>
            </div>
        </div>
        <div class="footer__menu">
            <h4>По странам</h4>
            <div class="footer__links">
                <ul>
                    <li><a href="">Прокси России</a></li>
                    <li><a href="">Прокси Украина</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__menu">
            <h4>По странам</h4>
                <div class="footer__links">
                    <ul>
                        <li><a href="">Прокси России</a></li>
                        <li><a href="">Прокси Украина</a></li>
                    </ul>
                </div>
        </div>
        <div class="footer__menu">
            <h4>По странам</h4>
                <div class="footer__links">
                    <ul>
                        <li><a href="">Прокси России</a></li>
                        <li><a href="">Прокси Украина</a></li>
                    </ul>
                </div>
        </div>
        <div class="footer__menu">
            <h4>Контакты</h4>
                <div class="footer__links">
                    <ul class="contacts">
                        <li><a href=""><img src="" alt=""><span class="boldname">admin@proxyline.net</span><span>Руководство проекта</span></a></li>
                        <li><a href=""><img src="" alt=""><span class="boldname">admin@proxyline.net</span><span>Руководство проекта</span></a></li>
                    </ul>
                </div>
        </div>    
    </div>

    <div class="footer__bottom">
        <p>© 2017 - {{date('Y')}} «ProxyLine» — аренда индивидуальных прокси</p>
        <p>Техническая поддержка и онлайн чат работает 24/7 Без выходных</p>
    </div>
</footer>

</html>
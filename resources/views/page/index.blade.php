@extends('layouts.main')

@section('content')
<div class="main__banner">
    <div class="main__banner--top"> 
        <div class="main__banner--left">
        {{ var_dump($page->id) }}
            <div>
                 
                <h1>КУПИТЬ ПРОКСИ</h1>
                <h2>Аренда индивидуальных анонимных IP адресов</h2>
            </div>
            <div class="banner__info">
                <div>
                    <img src="" alt="">Прокси в работе<span>100 000</span>
                </div>
                <div>
                    <img src="" alt="">Прокси в работе<span>100 000</span>
                </div>
                <a href="">Купить индивидуальные прокси от 60 рублей в месяц</a>
                <div>
                    <img src="" alt="">Прокси в работе<span>100 000</span>
                </div>
            </div>
        </div>
        
        <div class="main__banner--right">
            <div>
                <h1>Наши партнеры</h1>
                <h2>уже заработали:</h2>
            </div>
            <div>
                <div>
                    <h1>
                        <span>6.087.107
                        </span>
                        млн. руб.
                    </h1>
                </div>
                <div class="svg__group">

                </div>
            </div>
        </div>
    </div>

    <div class="main__banner--bottom">
        <p></p>
        <div class="social__swiper swiper">

        </div> 
    </div>


</div>

@include('includes.advantages')
@endsection


 
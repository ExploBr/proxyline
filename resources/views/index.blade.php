@extends('layouts.main')
@section('title', $page->title)
@section('content')
<div class="main__banner container">
    <div class="main__banner--top"> 
        <div class="main__banner--left">
       
            <div>
                <h1>{{ __('Buy Proxy') }}</h1>
                <div class="h1">{{ __('Rent of individual anonymous IP addresses') }}</div>
            </div>
            <div class="banner__info">
                <div class="banner__block">
                    <i> 
                    <img src="{{ asset('storage/images/header/i2.svg') }}" alt="">
                    <img class="hover" src="{{ asset('storage/images/header/i2-hover.svg') }}" alt="">
                    </i>
                    <p> {{ __('clients chose us') }}</p> <span>100 000</span>
                </div>
                <div class="banner__block">
                    <i> 
                    <img src="{{ asset('storage/images/header/i3.svg') }}" alt="">
                    <img class="hover" src="{{ asset('storage/images/header/i3-hover.svg') }}" alt="">
                    </i>
                    <p>{{ __('repeat orders') }}</p> <span>100 000</span>
                </div>
                <div class="banner__block">
                    <i> 
                    <img src="{{ asset('storage/images/header/i1.svg') }}" alt="">
                    <img class="hover" src="{{ asset('storage/images/header/i1-hover.svg') }}" alt="">
                    </i>
                    <p>{{ __('Proxy at work') }}</p> <span>100 000</span>
                </div>
                <div class="banner__block">
                    <i> 
                    <img src="{{ asset('storage/images/header/i4.svg') }}" alt="">
                    <img class="hover" src="{{ asset('storage/images/header/i4-hover.svg') }}" alt="">
                    </i>
                    <p>{{ __('orders processed') }}</p> <span>100 000</span>
                </div>
                <a href="" class="buy__btn">{{ __('Rent individual proxies from 5 days') }}</a>
                <div class="garant__block">
                    <div class="garant__block--img"> 
                        <img src="{{ asset('storage/images/header/i5.svg') }}" alt="">
                        <img class="hover" src="{{ asset('storage/images/header/i5-hover.svg') }}" alt="">
                    </div>
                    <p>{{ __('money back guarantee') }}</p> <span>{{ __('48 hours') }}</span>
                </div>
            </div>
        </div>
        
        <div class="help__24" onclick="jivo_api.open();">
                <img src="{{ asset('storage/images/header/h24h.svg') }}" alt="">
                <div class="help__24--content">
                    <span>Круглосуточная поддержка 24/7</span>
                    <span>каждый день</span>
                </div>
                 
        </div>

        <div class="main__banner--right">
             
        </div>

         
    </div>

    <div class="main__banner--bottom">
        <p>{{ __('Suitable for popular services:') }}</p>
        <div class="social__swiper swiper">

        </div> 
    </div>


</div>
<div class="advantages__wrapper container"> 
    <div class="advantages__top top__title"> 
        <img src="{{ asset('storage/images/preim-hover.svg') }}" alt="">
        <h3>{{ __('Our advantages') }}</h3>
    </div>
    @include('includes.templates.advantages')
</div>

@include('includes.templates.calculator')

@include('includes.templates.whereuse')
@include('includes.templates.seoblock')
@include('includes.templates.affilate')
@endsection


 
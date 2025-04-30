@extends('layouts.main')
@section('title', $page->title)
@section('content')
<div  class="main__banner"> 
    <div class="container">
        <div class="main__banner--top"> 
            <div class="main__banner--left">
        
                <div>
                    <h1>{{ __('Buy Proxy') }}</h1>
                    <div class="h1">{{ __('Rent of individual anonymous IP addresses') }}</div>
                </div>
                <div id="stats_data">

                        <stats-data lang = @json( app()->getLocale() )></stats-data>
                </div>
            </div>
            
            <div class="help__24" onclick="jivo_api.open();">
                    <img src="{{ asset('storage/images/header/h24h.svg') }}" alt="h24">
                    <div class="help__24--content">
                        <span>{{ __('24/7 support') }}</span>
                        <span>{{ __('every day') }}</span>
                    </div>
                    
            </div>

            <div class="main__banner--right">
                <div class="help__24 dekstop__24" onclick="jivo_api.open();">
                        <img src="{{ asset('storage/images/header/h24h.svg') }}" alt="h24">
                        <div class="help__24--content">
                            <span>{{ __('24/7 support') }}</span>
                            <span>{{ __('every day') }}</span>
                        </div>
                        
                </div>
                <div class="main__banner--svg">
                    <img src="{{ asset('storage/images/main_banner.svg') }}" alt="main banner" width="710" height="480">
                </div>
            </div>

            
        </div>

        <div class="main__banner--bottom">
            <p>{{ __('Suitable for popular services:') }}</p>
            <div class="social__swiper swiper" id="social__swiper">
                <header-slider></header-slider>
            </div> 
        </div>


    </div>
</div>
    
@include('includes.templates.advantages')
 

@include('includes.templates.calculator')

@include('includes.templates.whereuse')
@include('includes.templates.seoblock')
@include('includes.templates.reviews')
@include('includes.templates.affilate')
@endsection


 
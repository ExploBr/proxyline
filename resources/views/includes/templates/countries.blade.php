<div class="all__proxy container">
    <div class="top__title">
            <h3>{!! __('Our proxies are suitable for any<span>white</span>purposes') !!}</h3>
    </div>
<div id="countries__list" class="all__proxy--wrapper">
    <div class="tabs">
        <div class="head-tab activetab">
        <img loading="lazy" src="{{ asset('storage/images/countries-icon.png') }}"   alt="Страны"  >
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/countries-icon-hover.svg') }}"   alt="Страны"  >
            {{ __('Countries') }}
        </div>
        <div class="head-tab">
        <img loading="lazy" src="{{ asset('storage/images/onlinegaming.png') }}"  alt="Игры">
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/onlinegaming-hover.svg') }}"  alt="Игры">
        {{ __('Online Games') }}
        </div>
        <div class="head-tab">
        <img loading="lazy" src="{{ asset('storage/images/socialnetworks.png') }}"  alt="социальные">
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/socialnetworks-hover.svg') }}"  alt="социальные">
        {{ __('social media') }}
        </div>
        <div class="head-tab">
        <img loading="lazy" src="{{ asset('storage/images/browsers.png') }}"  alt="браузеры">
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/browsers-hover.svg') }}"  alt="браузеры">
        {{ __('browsers and parsing') }}
        </div>
        <div class="head-tab">
        <img loading="lazy" src="{{ asset('storage/images/doski.png') }}"  alt="объявлений">
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/doski-hover.svg') }}"  alt="объявлений">
        {{ __('bulletin boards') }}
        </div>
        <div class="head-tab">
        <img loading="lazy" src="{{ asset('storage/images/soft.png') }}"  alt="софт">
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/soft-hover.svg') }}"  alt="софт">
        {{ __('software') }}
        </div>
        <div class="head-tab">
        <img loading="lazy" src="{{ asset('storage/images/another.png') }}"  alt="другие цели">
        <img class="active-img" loading="lazy" src="{{ asset('storage/images/another-hover.svg') }}"  alt="другие цели">
        {{ __('other purposes') }}
        </div>
    </div>
    <countries-component
    :catalogpages = '@json($catalogpages)'
    :countries = '@json($countries)'
    ></countries-component>
</div>
</div>
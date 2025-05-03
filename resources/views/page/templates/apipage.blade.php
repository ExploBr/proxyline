<div class="txtpage apipage__content container">

    <div class="top__title">
        <h1>{!! $page->title !!}</h1>        
    </div>

    <div class="apipage__top">
        @foreach ($page_metas as $item)
            @if ($item->name == 'zagolovok')
                {!! $item->content !!}
            @endif
        @endforeach
    </div>
    
    

    <div class="txt__content">
        <h2>{{ __('Login') }}</h2>
        <h4 class="text-center">{{ __('Your API key') }}</h4>
        <div class="alert alert-primary mb-3 text-center">yourapikeyyourapikey</div>
        <p>{!! __('For authorization, you need to pass your api-key in each request. You can do this by adding the <code>api_key</code> parameter equal to your key to the request, or by passing the <code>API-KEY</code> header.') !!} </p>
<h2>{{ __('Restrictions') }}</h2>
<p>
{{ __('The maximum number of requests per minute is 50.') }}</p>
<h2 >{{ __('Country') }}</h2>
    <ul class="apipage__countries">
        @foreach ($countriesData as $item)
        @if (app()->getLocale() == 'ru')
            <li>{{ $item->code }} - {{ $item->name_ru }}</li>
        @else
            <li>{{ $item->code }} - {{ $item->name }}</li>
        @endif
             
        @endforeach
    </ul>
        {!! $page->content !!}
    </div>


   
</div>
 
 
 
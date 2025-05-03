<div class="txtpage faq__page container">
    <div class="top__title">
        <h1>{{ $page->title }}</h1>
    </div>

    <div class="faq__wrapper">
        <div class="faq__main--content">
            @php $i = 1 @endphp
            @foreach ($page_metas as $faq)
            <div class="faq__main--block" id="{{ $i }}"> 
                @if ($faq->name == 'faq1')
                <h2>{{ __('General information about proxies') }}</h2>
                @else
                <h2>{{ __('General questions about the service') }}</h2>
                @endif
               
                @foreach ($faq->content as $item)
                    <div class="faq__item">
                        <div class="faq__question">
                            {{ $item->faq }}
                        </div>
                        <div class="faq__answer">
                            {!! $item->answer !!}
                        </div>
                    </div>
                @endforeach
                </div>
                @php $i++ @endphp
            @endforeach
        </div>
        <div class="faq__aside">
            <a href="#1">{{ __('General information about proxies') }}</a>
            <a href="#2">{{ __('General questions about the service') }}</a>
        </div>
    </div>
</div>

@include('includes.templates.affilate')
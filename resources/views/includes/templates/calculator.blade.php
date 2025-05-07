@php
    $calculator_info = [
        [
                    'type'=> 'dedicated',
                    'ip_type' => 4,
                    'text_after_title' => 'Issued to one person',
                    'title' => 'Individual IPv4 Proxies',
               ],

                [
                    'type'=>  'shared',
                    'ip_type' => 4,
                    'text_after_title' => 'up to 3 people',
                    'title' => 'IPv4 Shared Proxy',
                ],
                [
                    'type'=> 'dedicated',
                    'ip_type' => 6,
                    'text_after_title' => 'Issued to one person',
                    'title' => 'IPv6/32 Proxy',
                ]
    ]
@endphp
<div id="calculator" class="calculator__main">
    <div  class="top__title">
        <img src="{{ asset('storage/images/calculator-top.svg') }}" alt="">
        @if($page->template == 'catalog')
            <h1>{!! $page->title !!}</h1>
        @else
        <h3>{{ __('Proxy cost') }}</h3>
        @endif
    </div>
    <calculator-component 
    :data_calculator = '@json($data_calculator)'
    :calculator_info = '@json($calculator_info)'
    :modal_info = '@json($modal_info)'
    :crf = '@json(csrf_token())'
    >
    </calculator-component>
</div>
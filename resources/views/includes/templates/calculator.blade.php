@php
    $calculator_info = [
        [
                    'type'=> 'dedicated',
                    'ip_type' => 4,
                    'text_after_title' => 'up to 3 people',
                    'title' => 'IPv4 Shared Proxy',
               ],

                [
                    'type'=>  'shared',
                    'ip_type' => 4,
                    'text_after_title' => 'In one hand',
                    'title' => 'Individual IPv4 Proxies',
                ],
                [
                    'type'=> 'dedicated',
                    'ip_type' => 6,
                    'text_after_title' => 'In one hand',
                    'title' => 'IPv6/32 Proxy',
                ]
    ]
@endphp
<div id="calculator">
    <div  class="top__title">
        <img src="{{ asset('storage/images/calculator-top.svg') }}" alt="">
        <h3>{{ __('Proxy cost') }}</h3>
    </div>
    <calculator-component 
    :data_calculator = '@json($data_calculator)'
    :calculator_info = '@json($calculator_info)'
    >
    </calculator-component>
</div>
<div class="price__page">
    <div class="price__tables container">
        <div class="top__title">
            @foreach ($page_metas as $item)
                @if ($item->name == 'ceny_zagolovok')
                <h1>{!! $item->content !!}</h1>

                @endif
            @endforeach
        </div>  
        
        <div class="price__tables--wrapper">
            @php
                $pricesData = [
                    'ru:shared:4' => [
                        ['min' => 1, 'max' => 20],
                        ['min' => 21, 'max' => 40],
                        ['min' => 41, 'max' => 89],
                        ['min' => 90, 'max' => 1000]
                    ],
                    'ru:dedicated:4' => [
                        ['min' => 1, 'max' => 20],
                        ['min' => 21, 'max' => 40],
                        ['min' => 41, 'max' => 89],
                        ['min' => 90, 'max' => 1000]
                    ],
                    'ru:dedicated:6' => [
                        ['min' => 1, 'max' => 99],
                        ['min' => 100, 'max' => 199],
                        ['min' => 200, 'max' => 299],
                        ['min' => 300, 'max' => 3000]
                    ],
                ];
                
                $course = $course_usd;
                function get_price_from_list_prices($list = [], $count = 1, $days = 5, $course) {
                    
                        if( !empty( $list ) ) {
                            foreach( $list as $key => $item ) {
                                if( $item[0] <= $count ) {
                                    foreach($item[1] as $d_key => $d) {
                                        if( $d[0] <= $days ) {
                                            $price = number_format(($d[1] * $days), 2, '.', '');
                                            return '<div><span class="usd_price"><span class="usd">' . $price . '$</span></span> <span>(<span class="rub">' . number_format((floatval($price) *  $course), 2, '.', '') . ' ₽</span>)</span></div>';
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                        return null;
                    }

                    $tables = ['IPv4 Shared Proxy','Individual IPv4 Proxies','IPv6/32 Proxy'];
            @endphp

            @foreach ($tables  as $key => $table)
                <div class="price__tables--item">
                    <h3>
                        {{ __($table) }}
                    </h3>
                    <div class="price__tables--content">
                        <div class="first-row">
                            <div class="strana">{{ __('Country') }}</div>
                            <div class="kolvo">{{ __('Qty') }}</div>
                            <div class="ceny">{!!   __('Cost of <span>one</span> IP') !!}</div>
                        </div>
                        @php
                         $priceKey = 'ru:shared:4';
                        if($key == 1) $priceKey = 'ru:dedicated:4';
                        if($key == 2) $priceKey = 'ru:dedicated:6';
                        $modal_id = 'allcountries_' . str_replace(['ru:'], '', $priceKey);

                        @endphp
                        
                            @if ( !empty($prices->prices->$priceKey))
                            <div class="other-rows first">
                                <div class="strana"></div>
                                <div class="kolvo"></div>
                                <div class="cenyhyyy">
                                    <div class="pyat">
                                        5 {{__('days' )}}  
                                    </div>
                                    <div class="odin">
                                        1  {{__('month' ) }}  
                                    </div>
                                    <div class="tri">
                                        3  {{__('months' ) }}  
                                    </div>
                                    <div class="god">
                                        1  {{__('year') }} 
                                    </div>
                                </div>
                            </div>
                            @endif
                            @foreach( $pricesData[$priceKey] as $data_key => $item ) 
                                <div class="other-rows">
                                    <div class="strana">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="world-icon"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm193.2 152h-82.5c-9-44.4-24.1-82.2-43.2-109.1 55 18.2 100.2 57.9 125.7 109.1zM336 256c0 22.9-1.6 44.2-4.3 64H164.3c-2.7-19.8-4.3-41.1-4.3-64s1.6-44.2 4.3-64h167.4c2.7 19.8 4.3 41.1 4.3 64zM248 40c26.9 0 61.4 44.1 78.1 120H169.9C186.6 84.1 221.1 40 248 40zm-67.5 10.9c-19 26.8-34.2 64.6-43.2 109.1H54.8c25.5-51.2 70.7-90.9 125.7-109.1zM32 256c0-22.3 3.4-43.8 9.7-64h90.5c-2.6 20.5-4.2 41.8-4.2 64s1.5 43.5 4.2 64H41.7c-6.3-20.2-9.7-41.7-9.7-64zm22.8 96h82.5c9 44.4 24.1 82.2 43.2 109.1-55-18.2-100.2-57.9-125.7-109.1zM248 472c-26.9 0-61.4-44.1-78.1-120h156.2c-16.7 75.9-51.2 120-78.1 120zm67.5-10.9c19-26.8 34.2-64.6 43.2-109.1h82.5c-25.5 51.2-70.7 90.9-125.7 109.1zM363.8 320c2.6-20.5 4.2-41.8 4.2-64s-1.5-43.5-4.2-64h90.5c6.3 20.2 9.7 41.7 9.7 64s-3.4 43.8-9.7 64h-90.5z"></path></svg>
                                        {{__('All countries')}}  <span class="pices-block__all-link" data-id="{{ $modal_id}}">(  {{__('list of countries')}} )</span> 
                                    </div>
                                    <div class="kolvo">
                                        <span data-title="{{__('Qty') }}">{{ $item['min'] }}  - {{ $item['max'] }}</span>
                                    </div>
                                    <div class="pyat" data-title="5 {{__('days' )}}">
                                            {!! get_price_from_list_prices($prices->prices->$priceKey, $item['max'], 5 , $course_usd) !!}
                                    </div>
                                    <div class="odin" data-title="1 {{__('month' )}}">
                                            {!! get_price_from_list_prices($prices->prices->$priceKey, $item['max'], 30, $course_usd)  !!}
                                    </div>
                                    <div class="tri" data-title="3 {{__('months' )}}">
                                            {!! get_price_from_list_prices($prices->prices->$priceKey, $item['max'], 90, $course_usd) !!}
                                    </div>
                                    <div class="god" data-title="1 {{__('year' )}}">
                                             {!! get_price_from_list_prices($prices->prices->$priceKey, $item['max'], 365, $course_usd) !!}
                                    </div>
                                </div>
                            @endforeach
                         
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <div class="main__payment" id="main__payment">
        <main-payment-component
         :data_all = '@json($data_calculator)'
         :payments = '@json($payments)'
         :countries_list = '@json($countries_list)'
         
         ></main-payment-component>
    </div>
     
</div>
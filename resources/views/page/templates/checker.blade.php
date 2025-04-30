<div class="txtpage container">
    <div class="top__title">
        <h1>{!! $page->title !!}</h1>
    </div>
    <h2>{{ __('Proxy list') }}</h2>
    <div class="checker">
         
        <div> 
        <textarea class="js-proxy-list" name="" id="" cols="30" rows="10" placeholder="{{ __('If you have public proxies (without login and password), then IP:PORT. If you have Individual/Private (authorization by login and password), then IP:PORT:LOGIN:PASW') }}"></textarea>
            @foreach ($page_metas as $item)
                @if ($item->name == 'spisok')
                    {!! $item->content !!}
                @endif
            @endforeach
        </div>
        <button class="js-proxy-check">{{ __('Start checking') }}</button>
    </div>

    <div class="js-check-result" style="display: none"> <!--тег результата проверки-->

                <div class="check-result-name">
                    <span>{{ __('Test results') }}</span> <i class="yes js-valid-num">1</i>{{ __('valid') }}, <i class="no js-invalid-num">0</i> {{ __('invalid') }}
                </div>

                <div id="js-result-table_wrapper" class="">
                    <table class="dataTable" id="js-result-table" style="width: 100%;" role="grid"><!--Результат проверки-->

                    </table>
                </div>
                <div style="text-align: center;">
                    <a href="#" class="js-show-all" style="margin-right: 5px">{{ __('Show all proxies') }} </a>
                    <a href="#" class="js-clear-result-table">{{ __('Clear results') }}</a>
                </div>

            </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>
</div>
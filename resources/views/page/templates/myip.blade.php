<div class="txtpage container speed__page">
<div class="top__title">
        @if (count($page_metas) == 0)
                <h1>{!! $page->title !!}</h1>
            @else
            @foreach ($page_metas as $item)
                @if ($item->name == 'zagolovok')
                    {!! $item->content !!}
                @endif
                @break
            @endforeach
            @endif
 
    </div>
    <div class="address js-load-ip-data myip__table">
        <h2 class="largerh2">{{ __('Your IP') }}: <b class="js-ip"></b></h2>
            <div class="responsive-table js-load-ip-data">
                <table class="border__rable">
                    <tr><td>{{ __('Country') }}:</td><td class="js-country"></td></tr>
                    <tr><td>{{ __('City') }}:</td><td class="js-city"></td></tr>
                    <tr><td>{{ __('Index') }}:</td><td class="js-zip"></td></tr>
                    <tr><td>{{ __('Region') }}:</td><td class="js-location"><span class="js-span"></span></td></tr>
                    <tr><td>{{ __('Time zone') }}:</td><td class="js-time-timezone"></td></tr>
                </table>

                <div class="myip__map">
                    <a class="ip-map mt15 js-map" href="javascript:;" data-map="">
                        <img style="display: none" src="" alt="Map">
                    </a>
                </div>
            </div>

            <div class="responsive-table">
                <table>
                    <tr><td style="white-space: nowrap;">X-Forwarded-For</td><td class="js-x_forwarded_for"></td></tr>
                    <tr><td style="white-space: nowrap;">Connection</td><td class="js-connection"></td></tr>
                    <tr><td style="white-space: nowrap;">X-Forwarded-Proto</td><td class="js-x_forwarded_proto"></td></tr>
                    <tr><td style="white-space: nowrap;">Referer</td><td class="js-referer"></td></tr>
                    <tr><td style="white-space: nowrap;">User-Agent</td><td class="js-user_agent"></td></tr>
                    <tr><td style="white-space: nowrap;">Accept</td><td class="js-accept"></td></tr>
                    <tr><td style="white-space: nowrap;">Accept-Encoding</td><td class="js-accept_encoding"></td></tr>
                    <tr><td style="white-space: nowrap;">Accept-Language</td><td class="js-accept_language"></td></tr>
                    <tr><td style="white-space: nowrap;">Accept-Charset</td><td class="js-accept_charset"></td></tr>
                    <tr><td style="white-space: nowrap;">Cookie</td><td class="js-cookie"></td></tr>
                </table>
            </div>
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>
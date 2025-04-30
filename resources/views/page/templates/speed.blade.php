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
    <div>
        <h2 class="largerh2">{{ __('Your IP') }}: <b class="js-ip"></b></h2>
            <div class="responsive-table js-load-ip-data">
                <noindex>
                <!--OST Widget code start--><div style="text-align:right;"><div style="min-height:360px;"><div style="width:100%;height:0;padding-bottom:50%;position:relative;"><iframe style="border:none;position:absolute;top:0;left:0;width:100%;height:100%;min-height:360px;border:none;overflow:hidden !important;" src="//openspeedtest.com/speedtest"></iframe></div></div> </div><!-- OST Widget code end -->
                </noindex>
                <table>
                    <tr><td>{{ __('Country') }}:</td><td class="js-country"></td></tr>
                    <tr><td>{{ __('Provider') }}:</td><td class="js-isp"></td></tr>
                    <tr><td>{{ __('OS') }}:</td><td class="js-os-family"></td></tr>
                    <tr><td>{{ __('Browser') }}:</td><td class="js-browser_info"></td></tr>
                </table>
            </div>
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>
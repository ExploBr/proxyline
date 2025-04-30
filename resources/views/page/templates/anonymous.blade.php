<div class="txtpage container speed__page">
<div class="top__title">

                <h1>{!! $page->title !!}</h1>
          
    </div>
    <div class="address js-load-ip-data myip__table anonim__tables">
            <div class="privacy js-privacy-alert">
               {{ __("My privacy") }}<span class="js-span"></span>%
            </div>
            <div class="responsive-table js-load-ip-data">
                <table>
                    <tr><td>IP:</td><td class="js-ip"></td></tr>
                    <tr><td>{{ __('Country') }}:</td><td class="js-country"></td></tr>
                    <tr><td>{{ __('City') }}:</td><td class="js-city"></td></tr>
                    <tr><td>{{ __('Index') }}:</td><td class="js-zip"></td></tr>
                    <tr><td>{{ __('Location') }}:</td><td class="js-location"><span class="js-span"></span>
                      
                    </td></tr>
                </table>
            </div>

            <div class="tables">
                <table>
                    <tr><td>{{ __('OS') }}:</td><td class="js-os-family"></td></tr>
                    <tr><td>{{ __('Browser') }}:</td><td class="js-browser_info"></td></tr>
                    <tr><td>{{ __('Screen') }}:</td><td class="js-user-resolution"></td></tr>
                </table>
                <table>
                    <tr><td>{{ __('Time zone') }}:</td><td class="js-timezone"></td></tr>
                    <tr><td>{{ __('Time') }}:</td><td class="js-local-time"></td></tr>
                    <tr><td>IP:</td><td class="js-ip-time"></td></tr>
                </table>
            </div>
            <div class="responsive-table">
                <table>
                    <tr><td>User-Agent:</td><td class="js-user_agent"></td></tr>
                    <tr><td>User-Agent JS:</td><td><div class="js-user-agent-label"></div></td></tr>
                </table>
                <table>
                    <tr><td>{{__('Language')}}:</td><td class="js-accept_language"></td></tr>
                    <tr><td>{{__('Language')}} JS:</td><td class="js-user-lang"></td></tr>
                </table>
            </div>
            <div class="tables">
                <table>
                    <tr><td>{{__('Proxy')}}:</td><td>
                        <div class="yellow-label js-has-proxy-no" style="display: none">NO</div>
                        <div class="red-label js-has-proxy-yes" style="display: none;">YES</div>
                    </td></tr>
                    <tr><td>vpn:</td><td>
                        <div class="yellow-label js-has-proxy-no" style="display: none">NO</div>
                        <div class="red-label js-has-proxy-yes" style="display: none;">YES</div>
                    </td></tr>
                    <tr><td>tor:</td><td>
                        <div class="yellow-label js-has-proxy-no" style="display: none">NO</div>
                        <div class="red-label js-has-proxy-yes" style="display: none;">YES</div>
                    </td></tr>
                    <tr><td>{{ __('Anonymizer') }}:</td><td>
                        <div class="yellow-label js-has-proxy-no" style="display: none">NO</div>
                        <div class="red-label js-has-proxy-yes" style="display: none;">YES</div>
                    </td></tr>
                </table>
                <table>
                    <tr><td>Flash:</td><td>
                        <div class="yellow-label js-flash-support-no" style="display: none">NO</div>
                        <div class="red-label js-flash-support-yes" style="display: none;">YES</div>
                    </td></tr>
                    <tr><td>Java:</td><td>
                        <div class="yellow-label js-java-support-no" style="display: none">NO</div>
                        <div class="red-label js-java-support-yes" style="display: none;">YES</div>
                    </td></tr>
                    <tr><td>Activex:</td><td>
                        <div class="yellow-label js-activex-support-no" style="display: none">NO</div>
                        <div class="red-label js-activex-support-yes" style="display: none;">YES</div>
                    </td></tr>
                    <tr><td>webrtc:</td><td>
                        <div class="yellow-label js-webrtc-support-no" style="display: none;">NO</div>
                        <div class="red-label js-webrtc-support-yes" style="display: none">YES</div>
                    </td></tr>
                    <tr><td>webrtc ips:</td><td>-</td></tr>
                </table>
            </div>
            <div class="responsive-table js-privacy-check-ports js-privacy-check-blacklists">
                <table>
                    <tr><td>{{ __('open ports') }}:</td><td>
                        <div class="yellow-label js-open-ports-no" style="display: none">NO</div>
                        <div class="red-label js-open-ports-yes" style="display: none">YES</div>
                    </td></tr>
                    <tr><td>{{ __('blacklist') }}:</td><td class="js-privacy-blacklist">{{ __('Checks') }}: <span class="js-span">0</span>, {{ __('Blacklisted') }} <div class="red-label">0</div></td></tr>
                    <!-- Список серверов черных списков. Нужно в JS -->
                    <span class="blist" data-list="sbl.spamhaus.org"></span>
                    <span class="blist" data-list="xbl.spamhaus.org"></span>
                    <span class="blist" data-list="access.redhawk.org"></span>
                    <span class="blist" data-list="b.barracudacentral.org"></span>
                    <span class="blist" data-list="bl.spamcop.net"></span>
                    <span class="blist" data-list="blackholes.wirehub.net"></span>
                    <span class="blist" data-list="bogons.cymru.com"></span>
                    <span class="blist" data-list="cbl.abuseat.org"></span>
                    <span class="blist" data-list="dev.null.dk"></span>
                    <span class="blist" data-list="dialups.mail-abuse.org"></span>
                </table>
            </div>
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>
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
     <div class="black__list">
            <div  div class="check">
                <input type="text" class="js-ip" placeholder="IP">
                <button class="js-blacklist-check"><span>{{ __('Start checking') }}</span></button>

            </div>

            <div class="">
                <ul class="blacklist-info" style="display: none">
                    <li>{{ __('Checks') }}: <span class="js-checking">0</span></li>
                    <li>{{ __('Verified') }}: <span class="yes js-yes">0</span></li>
                    <li>{{ __('Verified') }}: <span class="no js-no">0</span></li>
                </ul>
            </div>
            <div class="black__list--wrapper">
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="sbl.spamhaus.org">sbl.spamhaus.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="xbl.spamhaus.org">xbl.spamhaus.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="access.redhawk.org">access.redhawk.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="b.barracudacentral.org">b.barracudacentral.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="bl.spamcop.net">bl.spamcop.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="blackholes.wirehub.net">blackholes.wirehub.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="bogons.cymru.com">bogons.cymru.com</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="cbl.abuseat.org">cbl.abuseat.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dev.null.dk">dev.null.dk</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dialups.mail-abuse.org">dialups.mail-abuse.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dialups.visi.com">dialups.visi.com</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.antispam.or.id">dnsbl.antispam.or.id</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.cyberlogic.net">dnsbl.cyberlogic.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.kempt.net">dnsbl.kempt.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl-1.uceprotect.net">dnsbl-1.uceprotect.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl-2.uceprotect.net">dnsbl-2.uceprotect.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl-3.uceprotect.net">dnsbl-3.uceprotect.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="ips.backscatterer.org">ips.backscatterer.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="korea.services.net">korea.services.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dialup.blacklist.jippg.org">dialup.blacklist.jippg.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="mail-abuse.blacklist.jippg.org">mail-abuse.blacklist.jippg.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="psbl.surriel.com">psbl.surriel.com</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="pss.spambusters.org.ar">pss.spambusters.org.ar</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="rbl.schulte.org">rbl.schulte.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="rbl.snark.net">rbl.snark.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="relays.mail-abuse.org">relays.mail-abuse.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="relays.nether.net">relays.nether.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="rsbl.aupads.org">rsbl.aupads.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="block.dnsbl.sorbs.net">block.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.sorbs.net">dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dul.dnsbl.sorbs.net">dul.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="escalations.dnsbl.sorbs.net">escalations.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="http.dnsbl.sorbs.net">http.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="misc.dnsbl.sorbs.net">misc.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="new.dnsbl.sorbs.net">new.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="old.dnsbl.sorbs.net">old.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="smtp.dnsbl.sorbs.net">smtp.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="socks.dnsbl.sorbs.net">socks.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="spam.dnsbl.sorbs.net">spam.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="zombie.dnsbl.sorbs.net">zombie.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="recent.dnsbl.sorbs.net">recent.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="web.dnsbl.sorbs.net">web.dnsbl.sorbs.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="spam.olsentech.net">spam.olsentech.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="spamguard.leadmon.net">spamguard.leadmon.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="spamsources.fabel.dk">spamsources.fabel.dk</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.abuse.ch">dnsbl.abuse.ch</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="tor.dnsbl.sectoor.de">tor.dnsbl.sectoor.de</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="ubl.unsubscore.com">ubl.unsubscore.com</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="cblless.anti-spam.org.cn">cblless.anti-spam.org.cn</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.tornevall.org">dnsbl.tornevall.org</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.anticaptcha.net">dnsbl.anticaptcha.net</div></div>
                <div class="col-md-4"><div style="display: none" class="black-list" data-list="dnsbl.dronebl.org">dnsbl.dronebl.org</div></div>

            </div>
     </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>
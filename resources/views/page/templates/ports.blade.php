<div class="txtpage container ports__page speed__page">
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
    <div class="ports__wrapper check-port">
                <div>
                    
                    <input type="text" class="js-ip" placeholder="IP">
                
                    <input type="text" id="port" class="js-port" placeholder="{{ __('Port') }}">
                    <button class="js-port-check"><span class="js-span">{{ __('Start checking') }}</span></button>
                </div>

                <div class="js-port-list">
                    <a href="#" data-port="80">HTTP - 80</a>
                    <a href="#" data-port="115">SFTP - 115</a>
                    <a href="#" data-port="25">SMTP - 25</a>
                    <a href="#" data-port="8080">HTTP - 8080</a>
                    <a href="#" data-port="21">FTP - 21</a>
                    <a href="#" data-port="22">SSH - 22</a>
                    <a href="#" data-port="143">IMAP - 143</a>
                    <a href="#" data-port="443">HTTPS - 443</a>
                    <a href="#" data-port="873">RSYNC - 873</a>
                    <a href="#" data-port="110">POP3 - 110</a>
                    <a href="#" data-port="993">IMAPS - 993</a>
                </div>
        
    </div>
    <div class="ports__result">
        <div class="">
                <div class="js-port-check-status">
                    <div class="privacy-green js-port-opened" style="display: none"><b></b>: Порт открыт</div>
                    <div class="privacy-red js-port-closed" style="display: none"><b></b>: Порт закрыт</div>
                </div>
            </div>
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>
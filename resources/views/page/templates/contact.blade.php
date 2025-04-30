<div class="contact__page container">
    <div class="top__title">
        <img src="{{ asset('storage/images/contacts-top.svg') }}">
        @foreach ($page_metas as $item)
        @if ($item->name == 'zagolovok')
        <h1>{{ $item->content }}</h1>

        @endif
        @endforeach

    </div>
    <div class="contact__ul footer__links">
        <ul class="contacts"> 
            @foreach ($socials as $item)
            
            <li>
                <a href="{{ $item->link }}">
                    <img src="{{ asset('storage/'. $item->image->path ) }}" alt="">
                    <span class="footer__link--content">
                        <span class="boldname">{{ $item->name }}</span>
                        <span>{!! $item->podpis !!}</span>
                    </span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="image_wrap6 ani6">
        {!! $page->content !!}
    </div>
</div>
@include('includes.templates.affilate')
@foreach ($page_metas as $item)

    @if ($item->name == 'class')
        @php
            $class = $item->content;
           @endphp
        @break
    @else
        @php
            $class = '';
          @endphp
    @endif
@endforeach

<div class="txtpage {{ $class }} container">

    <div class="top__title">
    @php $flag = 0; @endphp
    
            @foreach ($page_metas as $item)
                @if ($item->name == 'zagolovok')
                    @if(mb_strlen(strip_tags($item->content)) != 0)
                    {!! $item->content !!}
                    @php $flag = 1; @endphp
                    
                    @break
                    @endif
                @else
                @php $flag = 0; @endphp
                 
                @endif   
            @endforeach
           
            @if ($flag == 0)
                <h1>{!! $page->title !!}</h1>
            @endif
          
    </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>


   
</div>
 
@foreach ($page_metas as $item)
            @if ($item->name == 'partner_block' && $item->content == 1)
            <div>
                @include('includes.templates.affilate')
            </div>
            @endif
        @endforeach
 
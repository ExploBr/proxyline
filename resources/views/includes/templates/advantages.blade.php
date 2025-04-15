@if (isset($advantages))
<div class="advantages">
 
    @foreach ($advantages as $item)
        <div class="advantages__item">
            <div class="advantages__item--img">
                <img  src="{{ asset('storage/'.$item->image->path.'') }}" alt="">
                @php $image_path = str_replace('.svg', '-hover.svg', $item->image->path)  @endphp
                <img class="hover" src="{{ asset('storage/'.$image_path.'') }}" alt="">
            </div>
            <p>{!! $item->content !!}</p>
        </div>
        
    @endforeach
</div>
@endif
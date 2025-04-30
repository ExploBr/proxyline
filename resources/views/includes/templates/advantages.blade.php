@if (isset($advantages))
<div class="advantages__wrapper container"> 
<div class="advantages__top top__title"> 
        <img src="{{ asset('storage/images/preim-hover.svg') }}" alt="main advantages">
        <h3>{{ __('Our advantages') }}</h3>
    </div>
<div class="advantages">
 
    @foreach ($advantages as $item)
        <div class="advantages__item">
            <div class="advantages__item--img">
                <img  src="{{ asset('storage/'.$item->image->path.'') }}" alt="advantages" >
                @php $image_path = str_replace('.svg', '-hover.svg', $item->image->path)  @endphp
                <img class="hover" src="{{ asset('storage/'.$image_path.'') }}" alt="advantages" loading="lazy">
            </div>
            <p>{!! $item->content !!}</p>
        </div>
        
    @endforeach
</div>
</div>
@endif
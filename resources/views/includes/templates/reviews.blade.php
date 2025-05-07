 
<div class="reviews__block">
    <div class="top__title">
            <img src="{{ asset('storage/images/reviews-top.svg') }}" alt="reviews top">
            <h3>{{ __('Customer Reviews') }}</h3>
    </div>
    <div class="reviews__content"> 
        <div class="animate__reviews">
            @for ($i = 1; $i <= 2; $i++)
                <div class="animate__wrapepr"> 
                     
                @if (app()->getLocale() == 'ru')
                    
                    @foreach ($reviews_ru as $item)
                        <div class="reviews__item">
                            <div class="reviews__item--top">
                                <div class="reviews__item--img">
                                    <img src="{{ asset('storage/'.$item->image->path) }}" alt="avatar" > 
                                    <img src="{{ asset('storage/images/5star.png') }}" alt="5star" class="reviews__rating"> 
                                </div>
                                <div class="reviews__item--name">
                                        <span>{{ $item->name }}</span>  reviewed  <span>Proxy Line</span>
                                </div>
                            </div>

                            <div class="reviews__item--bottom">
                                <div class="reviews__item--content">
                                    {!!  $item->text  !!}
                                </div>
                                <div class="reviews__item--link">
                                    <img src="{{ asset('storage/images/trustpilot.png') }}" alt="trustpilot"> 
                                    <a href="https://www.trustpilot.com/review/proxyline.net" target="_blank">{{ __('Review link') }}</a>
							    </div>
                            </div>  
                        </div>
                    @endforeach
                @else
                    @foreach ($reviews_en as $item)
                        <div class="reviews__item">
                            <div class="reviews__item--top">
                                <div class="reviews__item--img">
                                    <img src="{{ asset('storage/'.$item->image->path) }}" alt="avatar"> 
                                    <img src="{{ asset('storage/images/5star.png') }}" alt="5star" class="reviews__rating"> 
                                </div>
                                <div class="reviews__item--name">
                                        <span>{{ $item->name }}</span>  reviewed  <span>Proxy Line</span>
                                </div>
                            </div>

                            <div class="reviews__item--bottom">
                                <div class="reviews__item--content">
                                    {!!  $item->text  !!}
                                </div>
                                <div class="reviews__item--link">
                                    <img src="{{ asset('storage/images/trustpilot.png') }}" alt="trustpilot"> 
                                    <a href="https://www.trustpilot.com/review/proxyline.net" target="_blank">{{ __('Review link') }}</a>
							    </div>
                            </div>  
                        </div>
                    @endforeach
                @endif  
                </div> 
            @endfor
        
        </div>
    </div>

    <script>
     let items = document.querySelectorAll('.reviews__item');
     items.forEach(function(item, i, arr){

        item.addEventListener('mouseover', function () {
            this.closest('.animate__reviews').classList.add('animat');
        })
        
        item.addEventListener('mouseout', function () {
            this.closest('.animate__reviews').classList.remove('animat');
        })

      });
    </script>
</div>
 
<div class="txtpage  container instruction__page">
    <div class="search__instruction">
        <form role="search" method="get" class="search-form">
            <label>
                <input type="search" class="search-field" placeholder="{{ __('Search') }}…" value="" name="search">
            </label>
            <input type="submit" class="search-submit" value="{{ __('Search') }}">
        </form>
    </div>
    <div class="top__title">
        <h1>{!! $page->title !!}</h1>

    </div>
    <div class="instruction__wrapper">
        @if (isset($posts))
            @foreach ($posts as $post)
                <div class="instruction__item">
                    <div class="instruction__img">
                        {!! $post->preview !!}
                    </div>
                    <div class="instruction__content">
                        <h3><a  href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a> </h3>
                        @if (isset($post->created))
                            <p class="instruction__date">{{ $post->created }}</p>
                        @else
                            <p class="instruction__date">{{ $post->created_at }}</p>
                        @endif

                        <div>
                            @if (mb_strlen($post->content) > 250)
                                {!! mb_substr(strip_tags($post->content), 0, 250) !!}...
                            @else
                                {!! strip_tags($post->content) !!}
                            @endif

                        </div>
                        <a class="instruction__btn" href="{{ route('post.show',$post->slug) }}">
                            {{ __('More') }}
                        </a>
                    </div>
                </div>
            @endforeach

            {{ $posts->withQueryString()->onEachSide(1)->links('pagination::custompagination') }}
        @else
            <p class="not__found">{{ __('Nothing found matching your request') }}</p> 
        @endif

    </div>


     
</div>

@include('includes.templates.affilate')
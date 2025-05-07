<div class="txtpage container speed__page">
    <div class="top__title">
                <h1>{!! $page->title !!}</h1>
 
    </div>

    <div class="sitemap">
        <div>
            @foreach ($Pages as $page)
                <a href="{{ route('page.show', $page->slug) }}">{{ $page->title }}</a>
            @endforeach
        </div>
        <h2>{{ __('Instructions') }}</h2>
        <div>
            @foreach ($Posts as $post)
            <a href="{{ route('page.show', $post->slug) }}">{{ $post->title }}</a>
            @endforeach
        </div>
    </div>
</div>
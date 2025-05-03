@unless ($breadcrumbs->isEmpty())
    <ul class="breadcrumb__wrapper">
        @foreach ($breadcrumbs as $breadcrumb)
 
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li><span>›</span>
            @else
               <li class="breadcrumb-item active"> {{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ul>
@endunless
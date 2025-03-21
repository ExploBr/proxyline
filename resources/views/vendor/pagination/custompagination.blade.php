@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="">
        <div class="">
             
            <div class="pagination pagination-sm m-0">
                 
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="page-link" aria-hidden="true">
                                 <
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-label="{{ __('pagination.previous') }}">
                            <
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                   
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="page-link">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                              
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="page-link" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link" aria-label="{{ __('pagination.next') }}">
                            >
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="page-link" aria-hidden="true">
                               >
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="">
        <div class="">
             
            <div class="pagination pagination-sm m-0">
                 
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="navigation--link">
                            <span class="page-link" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
                                <path d="M7 13.5L1 7.5L7 1.5" stroke="#1B1425" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-label="{{ __('pagination.previous') }}" class="navigation--link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none">
                                <path d="M7 13.5L1 7.5L7 1.5" stroke="#1B1425" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                   
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="page-link page-item">{{ $element }}</span>
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
                                    <a href="{{ $url }}" class="page-link page-item" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link" aria-label="{{ __('pagination.next') }}" class="navigation--link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none" style="transform:rotate(180deg)">
                                <path d="M7 13.5L1 7.5L7 1.5" stroke="#1B1425" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="navigation--link">
                            <span class="page-link" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15" fill="none" style="transform:rotate(180deg)">
                                <path d="M7 13.5L1 7.5L7 1.5" stroke="#1B1425" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

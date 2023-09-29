@if ($paginator->hasPages())
    <nav class="mypaginate">
        <div>
            <p>
                {!! __('Showing') !!}
                <span class="mypaginate_text">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="mypaginate_text">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="mypaginate_text">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        <div>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link mycolor-grey mypaginate_text" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link mycolor-grey mypaginate_text" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link mycolor-grey mypaginate_text">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span
                                        class="page-link mycolor-grey mypaginate_text">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link mycolor-grey mypaginate_text"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link mycolor-grey mypaginate_text" href="{{ $paginator->nextPageUrl() }}" rel="next"
                            aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link mycolor-grey mypaginate_text" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </div>
        </div>
    </nav>
@endif

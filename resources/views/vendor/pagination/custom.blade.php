@if ($paginator->hasPages())
    <nav>
        <ul class="pagination mb-0" style="gap: 5px;">

            {{-- PREV --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"
                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-muted);">
                        Prev
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                        Prev
                    </a>
                </li>
            @endif

            {{-- PAGE NUMBERS --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link"
                                    style="background: var(--gold); border-color: var(--gold); color: var(--bg-primary);">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}"
                                    style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- NEXT --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                        Next
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link"
                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-muted);">
                        Next
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif

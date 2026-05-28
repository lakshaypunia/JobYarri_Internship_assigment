@if ($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination pagination-sm mb-0" style="gap:.25rem;flex-wrap:wrap">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" style="font-size:13px!important;padding:.35rem .8rem!important;border-radius:8px!important;border:1px solid #e2e8f0;color:#cbd5e1;background:#f8fafc;line-height:1.5">
                    &laquo; Prev
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   style="font-size:13px!important;padding:.35rem .8rem!important;border-radius:8px!important;border:1px solid #e2e8f0;color:#6366f1;background:#fff;line-height:1.5;text-decoration:none">
                    &laquo; Prev
                </a>
            </li>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link" style="font-size:13px!important;padding:.35rem .65rem!important;border-radius:8px!important;border:1px solid #e2e8f0;line-height:1.5">{{ $element }}</span>
                </li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link" style="font-size:13px!important;padding:.35rem .65rem!important;border-radius:8px!important;background:#6366f1;border-color:#6366f1;color:#fff;line-height:1.5">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}" style="font-size:13px!important;padding:.35rem .65rem!important;border-radius:8px!important;border:1px solid #e2e8f0;color:#6366f1;background:#fff;line-height:1.5;text-decoration:none">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                   style="font-size:13px!important;padding:.35rem .8rem!important;border-radius:8px!important;border:1px solid #e2e8f0;color:#6366f1;background:#fff;line-height:1.5;text-decoration:none">
                    Next &raquo;
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" style="font-size:13px!important;padding:.35rem .8rem!important;border-radius:8px!important;border:1px solid #e2e8f0;color:#cbd5e1;background:#f8fafc;line-height:1.5">
                    Next &raquo;
                </span>
            </li>
        @endif

    </ul>
</nav>
@endif

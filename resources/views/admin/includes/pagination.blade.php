@if($paginator->hasPages())
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">

            {{-- Nút "Trang đầu" --}}
            @if ($paginator->onFirstPage())
                <li class="page-link disabled" aria-disabled="true" aria-label="@lang('pagination.first')">
                    <span aria-hidden="true">Trang đầu</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}" rel="prev" aria-label="@lang('pagination.first')">Trang đầu</a>
                </li>
            @endif

            {{-- Hiển thị các liên kết của các trang --}}
            @foreach ($elements as $element)
                {{-- Hiển thị các liên kết trang số --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Nút "Trang cuối" --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="next"
                       aria-label="@lang('pagination.last')">Trang cuối</a>
                </li>
            @else
                <li class="page-link disabled" aria-disabled="true" aria-label="@lang('pagination.last')">
                    <span aria-hidden="true">Trang cuối</span>
                </li>
            @endif
        </ul>
    </div>
@endif

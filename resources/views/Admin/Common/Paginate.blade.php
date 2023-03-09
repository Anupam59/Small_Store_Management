

{{--<div class="row">--}}
{{--    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>--}}
{{--    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">--}}
{{--        <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">--}}
{{--            <ul class="pagination">--}}
{{--                --}}
{{--                <li class="paginate_button page-item previous disabled" id="kt_table_users_previous">--}}
{{--                    <a href="#" aria-controls="kt_table_users" data-dt-idx="0" tabindex="0" class="page-link">--}}
{{--                        <i class="previous"></i></a></li><li class="paginate_button page-item active">--}}
{{--                    <a href="#" aria-controls="kt_table_users" data-dt-idx="1" tabindex="0" class="page-link">1</a>--}}
{{--                </li>--}}
{{--                --}}
{{--                --}}
{{--                <li class="paginate_button page-item ">--}}
{{--                    <a href="#" aria-controls="kt_table_users" data-dt-idx="2" tabindex="0" class="page-link">2</a>--}}
{{--                </li>--}}
{{--                --}}
{{--                --}}
{{--                <li class="paginate_button page-item ">--}}
{{--                    <a href="#" aria-controls="kt_table_users" data-dt-idx="3" tabindex="0" class="page-link">3</a>--}}
{{--                </li>--}}
{{--                <li class="paginate_button page-item next" id="kt_table_users_next">--}}
{{--                    <a href="#" aria-controls="kt_table_users" data-dt-idx="4" tabindex="0" class="page-link">--}}
{{--                        <i class="next"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@if ($paginator->hasPages())
    <nav>
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true"> <i class="previous"></i> </span>
            </li>
        @else
            <li class="paginate_button page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"> <i class="previous"></i> </a>
            </li>
        @endif

        <?php
        $start = $paginator->currentPage() - 3; // show 3 pagination links before current
        $end = $paginator->currentPage() + 3; // show 3 pagination links after current
        if($start < 1) {
            $start = 1; // reset start to 1
            $end += 1;
        }
        if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
        ?>

        @if($start > 1)
            <li class="paginate_button page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}">{{1}}</a>
            </li>
            @if($paginator->currentPage() != 4)
                {{-- "Three Dots" Separator --}}
                <li class="paginate_button page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
        @endif
        @for ($i = $start; $i <= $end; $i++)
            <li class="paginate_button page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{$i}}</a>
            </li>
        @endfor
        @if($end < $paginator->lastPage())
            @if($paginator->currentPage() + 3 != $paginator->lastPage())
                {{-- "Three Dots" Separator --}}
                <li class="paginate_button page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
            @endif
            <li class="paginate_button page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i class="next"></i> </a>
            </li>
        @else
            <li class="paginate_button page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true"> <i class="next"></i> </span>
            </li>
        @endif
    </ul>
    </nav>
@endif


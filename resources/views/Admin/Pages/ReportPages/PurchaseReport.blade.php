@extends('Admin.Layout.main')

@section('content')

    <?php
    $user_role = auth()->user()->role;
    ?>


    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">purchase List</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Purchase List</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->

                </div>
                <!--end::Page title-->



                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                                </svg>
                            </span>Filter</a>
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-1000px" data-kt-menu="true" id="kt_menu_63de6bfc33b19">
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                            </div>
                            <div class="separator border-gray-200"></div>
                            <div class="row px-7 py-5">

                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Supplier</span>
                                        </label>
                                        <input id="SupplierID" type="text" class="form-control form-control-lg form-control-solid" placeholder="Supplier" value="{{ Request::get('supplier') }}">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Memo No</span>
                                        </label>
                                        <input id="MemoNoID" type="text" class="form-control form-control-lg form-control-solid" placeholder="Memo Number" value="{{ Request::get('memo_no') }}">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Start Date</span>
                                        </label>
                                        <input id="StartDate" type="date" value="{{ Request::get('start_date') }}" class="form-control form-control-lg form-control-solid">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>End Date</span>
                                        </label>
                                        <input id="EndDate" type="date" value="{{ Request::get('end_date') }}" class="form-control form-control-lg form-control-solid">
                                    </div>
                                </div>


                                <div style="text-align: end;">
                                    <a id="ProductLogSearch" class="btn btn-sm fw-bold btn-primary">Search</a>
                                    <a id="ProductLogReset" class="btn btn-sm fw-bold btn-info">Reset</a>
                                </div>


                            </div>

                        </div>
                    </div>
                    @if($user_role == 5 )
                        <a href="/product-purchase" class="btn btn-sm fw-bold btn-primary">Purchase Create</a>
                    @endif
                </div>
                <!--end::Actions Filter-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->


        <!--begin::Content Table -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

            @if(!$Purchase->isEmpty())
                <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                <!--begin::Table head-->
                                <thead class="text-start">
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">SL.</th>
                                    <th class="min-w-125px">Date</th>
                                    <th class="min-w-125px">Quantity</th>
                                    <th class="min-w-125px">Supplier</th>
                                    <th class="min-w-125px">Memo No</th>
                                    <th class="min-w-125px">User</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="text-end min-w-100px">Action</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold text-start">

                                @foreach($Purchase as $key => $PurchaseI)
                                    <tr>
                                        <td>{{ $key+1 }}</td>

                                        <td>{{ date("d-m-Y", strtotime($PurchaseI->created_date)) }}</td>

                                        <td>{{ $PurchaseI->total_quantity }}</td>
                                        <td>{{ $PurchaseI->supplier }}</td>
                                        <td>{{ $PurchaseI->memo_number }}</td>
                                        <td>{{ $PurchaseI->name }}</td>


                                        @if($PurchaseI->status == 1)
                                            <td><div class="badge badge-light-success fw-bold">Active</div></td>
                                        @elseif($PurchaseI->status == 2)
                                            <td><div class="badge badge-light-danger fw-bold">Inactive</div></td>
                                        @endif


                                        <td class="text-end">
                                            <a href="/purchase-report-details/{{ $PurchaseI->purchase_id }}" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions</a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>--}}
{{--                                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">--}}
{{--                                    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">--}}

{{--                                        {{ $Purchase->onEachSide(3)->links('Admin.Common.Paginate') }}--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                @else
                    @include('Admin.Common.DataNotFound')
                @endif

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content table -->

    </div>
    <!--end::Content wrapper-->

@endsection

@section('script')
    <script>

        $('#ProductLogSearch').click(function () {
            var supplier = $('#SupplierID').val();
            var memo_no = $('#MemoNoID').val();
            if ($('#StartDate').val()){
                var start_date = moment($('#StartDate').val()).format('YYYY-MM-DD 00:00:00');
            }else{
                var start_date = '';
            }
            if ($('#EndDate').val()){
                var end_date = moment($('#EndDate').val()).format('YYYY-MM-DD 23:59:59');
            }else{
                var end_date = '';
            }
            window.location.replace("/purchase-list?supplier="+supplier+"&memo_no="+memo_no+"&start_date="+start_date+"&end_date="+end_date);
        });

        $('#ProductLogReset').click(function () {
            var supplier = '';
            var memo_no = '';
            var start_date = '';
            var end_date = '';
            window.location.replace("/purchase-list?supplier="+supplier+"&memo_no="+memo_no+"&start_date="+start_date+"&end_date="+end_date);
        });


    </script>
@endsection

@extends('Admin.Layout.main')

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 notPrint">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Requisition Report</h1>
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
                        <li class="breadcrumb-item text-muted">Requisition Report</li>
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
                                            <span>Department</span>
                                        </label>

                                        <select id="DepartmentId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Department" class="form-control form-control-lg form-control-solid">
                                            <option value="">Select Department</option>
                                            @if(!$Department->isEmpty())
                                                @foreach($Department as $DepartmentItem)
                                                    <option value="{{ $DepartmentItem->department_id }}">{{ $DepartmentItem->department_name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Store</span>
                                        </label>

                                        <select id="StoreId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Store" class="form-control form-control-lg form-control-solid">
                                            <option value="">Select Store</option>
                                            @if(!$Store->isEmpty())
                                                @foreach($Store as $StoreItem)
                                                    <option value="{{ $StoreItem->store_id }}">{{ $StoreItem->store_name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Product</span>
                                        </label>

                                        <select id="ProductId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Product" class="form-control form-control-lg form-control-solid">
                                            <option value="">Select Product</option>
                                            @if(!$Product->isEmpty())
                                                @foreach($Product as $ProductItem)
                                                    <option value="{{ $ProductItem->product_id }}">{{ $ProductItem->product_name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">

                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Status</span>
                                        </label>
                                        <select id="StatusId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Status" value="{{ Request::get('status') }}" class="form-control form-control-lg form-control-solid">
                                            <option value=" " >Select Mode</option>
                                            <option value="1" @if( Request::get('status') == "1") {{ 'selected' }} @endif>Pending</option>
                                            <option value="2" @if( Request::get('status') == "2") {{ 'selected' }} @endif>Approved</option>
                                            <option value="3" @if( Request::get('status') == "3") {{ 'selected' }} @endif>Delivered</option>
                                            <option value="5" @if( Request::get('status') == "5") {{ 'selected' }} @endif>Approved Confirm</option>
                                            <option value="4" @if( Request::get('status') == "4") {{ 'selected' }} @endif>Canceled</option>
                                        </select>

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


                        <a href="#" class="btn btn-sm btn-primary fw-bold" onclick="window.print();">
                            Print
                        </a>
                    </div>


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

            @if(!$Requisition->isEmpty())
                <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                <!--begin::Table head-->
                                <thead class="text-start header-space">
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">SL.</th>
                                    <th class="min-w-125px">Date</th>
                                    <th class="min-w-125px">User</th>
                                    <th class="min-w-125px">Department</th>
                                    <th class="min-w-125px">Store</th>
                                    <th class="min-w-125px">Quantity</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="text-end min-w-100px">Details</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold text-start">

                                @foreach($Requisition as $key => $RequisitionI)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ date("d-m-Y", strtotime($RequisitionI->created_date)) }}</td>
                                        <td>{{ $RequisitionI->name }}</td>
                                        <td>{{ $RequisitionI->department_name }}</td>
                                        <td>{{ $RequisitionI->store_name }}</td>
                                        <td>{{ $RequisitionI->total_quantity }}</td>
                                        @if($RequisitionI->status == 1)
                                            <td><div class="badge badge-light-info fw-bold">Pending</div></td>
                                        @elseif($RequisitionI->status == 2)
                                            <td><div class="badge badge-light-success fw-bold">Approved</div></td>
                                        @elseif($RequisitionI->status == 3)
                                            <td><div class="badge badge-light-primary fw-bold">Delivered</div></td>
                                        @elseif($RequisitionI->status == 5)
                                            <td><div class="badge badge-light-danger fw-bold">Approved Confirm</div></td>
                                        @elseif($RequisitionI->status == 4)
                                            <td><div class="badge badge-light-danger fw-bold">Canceled</div></td>
                                        @endif
                                        <td class="text-end">
                                            <a href="/requisition-report-details/{{ $RequisitionI->requisition_id }}" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Details</a>
                                        </td>

{{--                                        Nexted Table--}}
{{--                                        <table>--}}
{{--                                            <div class="">--}}
{{--                                                <tr>--}}
{{--                                                    <th class="w-10px pe-2">SL.</th>--}}
{{--                                                    <th class="min-w-125px">Product</th>--}}
{{--                                                    <th class="min-w-125px">Quantity</th>--}}
{{--                                                </tr>--}}
{{--                                                @foreach($RequisitionI->req_log as $pItem => $product)--}}
{{--                                                    <tr>--}}
{{--                                                        <td class="w-10px pe-2">{{ $pItem+1 }}</td>--}}
{{--                                                        <td class="min-w-125px">{{ $product->product->product_name }}</td>--}}
{{--                                                        <td class="min-w-125px">{{ $product->quantity }}</td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </table>--}}

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

{{--                            <div class="row">--}}
{{--                                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>--}}
{{--                                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">--}}
{{--                                    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">--}}

{{--                                        {{ $Requisition->onEachSide(3)->links('Admin.Common.Paginate') }}--}}

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
            var department_id = $('#DepartmentId').val();
            var store_id = $('#StoreId').val();
            var product_id = $('#ProductId').val();
            var statusn = $('#StatusId').val();


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
            window.location.replace("/requisition-report?department_id="+department_id+"&store_id="+store_id+"&product_id="+product_id+"&status="+statusn+"&start_date="+start_date+"&end_date="+end_date);
        });

        $('#ProductLogReset').click(function () {
            var department_id = '';
            var store_id = '';
            var product_id = '';
            var statusn = '';
            var start_date = '';
            var end_date = '';
            window.location.replace("/requisition-list?department_id="+department_id+"&store_id="+store_id+"&product_id="+product_id+"&status="+statusn+"&start_date="+start_date+"&end_date="+end_date);
        });


    </script>
@endsection

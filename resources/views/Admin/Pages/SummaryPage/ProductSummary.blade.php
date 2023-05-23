@extends('Admin.Layout.main')

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product Summary</h1>
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
                        <li class="breadcrumb-item text-muted">Product Summary</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->

                </div>
                <!--end::Page title-->



                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                    <!-- Some code add next time -->

                </div>
                <!--end::Actions Filter-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->



        <!--begin::Content Table -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl" style="background-color: #fff;">

                <div class="row px-7 py-5">

                    <div class="col-md-3">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span>Product</span>
                            </label>
                            <select id="ProductId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Product" class="form-control form-control-lg form-control-solid" required>
                                <option value="">Select Product</option>
                                @if(!$Product->isEmpty())
                                    @foreach($Product as $ProductItem)
                                        <option value="{{ $ProductItem->product_id }}" @if(Request::get('product_id') == $ProductItem->product_id) {{ 'selected' }} @endif >{{ $ProductItem->product_name }}</option>
                                    @endforeach
                                @else

                                @endif
                            </select>

                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span>Start Date</span>
                            </label>
                            <input id="StartDate" type="date" value="@if(Request::get('start_date')){{Request::get('start_date')}}@else{{date('Y-m-d')}}@endif" class="form-control form-control-lg form-control-solid">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span>End Date</span>
                            </label>
                            <input id="EndDate" type="date" value="@if(Request::get('end_date')){{Request::get('end_date')}}@else{{ date('Y-m-d')}}@endif" class="form-control form-control-lg form-control-solid">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="invisible d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span>option</span>
                            </label>
                            <div style="text-align: end;">
                                <a id="ProductSearch" class="btn btn-sm fw-bold btn-primary">Search</a>
                                <a id="ProductReset" class="btn btn-sm fw-bold btn-info">Reset</a>
                            </div>
                        </div>
                    </div>




                </div>

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content table -->





        <!--begin::Content Table -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                @if($ProductSummary)
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
                                    <th class="min-w-125px">Previous Stock</th>
                                    <th class="min-w-125px">Purchase</th>
                                    <th class="min-w-125px">Memo</th>
                                    <th class="min-w-125px">Total Quantity</th>
                                    <th class="min-w-125px">Delivered Quantity</th>
                                    <th class="min-w-100px">Remaining Balance</th>
                                    <th class="min-w-100px">Remarks</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold text-start">

                                <?php
                                    if($TodayTotal){
                                        $Total = $TodayTotal->opening_stock;
                                    }else{
                                        $Total = 0;
                                    }
                                ?>
                                {{ $Total }}

                                @foreach($ProductSummary as $key => $ProductLogI)

                                    <?php
                                        $PreviousStock = $Total;
                                        $TotalQuantity = $PreviousStock + $ProductLogI->purchase;
                                        $RemainingBalance = $TotalQuantity - $ProductLogI->delivered;
                                    ?>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ date("d-m-Y", strtotime($ProductLogI->product_created_date)) }}</td>
                                        <td>{{ $PreviousStock }}</td>
                                        <td>{{ $ProductLogI->purchase }}</td>
                                        <td>Memo{{ $key+1 }}</td>
                                        <td>{{ $TotalQuantity }}</td>
                                        <td>{{ $ProductLogI->delivered }}</td>
                                        <td>{{ $RemainingBalance }}</td>
                                        <td>-------</td>
                                    </tr>
                                    <?php
                                        $Total = $RemainingBalance;
                                    ?>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                @else
                    @if($filter_status)
                        @include('Admin.Common.DataNotFound')
                    @endif
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

        $('#ProductSearch').click(function () {
            var product_id = $('#ProductId').val();

            if ($('#StartDate').val()){
                var start_date = moment($('#StartDate').val()).format('YYYY-MM-DD');
            }else{
                var start_date = '';
            }
            if ($('#EndDate').val()){
                var end_date = moment($('#EndDate').val()).format('YYYY-MM-DD');
            }else{
                var end_date = '';
            }
            window.location.replace("/product-summary-report?product_id="+product_id+"&start_date="+start_date+"&end_date="+end_date);
        });

        $('#ProductReset').click(function () {
            var product_id = '';
            var start_date = '';
            var end_date = '';
            window.location.replace("/product-summary-report?product_id="+product_id+"&start_date="+start_date+"&end_date="+end_date);
        });

    </script>
@endsection

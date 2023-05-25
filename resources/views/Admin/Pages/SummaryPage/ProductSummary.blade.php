@extends('Admin.Layout.main')

@section('content')

    <style>

        .headerGroup:after {
            content: 'Text';
            /*background-image: url('Moto-invoice-setup-96-watter-mark.jpg');*/
        }


        /*-----start print layout---*/
        .header {
            visibility: hidden;
            width: 100%;
            height: 10px;
            background: #fff;
            position: fixed;
            top: 0px;
            left: 0;
            z-index: 99999999 !important;
            text-align: center;
        }

        .footer {
            visibility: hidden;
            width: 100%;
            height: 10px;
            position: fixed;
            bottom: 0px;
            left: 0;
            background: #fff;
            z-index: 99999999 !important;
            text-align: right;
        }

        .print-only {
            display: none !important;
        }

        .headerGroup {
            position: relative;
            background: transparent;
        }

        .headerGroup:after {
            font-size: 42px;
            color: #fff;
            filter: grayscale(0.5);
            background-size: cover;
            opacity: 0;
            position: absolute;
            top: 350px;
            left: 50%;
            width: 450px;
            height: 450px;
            z-index: 1 !important;
            transform: translate(-50%);
        }

        /* ============media start========== */
        @media print {

            .headerGroup:after {
                opacity: .1;
            }
            .content ,.content-wrapper{
                padding: 0 !important;
                margin: 0 !important;
                background-color: #fff;
            }

            .header, .header-block {
                height: 80px;
                background-color: #fff;
                padding: 0;
                margin: 0;
            }
            .footer, .footer-block {
                height: 80px;
                background-color: none;
            }
            footer {
                page-break-after: always;
                height: 120px !important;
            }
            @page {
                size: A4;
                -webkit-print-color-adjust: exact;
                margin: 0 !important;
                padding:0 !important;
                width: 100%;
                height: 100%;
            }
            thead {
                display: table-header-group;
            }
            tfoot {
                display: table-footer-group;
            }
            .invoice-print {
                width: 95%;
            }
            .header {
                visibility: visible;
            }
            .footer {
                visibility: visible;
            }
            html, body {
                border: 1px solid white;
                height: 99%;
                page-break-after: avoid;
                page-break-before: avoid;
            }
            /* ----for content management in print layout---- */
            .no-print {
                display: none;
            }
            .print-only {
                display: block !important;
            }
            /* ----aditional style----- */
            .page{
                margin-right:2rem;
                margin-left: 2rem;
            }

        }
        /* ==============end print=========== */
        /* ================================== */


    </style>






    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid page-container">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 no-print">
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
                    <a href="#" class="btn btn-sm btn-primary fw-bold" onclick="window.print();">Print</a>

                </div>
                <!--end::Actions Filter-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->



        <!--begin::Content Table -->
        <div id="kt_app_content" class="app-content flex-column-fluid no-print">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl" style="background-color: #fff;">

                <div class="row px-7 py-5">

                    <div class="col-md-3">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span>Product</span>
                            </label>
                            <select id="ProductId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Product" class="form-control form-control-lg form-control-solid" required>
                                <option value=" ">Select Product</option>
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






        <table width="100%">

            <thead>
            <tr>
                <td class="headerGroup">
                    <div class="header-block"></div>
                </td>
            </tr>
            </thead>


            <tfoot>
            <tr>
                <td class="footerGroup">
                    <div class="footer-block"></div>
                </td>
            </tr>
            </tfoot>



            <tbody>
                <tr>
                    <td>



                        <!--begin::Content Table -->
                        <div id="kt_app_content" class="app-content flex-column-fluid page">
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
                                                        <td>{{ $refData[$key] }}</td>
                                                        <td>{{ $TotalQuantity }}</td>
                                                        <td>{{ $ProductLogI->delivered }}</td>
                                                        <td>{{ $RemainingBalance }}</td>
                                                        <td> </td>
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




                    </td>
                </tr>
            </tbody>


        </table>










    </div>
    <!--end::Content wrapper-->



    <!-- ============ srtart absolute header/footer image========== -->
    <div class="header">
        <img src="{{asset('Images/logo-sm.png')}}" alt="Logo image" style="background-size: cover; margin-top: 15px; width: 40px; height:40px;">
        <h1 style="font-size: 20px;">Stock Register of Divisional Commissioner's Office, Sylhet</h1>
        <hr>
    </div>
    <div class="footer">
        <hr>
        <p style="font-size: 16px; margin-right: 25px;">Date: {{ date("d-M-y") }}</p>
    </div>

    <!-- ============ end absolute header/footer image========== -->



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


        function getMenu(create_date) {
            var reference= [];
            axios.get('/getMenu/'+create_date,{
            }).then(function (response) {
                var JsonData = response.data;
                $.each(JsonData, function (i, item) {
                    reference[i]= JsonData[i].reference;
                });
                return reference.toString();
            });
        }

    </script>
@endsection

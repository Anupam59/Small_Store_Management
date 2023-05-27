@extends('Admin.Layout.main')

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <p id="RequisitionId" class="d-none">{{ request()->route('id') }}</p>
        <p id="UserId" class="d-none">{{ Auth::user()->id }}</p>

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Requisition Details</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Invoice Manager</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="/requisition-list" class="btn btn-sm fw-bold btn-primary">Requisition List</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!-- begin::Invoice 3-->
                <div class="card">
                    <!-- begin::Body-->
                    <div class="card-body py-20">
                        <!-- begin::Wrapper-->
                        <div class="mw-lg-950px mx-auto w-100">

                            <!--begin::Body-->
                            <div class="pb-12">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column gap-7 gap-md-10">
                                    <!--begin::Message-->
                                    <div class="fw-bold fs-2">{{ $Requisition->creator_by }}
                                        <span class="fs-6">({{ $Requisition->creator_email }})</span>,
                                        <br />
                                        <span class="text-muted fs-5">{{ $Requisition->note }}</span></div>
                                    <!--begin::Message-->

                                    <!--begin::Separator-->
                                    <div class="separator"></div>
                                    <!--begin::Separator-->

                                    <!--begin::Order details-->
                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">

                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Requisition Id</span>
                                            <span class="fs-5">{{ $Requisition->requisition_id }}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Date</span>
                                            <span class="fs-5">{{ date('d M, Y',strtotime($Requisition->requisition_date))}}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Department</span>
                                            <span class="fs-5">{{ $Requisition->department_name }}</span>
                                        </div>

                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Store</span>
                                            <span class="fs-5">{{ $Requisition->store_name }}</span>
                                        </div>


                                    </div>
                                    <!--end::Order details-->


                                    <!--begin::Order details-->
                                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">


                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Approved By:</span>
                                            @if($Requisition->approved_by != null)
                                            <span class="fs-5">{{ $Requisition->approved_by }}</span>
                                            <span class="fs-5">{{ date('d M, Y',strtotime($Requisition->approved_date))}}</span>
                                            @else
                                                <span class="fs-5">-------</span>
                                            @endif
                                        </div>




                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Approved Confirm: </span>
                                            @if($Requisition->approved_conf_by != null)
                                            <span class="fs-5">{{ $Requisition->approved_conf_by }}</span>
                                            <span class="fs-5">{{ date('d M, Y',strtotime($Requisition->approved_conf_date))}}</span>
                                            @else
                                                <span class="fs-5">-------</span>
                                            @endif
                                        </div>




                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Canceled By:</span>
                                            @if($Requisition->canceled_by != null)
                                            <span class="fs-5">{{ $Requisition->canceled_by }}</span>
                                            <span class="fs-5">{{ date('d M, Y',strtotime($Requisition->canceled_date))}}</span>
                                            @else
                                                <span class="fs-5">-------</span>
                                            @endif
                                        </div>




                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Delivered By:</span>
                                            @if($Requisition->delivered_by != null)
                                            <span class="fs-5">{{ $Requisition->delivered_by }}</span>
                                            <span class="fs-5">{{ date('d M, Y',strtotime($Requisition->delivered_date))}}</span>
                                            @else
                                                <span class="fs-5">-------</span>
                                            @endif
                                        </div>



                                    </div>
                                    <!--end::Order details-->

                                    <hr>



                                    <!--begin:Order summary-->
                                    <div class="d-flex justify-content-between flex-column">

                                        <!--begin::Table -->
                                        <div class="table-responsive border-bottom mb-9">

                                            @if(!$ReqProduct->isEmpty())
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <thead>
                                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                                        <th class="min-w-20px pb-2">SL</th>
                                                        <th class="min-w-175px pb-2">Products</th>
                                                        @if($Requisition->status == 5 && auth()->user()->role == 5)
                                                            <th class="min-w-80px text-center pb-2">Available Quantity</th>
                                                        @endif
                                                        <th class="min-w-80px text-center pb-2">Requisition Quantity</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">

                                                    @foreach($ReqProduct as $key => $Product)
                                                        <tr>
                                                            <td class="text-start">{{ $key+1 }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ms-5">
                                                                        <div class="fw-bold">{{ $Product->product_name }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @if($Requisition->status == 5 && auth()->user()->role == 5)
                                                            <td class="text-center">{{ $Product->total_quantity }}</td>
                                                            @endif
                                                            <td class="text-center">{{ $Product->quantity }}</td>
                                                        </tr>
                                                    @endforeach

                                                    <tr class="d-none">
                                                        <td colspan="2" class="text-end">Subtotal</td>
                                                        <td class="text-end">$264.00</td>
                                                    </tr>
                                                    <!--end::Subtotal-->

                                                    </tbody>
                                                </table>
                                            @else

                                            @endif

                                        </div>



                                        @if($Requisition->status == 1 && auth()->user()->role == 3)
                                            <div class="col-md-4">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Date:</label>
                                                    <div class="col-sm-10">
                                                        <input id="RequisitionDate" type="date" class="form-control form-control-lg form-control-solid" name="requisition_date" value="{{date("Y-m-d")}}" placeholder="Date Set" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($Requisition->status == 2 && auth()->user()->role == 6)
                                            <div class="col-md-4">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Date:</label>
                                                    <div class="col-sm-10">
                                                        <input id="RequisitionDate" type="date" class="form-control form-control-lg form-control-solid" name="requisition_date" value="{{date("Y-m-d")}}" placeholder="Date Set" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($Requisition->status == 5 && auth()->user()->role == 5)
                                            <div class="col-md-4">
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Date:</label>
                                                    <div class="col-sm-10">
                                                        <input id="RequisitionDate" type="date" class="form-control form-control-lg form-control-solid" name="requisition_date" value="{{date("Y-m-d")}}" placeholder="Date Set" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        @endif



                                        <!--end::Table-->



                                        @if($Requisition->status == 1 && auth()->user()->role == 3)
                                            <div class="col-md-12">
                                                @if($Requisition->file)
                                                    <a href="/File/ReqFile/{{ $Requisition->file }}" download class="btn btn-sm fw-bold btn-success">Download File</a>
                                                @endif
                                                <a id="ApprovedBtnId" class="btn btn-sm fw-bold btn-success">Approved</a>
                                                <a id="CanceledBtnId" class="btn btn-sm fw-bold btn-danger">Canceled</a>
                                            </div>
                                        @elseif($Requisition->status == 2 && auth()->user()->role == 6)
                                            <div class="col-md-12">
                                                @if($Requisition->file)
                                                    <a href="/File/ReqFile/{{ $Requisition->file }}" download class="btn btn-sm fw-bold btn-success">Download File</a>
                                                @endif
                                                <a id="ApprovedConfirmBtnId" class="btn btn-sm fw-bold btn-success">Approved Confirm</a>
                                                <a id="CanceledBtnId" class="btn btn-sm fw-bold btn-danger">Canceled</a>
                                                <a id="EditBtnId" class="btn btn-sm fw-bold btn-primary">Edit</a>
                                            </div>
                                        @elseif($Requisition->status == 5 && auth()->user()->role == 5)
                                            <div class="col-md-12">
                                                @if($Requisition->file)
                                                    <a href="/File/ReqFile/{{ $Requisition->file }}" download class="btn btn-sm fw-bold btn-success">Download File</a>
                                                @endif
                                                <a id="DeliveredBtnId" class="btn btn-sm fw-bold btn-primary">Delivered</a>
                                            </div>

                                        @else
                                            <div class="col-md-12">
                                                @if($Requisition->file)
                                                    <a href="/File/ReqFile/{{ $Requisition->file }}" download class="btn btn-sm fw-bold btn-success">Download File</a>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                    <!--end:Order summary-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->


                            <!-- begin::Footer-->
                            <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13 d-none">
                                <!-- begin::Actions-->
                                <div class="my-1 me-5">
                                    <!-- begin::Pint-->
                                    <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
                                    <!-- end::Pint-->
                                    <!-- begin::Download-->
                                    <button type="button" class="btn btn-light-success my-1">Download</button>
                                    <!-- end::Download-->
                                </div>
                                <!-- end::Actions-->
                                <!-- begin::Action-->
                                <a href="#" class="btn btn-primary my-1">Create Invoice</a>
                                <!-- end::Action-->
                            </div>
                            <!-- end::Footer-->
                        </div>
                        <!-- end::Wrapper-->
                    </div>
                    <!-- end::Body-->
                </div>
                <!-- end::Invoice 1-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

@endsection


@section('script')
    <script>

        $('#ApprovedBtnId').click(function () {
            var RequisitionId = $('#RequisitionId').html();
            var RequisitionDate = $('#RequisitionDate').val();
            var UserId = $('#UserId').html();
            axios.post('/requisition-approved',{
                requisition_id:RequisitionId,
                approved_date:RequisitionDate,
                approved_by:UserId,
            }).then(function (response) {
                if (response.data == 1){
                    toastr.success("Requisition Approved Successfully Done !");
                    window.location.replace("/requisition-list");
                }else {
                    toastr.error("Please Check Your Approved Date !");
                }
            }).catch(function (error) {
                toastr.error("Something went to wrong ! try again");
            });
        });

        $('#CanceledBtnId').click(function () {
            var RequisitionId = $('#RequisitionId').html();
            var RequisitionDate = $('#RequisitionDate').val();
            var UserId = $('#UserId').html();
            axios.post('/requisition-canceled',{
                requisition_id:RequisitionId,
                canceled_date:RequisitionDate,
                canceled_by:UserId,
            }).then(function (response) {
                if (response.data == 1){
                    toastr.success("Requisition Canceled Successfully Done");
                    window.location.replace("/requisition-list");
                }else {
                    toastr.error("Please Check Your Canceled Date !");
                }

            }).catch(function (error) {
                toastr.error("Something went to wrong ! try again");
            });
        });


        $('#EditBtnId').click(function () {
            var RequisitionId = $('#RequisitionId').html();
            window.location.replace("/requisition-edit/"+RequisitionId);
        });



        $('#ApprovedConfirmBtnId').click(function () {
            var RequisitionId = $('#RequisitionId').html();
            var RequisitionDate = $('#RequisitionDate').val();
            var UserId = $('#UserId').html();
            axios.post('/requisition-approved-conf',{
                requisition_id:RequisitionId,
                approved_conf_date:RequisitionDate,
                approved_conf_by:UserId,
            }).then(function (response) {
                if (response.data == 1){
                    toastr.success("Approved Confirm Successfully Done");
                    window.location.replace("/requisition-list");
                }else {
                    toastr.error("Please Check Your Confirm Date !");
                }
            }).catch(function (error) {
                toastr.error("Something went to wrong ! try again");
            });
        });

        $('#DeliveredBtnId').click(function(){
            let RequisitionId = $('#RequisitionId').html();
            var RequisitionDate = $('#RequisitionDate').val();
            let UserId = $('#UserId').html();
            axios.post('/requisition-delivered',{
                requisition_id:RequisitionId,
                delivered_date:RequisitionDate,
                delivered_by:UserId,
            }).then(function (response) {
                if (response.data == 0){
                    toastr.warning("Product Not available, Please Purchase!");
                }else if (response.data == 2){
                    toastr.error("Please Check Your Delivered Date !");
                }else{
                    toastr.success("Requisition Delivered Successfully Done");
                    window.location.replace("/requisition-list");
                }
            }).catch(function (error) {
                toastr.success("Something went to wrong!");
            });
        });


        // $('#DeliveredBtnId').click(function(){
        //     let RequisitionId = $('#RequisitionId').html();
        //     let UserId = $('#UserId').html();
        //     axios.post('/requisition-delivered-check',{
        //         requisition_id:RequisitionId,
        //         user_id:UserId,
        //     }).then(function (response) {
        //         toastr.success("Requisition Delivered Successfully Done");
        //     }).catch(function (error) {
        //
        //     });
        // });

    </script>
@endsection

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
                                    <div class="fw-bold fs-2">{{ $Requisition->name }}
                                        <span class="fs-6">({{ $Requisition->email }})</span>,
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
                                            <span class="fs-5">{{ date('d M, Y',strtotime($Requisition->created_date))}}</span>
                                        </div>
                                        <div class="flex-root d-flex flex-column">
                                            <span class="text-muted">Department</span>
                                            <span class="fs-5">{{ $Requisition->department_name }}</span>
                                        </div>
                                    </div>
                                    <!--end::Order details-->


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
                                                        <th class="min-w-80px text-end pb-2">Quantity</th>
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
                                                            <td class="text-end">{{ $Product->quantity }}</td>
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
                                        <!--end::Table-->

                                        @if($Requisition->status == 2)
                                            <div class="col-md-12">
                                                <a id="DeliveredBtnId" class="btn btn-sm fw-bold btn-primary">Delivered</a>
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

        $('#DeliveredBtnId').click(function(){
            let RequisitionId = $('#RequisitionId').html();
            let UserId = $('#UserId').html();
            axios.post('/requisition-delivered',{
                requisition_id:RequisitionId,
                user_id:UserId,
            }).then(function (response) {
                toastr.success("Requisition Delivered Successfully Done");
                window.location.replace("/requisition-list");
            }).catch(function (error) {

            });
        });

    </script>
@endsection

@extends('Admin.Layout.main')

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <p id="RequisitionId" class="d-none">{{ request()->route('id') }}</p>
        <p id="UserId" class="d-none">{{ Auth::user()->id }}</p>
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
                                        <div class="table-responsive mb-8">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr>
                                                    <th class="min-w-175px">Product</th>
                                                    <th class="w-125px"></th>
                                                    <th class="w-60px"></th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody id="Req_Table">

                                                </tbody>
                                                <!--end::Table body-->
                                                <tfoot>
                                                <tr>
                                                    <td class="pe-0"><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 text-primary fs-6 me-1">Total Quantity</span></div></td>
                                                    <th id="TotalQuantity" class="w-125px text-center totalQuantity"></th>
                                                    <th class="w-60px"></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end:Order summary-->


                                    <div class="col-md-12">
                                        <a id="ApprovedBtnId" class="btn btn-sm fw-bold btn-primary">Approved</a>
                                        <a id="CanceledBtnId" class="btn btn-sm fw-bold btn-primary">Canceled</a>
                                    </div>

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

        ProductCartShow();
        function ProductCartShow(){
            var requisition_id = $('#RequisitionId').html();
            axios.post('/requisition-item-show',{
                requisition_id:requisition_id
            }).then(function (response) {
                if(response.status==200){
                    var JsonData = response.data;
                    var PurItem = 0;
                    var TotalQuantity = 0;
                    $('#Req_Table').empty();
                    $.each(JsonData, function (i, item) {

                        TotalQuantity = TotalQuantity + JsonData[i].quantity;
                        PurItem = PurItem + 1;
                        $('<tr data-kt-pos-element="item" data-kt-pos-item-price="33">').html(
                            '<td class="pe-0"><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6 me-1">'+JsonData[i].product_name+'</span></div></td>'+
                            '<td class="pe-0">'+
                            '<div class="position-relative d-flex align-items-center" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1" data-kt-dialer-decimals="0">'+
                            '<a type="button" data-id="'+JsonData[i].requisition_log_id+'" class="btn btn-icon btn-sm btn-light btn-icon-gray-400 ProductDBtn"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></a>'+
                            '<input id="ProductQ" type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="'+JsonData[i].quantity+'">'+
                            '<a type="button" data-id="'+JsonData[i].requisition_log_id+'" class="btn btn-icon btn-sm btn-light btn-icon-gray-400 ProductIBtn"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></a>'+
                            '</div>'+
                            '</td>'+
                            '<td class="text-end"><a type="button" data-id="'+JsonData[i].requisition_log_id+'" class="btn btn-sm btn-icon btn-active-color-primary ProductDeleteBtn"><span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path></svg></span></a></td>'
                        ).appendTo('#Req_Table');
                    });

                    $('#TotalQuantity').html(TotalQuantity);
                    $('#PurItem').html(PurItem);

                    $('.ProductDBtn').click(function () {
                        let requisition_log_id = $(this).data('id');
                        ProductQuantityDecrement(requisition_log_id);
                    });

                    $('.ProductIBtn').click(function () {
                        let requisition_log_id = $(this).data('id');
                        ProductQuantityIncrement(requisition_log_id);
                    });

                    //Areas Table Edit Icon Click
                    $('.ProductDeleteBtn').click(function () {
                        let requisition_log_id = $(this).data('id');
                        ProductCartDelete(requisition_log_id);
                    });

                    var Quantity = $('#TotalQuantity').html();
                    RequisitionTotalQuantityUpdate(Quantity);
                }
                else{
                    console.log("Network Problem !")
                }
            }).catch(function (error) {

            });
        }


        $('#ProductPAdd').click(function(){
            let product_id = $('#ProductId').val();
            let user_id = $('#UserId').val();
            axios.post('/product-purchase-cart',{
                product_id:product_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        });

        function ProductQuantityIncrement(Id) {
            axios.post('/req-update-quantity-increment',{
                requisition_log_id:Id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        function ProductQuantityDecrement(Id) {
            axios.post('/req-update-quantity-decrement',{
                requisition_log_id:Id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        function RequisitionTotalQuantityUpdate(Quantity) {
            var RequisitionId = $('#RequisitionId').html();
            axios.post('/req-total-quantity-update',{
                requisition_id:RequisitionId,
                total_quantity:Quantity,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        function ProductCartDelete(Id) {
            axios.post('/req-update-delete',{
                requisition_log_id:Id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }



        $('#PurchaseBtnId').click(function () {
            let total_quantity = $('#TotalQuantity').html();
            let supplier = $('#SupplierName').val();
            let memo_number = $('#MemoNumber').val();
            let note = $('#PurchaseNote').val();
            let creator = $('#UserId').val();
            let purItem = $('#PurItem').html();

            if (supplier.length == 0){
                toastr.warning("Supplier Name NoT Empty!");
            }else if(purItem == 0){
                toastr.warning("Please Some Product Add Now !");
            }else{
                axios.post('/product-purchase-add',{
                    total_quantity:total_quantity,
                    supplier:supplier,
                    memo_number:memo_number,
                    note:note,
                    creator:creator,
                }).then(function (response) {
                    toastr.success("Purchase Successfully Done");
                    ProductCartShow();
                    PurchaseFileEmpty();
                }).catch(function (error) {
                    toastr.error("Something went to wrong ! try again");
                });
            }
        });


        function PurchaseFileEmpty() {
            $('#SupplierName').val('');
            $('#MemoNumber').val('');
            $('#PurchaseNote').val('');
        }


        $('#ApprovedBtnId').click(function () {
            var RequisitionId = $('#RequisitionId').html();
            var UserId = $('#UserId').html();
            axios.post('/requisition-approved',{
                requisition_id:RequisitionId,
                approved_by:UserId,
            }).then(function (response) {
                toastr.success("Requisition Approved Successfully Done");
                window.location.replace("/requisition-list");
            }).catch(function (error) {
                toastr.error("Something went to wrong ! try again");
            });
        });

        $('#CanceledBtnId').click(function () {
            var RequisitionId = $('#RequisitionId').html();
            var UserId = $('#UserId').html();
            axios.post('/requisition-canceled',{
                requisition_id:RequisitionId,
                user_id:UserId,
            }).then(function (response) {
                toastr.success("Requisition Canceled Successfully Done");
                window.location.replace("/requisition-list");
            }).catch(function (error) {
                toastr.error("Something went to wrong ! try again");
            });
        });




        // $('#ProductPAdd').click(function(){
        //     let product_id = $('#ProductId').val();
        //     axios.post('/product-details',{product_id:product_id})
        //         .then(function (response) {
        //             let Data = response.data;
        //             $('<tr data-kt-pos-element="item" data-kt-pos-item-price="33">').html(
        //                 '<td class="pe-0"><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6 me-1">'+Data.product_name+'</span></div></td>'+
        //                 '<td class="pe-0">'+
        //                 '<div class="position-relative d-flex align-items-center" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1" data-kt-dialer-decimals="0">'+
        //                 '<button id="ProductDBtn'+Data.product_id+'" type="button" class="btn btn-icon btn-sm btn-light btn-icon-gray-400"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></button>'+
        //                 '<input id="ProductQ'+Data.product_id+'" type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="2">'+
        //                 '<button id="ProductIBtn'+Data.product_id+'" type="button" class="btn btn-icon btn-sm btn-light btn-icon-gray-400"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></button>'+
        //                 '</div>'+
        //                 '</td>'+
        //                 '<td class="text-end"><button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-kt-element="remove-item"><span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path></svg></span></button></td>'
        //             ).appendTo('#Pus_Table');
        //         }).catch(function (error) {
        //     });
        // });


    </script>
@endsection

@extends('Admin.Layout.main')

@section('content')


    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <input id="UserId" type="text" class="d-none" value="{{ Auth::user()->id }}">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product Purchase</h1>
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
                        <li class="breadcrumb-item text-muted">Product Purchase</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->



                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="/purchase-list" class="btn btn-sm fw-bold btn-primary">Purchase List</a>
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
                <div class="row">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{--                            <div class="mb-3">{!! DNS2D::getBarcodeHTML('Anupam Talukdar', 'QRCODE') !!}</div>--}}
                            <div class="separator"></div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Supplier Name</span>
                                        </label>
                                        <input id="SupplierName" type="text" class="form-control form-control-lg form-control-solid" name="purchase_name" placeholder="Supplier Name">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Memo Number</span>
                                        </label>
                                        <input id="MemoNumber" type="text" class="form-control form-control-lg form-control-solid" name="purchase_name" placeholder="Memo Number" value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Date</span>
                                        </label>
                                        <input id="PurchaseDate" type="date" class="form-control form-control-lg form-control-solid" name="purchase_date" value="{{date("Y-m-d")}}" placeholder="Date Set" value="">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Product Name</span>
                                        </label>

                                        <select id="ProductId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Product" class="form-control form-control-lg form-control-solid" required>
                                            <option value="">Select Product</option>
                                            @if(!$Product->isEmpty())
                                                @foreach($Product as $ProductItem)
                                                    <option value="{{ $ProductItem->product_id }}">{{ $ProductItem->product_id }}-{{ $ProductItem->product_name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="invisible">Add</span>
                                        </label>
                                        <a id="ProductPAdd" class="btn btn-sm fw-bold btn-primary">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>



                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body">
                            <div class="row justify-content-center">

                                <div class="col-md-12">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Product Name</span>
                                        </label>

                                        <div class="table-responsive mb-8">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr>
                                                    <th class="min-w-175px"></th>
                                                    <th class="w-125px"></th>
                                                    <th class="w-60px"></th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody id="Pus_Table">

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

                                        <p id="PurItem" class="d-none"></p>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Purchase Note</span>
                                        </label>
                                        <textarea id="PurchaseNote" class="form-control form-control form-control-solid" placeholder="Purchase Note..." data-kt-autosize="true"></textarea>
                                    </div>
                                    <a id="PurchaseBtnId" class="btn btn-sm fw-bold btn-primary">Purchase</a>
                                </div>

                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content table -->
    </div>
    <!--end::Content wrapper-->

@endsection


@section('script')
    <script>

        ProductCartShow();
        function ProductCartShow(){
            axios.get('/product-purchase-cart-show').then(function (response) {
                if(response.status==200){
                    var JsonData = response.data;
                    var PurItem = 0;
                    var TotalQuantity = 0;
                    $('#Pus_Table').empty();
                    $.each(JsonData, function (i, item) {

                        TotalQuantity = TotalQuantity + JsonData[i].quantity;
                        PurItem = PurItem + 1;
                        $('<tr data-kt-pos-element="item" data-kt-pos-item-price="33">').html(
                            '<td class="pe-0"><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-6 me-1">'+JsonData[i].product_name+'</span></div></td>'+
                            '<td class="pe-0">'+
                            '<div class="position-relative d-flex align-items-center" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1" data-kt-dialer-decimals="0">'+
                            '<a type="button" data-id="'+JsonData[i].purchase_cart_id+'" class="btn btn-icon btn-sm btn-light btn-icon-gray-400 ProductDBtn"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></a>'+
                            '<input id="ProductQ" type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="'+JsonData[i].quantity+'">'+
                            '<a type="button" data-id="'+JsonData[i].purchase_cart_id+'" class="btn btn-icon btn-sm btn-light btn-icon-gray-400 ProductIBtn"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></a>'+
                            '</div>'+
                            '</td>'+
                            '<td class="text-end"><a type="button" data-id="'+JsonData[i].purchase_cart_id+'" class="btn btn-sm btn-icon btn-active-color-primary ProductDeleteBtn"><span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path></svg></span></a></td>'
                        ).appendTo('#Pus_Table');
                    });

                    $('#TotalQuantity').html(TotalQuantity);
                    $('#PurItem').html(PurItem);




                    $('.ProductDBtn').click(function () {
                        let purchase_cart_id = $(this).data('id');
                        ProductQuantityDecrement(purchase_cart_id);
                    });

                    $('.ProductIBtn').click(function () {
                        let purchase_cart_id = $(this).data('id');
                        ProductQuantityIncrement(purchase_cart_id);
                    });

                    //Areas Table Edit Icon Click
                    $('.ProductDeleteBtn').click(function () {
                        let purchase_cart_id = $(this).data('id');
                        ProductCartDelete(purchase_cart_id);
                    });

                }else{
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
                user_id:user_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        });

        function ProductQuantityIncrement(Id) {
            let user_id = $('#UserId').val();
            axios.post('/product-quantity-increment',{
                purchase_cart_id:Id,
                user_id:user_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        function ProductQuantityDecrement(Id) {
            let user_id = $('#UserId').val();
            axios.post('/product-quantity-decrement',{
                purchase_cart_id:Id,
                user_id:user_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        function ProductCartDelete(Id) {
            let user_id = $('#UserId').val();
            axios.post('/product-cart-delete',{
                purchase_cart_id:Id,
                user_id:user_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }



        $('#PurchaseBtnId').click(function () {
            let total_quantity = $('#TotalQuantity').html();
            let supplier = $('#SupplierName').val();
            let memo_number = $('#MemoNumber').val();
            let purchase_date = $('#PurchaseDate').val();
            let note = $('#PurchaseNote').val();
            let creator = $('#UserId').val();
            let purItem = $('#PurItem').html();

            if (supplier.length == 0){
                toastr.warning("Supplier Name NoT Empty!");
            }else if (purchase_date.length == 0){
                toastr.warning("Purchase Date NoT Empty!");
            }else if(purItem == 0){
                toastr.warning("Please Some Product Add Now !");
            }else{
                axios.post('/product-purchase-add',{
                    total_quantity:total_quantity,
                    supplier:supplier,
                    memo_number:memo_number,
                    purchase_date:purchase_date,
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

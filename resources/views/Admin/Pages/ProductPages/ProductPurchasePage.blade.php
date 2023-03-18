@extends('Admin.Layout.main')

@section('content')


    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <input id="UserId" type="text" class="hidden" value="{{ Auth::user()->id }}">
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
                    <div class="m-0">
                        <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                            </svg>
                        </span>Filter</a>
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_63de6bfc33b19">
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                            </div>
                            <div class="separator border-gray-200"></div>
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fw-semibold">Email:</label>
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_63de6bfc33b19" data-allow-clear="true">
                                            <option>Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fw-semibold">Status:</label>
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_63de6bfc33b19" data-allow-clear="true">
                                            <option>Select Status</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->


                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </div>
                    </div>
                    <a href="/product-log-list" class="btn btn-sm fw-bold btn-primary">Product Log</a>
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
                                <div class="col-md-6">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Purchase Name</span>
                                        </label>
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="purchase_name" placeholder="Purchase Name" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Memo Number</span>
                                        </label>
                                        <input type="text" class="form-control form-control-lg form-control-solid" name="purchase_name" placeholder="Memo Number" value="">
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
                            <div class="row">


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
                                            </table>
                                            <!--end::Table-->
                                        </div>

                                    </div>
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
                    $('#Pus_Table').empty();
                    $.each(JsonData, function (i, item) {
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

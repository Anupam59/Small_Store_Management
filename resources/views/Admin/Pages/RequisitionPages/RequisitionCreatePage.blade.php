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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product Requisition</h1>
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
                        <li class="breadcrumb-item text-muted">Product Requisition</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->


                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="/requisition-list" class="btn btn-sm fw-bold btn-primary">Requisition List</a>
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
                                            <span class="required">Department</span>
                                        </label>

                                        <select id="DepartmentId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Department" class="form-control form-control-lg form-control-solid">
                                            <option value=" " selected>Select Department</option>
                                            @if(!$Department->isEmpty())
                                                @foreach($Department as $DepartmentItem)
                                                    <option value="{{ $DepartmentItem->department_id }}"> {{ $DepartmentItem->department_name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Store</span>
                                        </label>

                                        <select id="StoreId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Store" class="form-control form-control-lg form-control-solid">
                                            <option value=" " selected>Select Store</option>
                                            @if(!$Store->isEmpty())
                                                @foreach($Store as $StoreItem)
                                                    <option value="{{ $StoreItem->store_id }}"> {{ $StoreItem->store_name }}</option>
                                                @endforeach
                                            @else

                                            @endif
                                        </select>
                                    </div>
                                </div>




                                <div class="col-md-4">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Date</span>
                                        </label>

                                        <input id="RequisitionDate" type="date" class="form-control form-control-lg form-control-solid" name="requisition_date" value="{{date("Y-m-d")}}" placeholder="Date Set" value="">

                                    </div>
                                </div>



                            </div>
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="invisible">Add</span>
                                        </label>
                                        <a id="NewProductAddId" class="btn btn-sm fw-bold btn-primary">Add New Product</a>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span class="required">Product Name</span>
                                        </label>

                                        <select id="ProductId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Product" class="form-control form-control-lg form-control-solid" required>
                                            <option value=" " selected>Select Product</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
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
                                        <div class="table-responsive mb-8">
                                            <!--begin::Table-->
                                            <table class="table align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="fw-semibold fs-5">
                                                    <th>Product Name</th>
{{--                                                    <th>Total Quantity</th>--}}
                                                    <th></th>
                                                    <th>Quantity</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody id="Pus_Table">

                                                </tbody>
                                                <!--end::Table body-->
                                                <tfoot>
                                                <tr>
                                                    <td><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 text-primary fs-6 me-1">Total Quantity</span></div></td>
                                                    <th></th>
                                                    <th id="TotalQuantity" class="w-125px text-center totalQuantity"></th>
                                                    <th></th>
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
                                            <span>Requisition Note</span>
                                        </label>
                                        <textarea id="RequisitionNote" class="form-control form-control form-control-solid" placeholder="Requisition Note..." data-kt-autosize="true"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="fv-row mb-5 fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                            <span>Requisition File</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" id="RequisitionFileNameId" placeholder="File Name --"/>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="file" id="RequisitionFileId" accept="application/pdf, application/vnd.ms-excel"/>
                                            </div>
                                        </div>


                                    </div>
                                    <a id="RequisitionBtnId" class="btn btn-sm fw-bold btn-primary">Requisition</a>
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




    <!--begin::Modal - Create Api Key-->
    <div class="modal fade" id="ProductAddModal">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_create_api_key_header">
                    <!--begin::Modal title-->
                    <h2>Create API Key</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->

                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="fv-row mb-5 fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Product Name</span>
                                    </label>
                                    <input type="text" class="form-control form-control-lg form-control-solid" id="AddProductId" placeholder="" value="" required="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fv-row mb-5 fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Category</span>
                                    </label>

                                    <select id="AddCategoryId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Store" class="form-control form-control-lg form-control-solid">
                                        <option value=" " selected>Select Store</option>
                                        @if(!$Category->isEmpty())
                                            @foreach($Category as $CategoryItem)
                                                <option value="{{ $CategoryItem->category_id }}"> {{ $CategoryItem->category_name }}</option>
                                            @endforeach
                                        @else

                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fv-row mb-5 fv-plugins-icon-container">
                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Store</span>
                                    </label>

                                    <select id="AddStoreId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Store" class="form-control form-control-lg form-control-solid">
                                        <option value=" " selected>Select Store</option>
                                        @if(!$Store->isEmpty())
                                            @foreach($Store as $StoreItem)
                                                <option value="{{ $StoreItem->store_id }}"> {{ $StoreItem->store_name }}</option>
                                            @endforeach
                                        @else

                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fv-row mb-5 fv-plugins-icon-container">

                                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                        <span class="required">Unit</span>
                                    </label>

                                    <select id="AddUnitId" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Store" class="form-control form-control-lg form-control-solid">
                                        <option value=" " selected>Select Store</option>
                                        @if(!$Unit->isEmpty())
                                            @foreach($Unit as $UnitItem)
                                                <option value="{{ $UnitItem->unite_id }}"> {{ $UnitItem->unite_name }}</option>
                                            @endforeach
                                        @else

                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Modal body-->

                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button id="ProductAddBtnId" class="btn btn-primary">
                            <span class="indicator-label">Add</span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->

            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Api Key-->


@endsection


@section('script')
    <script>

        ProductCartShow();
        function ProductCartShow(){
            axios.get('/product-requisition-cart-show').then(function (response) {
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
                            // '<td class="pe-0"><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 text-hover-primary fs-6 me-1">'+JsonData[i].total_quantity+'</span></div></td>'+
                            '<td class="pe-0"><div class="d-flex align-items-center"><span class="fw-bold text-gray-800 text-hover-primary fs-6 me-1"></span></div></td>'+
                            '<td class="pe-0">'+
                            '<div class="position-relative d-flex align-items-center" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1" data-kt-dialer-decimals="0">'+
                            '<a type="button"  data-total="'+JsonData[i].total_quantity+'"  data-id="'+JsonData[i].requisition_cart_id+'" class="btn btn-icon btn-sm btn-light btn-icon-gray-400 ProductDBtn"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></a>'+
                            '<input id="ProductQ" type="text" class="form-control border-0 text-center px-0 fs-3 fw-bold text-gray-800 w-30px" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="'+JsonData[i].quantity+'">'+
                            '<a type="button" data-quantity="'+JsonData[i].quantity+'"  data-total="'+JsonData[i].total_quantity+'"  data-id="'+JsonData[i].requisition_cart_id+'" class="btn btn-icon btn-sm btn-light btn-icon-gray-400 ProductIBtn"><span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect><rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect></svg></span></a>'+
                            '</div>'+
                            '</td>'+
                            '<td class="text-end"><a type="button" data-id="'+JsonData[i].requisition_cart_id+'" class="btn btn-sm btn-icon btn-active-color-primary ProductDeleteBtn"><span class="svg-icon svg-icon-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path><path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path><path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path></svg></span></a></td>'
                        ).appendTo('#Pus_Table');
                    });

                    $('#TotalQuantity').html(TotalQuantity);
                    $('#PurItem').html(PurItem);


                    $('.ProductDBtn').click(function () {
                        let requisition_cart_id = $(this).data('id');
                        let total_quantity = $(this).data('total');
                        ProductQuantityDecrement(requisition_cart_id);
                    });

                    $('.ProductIBtn').click(function () {
                        let requisition_cart_id = $(this).data('id');
                        let total_quantity = $(this).data('total');
                        let quantity = $(this).data('quantity');
                        ProductQuantityIncrement(requisition_cart_id);

                        // if (total_quantity > quantity){
                        //     ProductQuantityIncrement(requisition_cart_id);
                        // }else{
                        //     toastr.warning("Product Quantity Over!");
                        // }

                    });

                    //Areas Table Edit Icon Click
                    $('.ProductDeleteBtn').click(function () {
                        let requisition_cart_id = $(this).data('id');
                        ProductCartDelete(requisition_cart_id);
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
            axios.post('/product-requisition-cart',{
                product_id:product_id,
                user_id:user_id,
            }).then(function (response) {
                if (response.data == 3){
                    toastr.warning("Product Quantity Empty!");
                }else {
                    ProductCartShow();
                }

            }).catch(function (error) {

            });
        });

        function ProductQuantityIncrement(Id) {
            let user_id = $('#UserId').val();
            axios.post('/requisition-quantity-increment',{
                requisition_cart_id:Id,
                user_id:user_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        function ProductQuantityDecrement(Id) {
            let user_id = $('#UserId').val();
            axios.post('/requisition-quantity-decrement',{
                requisition_cart_id:Id,
                user_id:user_id,
            }).then(function (response) {
                if(response.data == 0){
                    toastr.warning("Product Quantity Minimum One!");
                }else{
                    ProductCartShow();
                }
            }).catch(function (error) {
                toastr.warning("Something went to wrong!");
            });
        }

        function ProductCartDelete(Id) {
            let user_id = $('#UserId').val();
            axios.post('/requisition-cart-delete',{
                requisition_cart_id:Id,
                user_id:user_id,
            }).then(function (response) {
                ProductCartShow();
            }).catch(function (error) {

            });
        }

        $('#RequisitionBtnId').click(function () {
            let total_quantity = $('#TotalQuantity').html();
            let department_id = $('#DepartmentId').val();
            let store_id = $('#StoreId').val();
            let requisition_date = $('#RequisitionDate').val();
            let note = $('#RequisitionNote').val();
            let file_name = $('#RequisitionFileNameId').val();
            let file = $('#RequisitionFileId').prop('files')[0];
            let creator = $('#UserId').val();
            let purItem = $('#PurItem').html();

            if (department_id == " "){
                toastr.warning("Department Id NoT Empty!");
            }
            else if(store_id == " "){
                toastr.warning("Store Id NoT Empty!");
            }
            else if(purItem == 0){
                toastr.warning("Please Some Product Add Now !");
            }else{


                let formData=new FormData();
                formData.append('total_quantity',total_quantity);
                formData.append('department_id',department_id);
                formData.append('store_id',store_id);
                formData.append('requisition_date',requisition_date);
                formData.append('note',note);
                formData.append('file_name',file_name);
                formData.append('file',file);
                formData.append('creator',creator);

                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                };

                axios.post('/product-requisition-add',formData,config).then(function (response) {
                    toastr.success("Requisition Successfully Done");
                    ProductCartShow();
                    RequisitionFileEmpty();
                }).catch(function (error) {
                    toastr.error("Something went to wrong ! try again");
                });
            }
        });

        function RequisitionFileEmpty() {
            $('#DepartmentId').val(' ');
            $('#StoreId').val(' ');
            $('#ProductId').val('');
            $('#RequisitionNote').val('');
        }

        $('#StoreId').change(function(){
            let store_id = $('#StoreId').val();
            axios.post('/requisition-product',{
                store_id:store_id,
            }).then(function (response) {
                var JsonData = response.data;
                $('#ProductId').empty();
                $('#ProductId').append( JsonData );
                ProductCartShow();
            }).catch(function (error) {

            });
        });


        $('#NewProductAddId').click(function () {
            modelEmpty();
            $('#ProductAddModal').modal("show");
        });

        $('#ProductAddBtnId').click(function () {
            let product_name = $('#AddProductId').val();
            let category_id = $('#AddCategoryId').val();
            let store_id = $('#AddStoreId').val();
            let unite_id = $('#AddUnitId').val();
            AddProduct(product_name,category_id,store_id,unite_id);
        });

        function AddProduct(product_name,category_id,store_id,unite_id) {
           if (product_name.length <=2 ){
               toastr.warning("Product Is Empty !");
           }
           else if(category_id == " "){
               toastr.warning("Category Is Empty !");
           }
           else if(store_id == " "){
               toastr.warning("Store Is Empty !");
           }
           else if(unite_id == " "){
               toastr.warning("Unit Is Empty !");
           }else{
               axios.post('/add-product-requisition',{
                   product_name:product_name,
                   store_id:store_id,
                   category_id:category_id,
                   unite_id:unite_id,
               }).then(function (response) {
                  if (response.status == 200){
                      toastr.success("Product add Successfully !");
                      $('#ProductAddModal').modal("hide");
                      modelEmpty();
                  }
               }).catch(function (error) {
                   if (error.response.data.errors){
                       if (error.response.data.errors.product_name) {
                           toastr.error("Already Available This Product");
                       }else{
                           toastr.error("Something went to wrong");
                           $('#ProductAddModal').modal("hide");
                           modelEmpty();
                       }
                   }else {
                       toastr.error("Something went to wrong");
                       $('#ProductAddModal').modal("hide");
                       modelEmpty();
                   }

               });
           }

        }

        function modelEmpty(){
            $('#AddProductId').val('');
            $('#AddCategoryId').val(" ").trigger('change');
            $('#AddStoreId').val(" ").trigger('change');
            $('#AddUnitId').val(" ").trigger('change');
        }

    </script>
@endsection

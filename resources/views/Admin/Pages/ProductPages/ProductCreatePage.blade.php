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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product Create</h1>
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
                        <li class="breadcrumb-item text-muted">Product Create</li>
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
                    <a href="/product-list" class="btn btn-sm fw-bold btn-primary">Product List</a>
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


                            <form action="{{ route('product.entry')}}" method="post" class="form" enctype="multipart/form-data">
                                @csrf
                                <div class="separator"></div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Product Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="product_name" placeholder="" value="" required>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Initial Quantity</span>
                                            </label>
                                            <input type="number" class="form-control form-control-lg form-control-solid" name="quantity" placeholder="" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Reference</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="reference" placeholder="" value="" required>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Category</span>
                                            </label>
                                            <select name="category_id" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Category" class="form-control form-control-lg form-control-solid" required>
                                                <option value="">Select Category</option>
                                                @if(!$Category->isEmpty())
                                                    @foreach($Category as $CatItem)
                                                        <option value="{{ $CatItem->category_id }}">{{ $CatItem->category_name }}</option>
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
                                            <select name="store_id" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Store" class="form-control form-control-lg form-control-solid" required>
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


                                    <div class="col-md-4">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Unite</span>
                                            </label>
                                            <select name="unite_id" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Unite" class="form-control form-control-lg form-control-solid" required>
                                                <option value="">Select Unite</option>
                                                @if(!$Unite->isEmpty())
                                                    @foreach($Unite as $UniteItem)
                                                        <option value="{{ $UniteItem->unite_id }}">{{ $UniteItem->unite_name }}</option>
                                                    @endforeach
                                                @else

                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="separator"></div>
                                <input type="hidden" value="{{ Auth::user()->id }}" name="creator">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </form>
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

    </script>
@endsection

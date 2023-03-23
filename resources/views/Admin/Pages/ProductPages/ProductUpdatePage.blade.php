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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product Update</h1>
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
                        <li class="breadcrumb-item text-muted">Product Update</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->



                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
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


                                <form action="{{ url('/product-update/'.$Product->product_id)}}" method="post" class="form" enctype="multipart/form-data">
                                @csrf
                                <div class="separator"></div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Product Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="product_name" placeholder="" value="{{ $Product->product_name }}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Status</span>
                                            </label>
                                            <select name="status" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Role" class="form-control form-control-lg form-control-solid" required>
                                                <option value="1" @if($Product->status == "1") {{ 'selected' }} @endif>Active</option>
                                                <option value="2" @if($Product->status == "2") {{ 'selected' }} @endif>Inactive</option>
                                            </select>
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
                                                        <option value="{{ $CatItem->category_id }}" @if($CatItem->category_id == $Product->category_id) {{ 'selected' }} @endif>{{ $CatItem->category_name }}</option>
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
                                                        <option value="{{ $StoreItem->store_id }}" @if($StoreItem->store_id == $Product->store_id) {{ 'selected' }} @endif>{{ $StoreItem->store_name }}</option>
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
                                                        <option value="{{ $UniteItem->unite_id }}" @if($UniteItem->unite_id == $Product->unite_id) {{ 'selected' }} @endif>{{ $UniteItem->unite_name }}</option>
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
                                        <button type="submit" class="btn btn-primary">Update</button>
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

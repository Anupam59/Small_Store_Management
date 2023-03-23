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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->

                </div>
                <!--end::Page title-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->


        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <div class="row">

                    <div class="col-md-4">
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pb-0">
                                <div class="align-items-center mb-5">
                                    <div class="align-items-center flex-grow-1">
                                        <p class="text-gray-900 text-center fs-1 fw-bold">{{ $Department }}</p>
                                        <p class="text-gray-400 text-center fw-bold">Total Department</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pb-0">
                                <div class="align-items-center mb-5">
                                    <div class="align-items-center flex-grow-1">
                                        <p class="text-gray-900 text-center fs-1 fw-bold">{{ $Category }}</p>
                                        <p class="text-gray-400 text-center fw-bold">Total Category</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pb-0">
                                <div class="align-items-center mb-5">
                                    <div class="align-items-center flex-grow-1">
                                        <p class="text-gray-900 text-center fs-1 fw-bold">{{ $Store }}</p>
                                        <p class="text-gray-400 text-center fw-bold">Total Store</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pb-0">
                                <div class="align-items-center mb-5">
                                    <div class="align-items-center flex-grow-1">
                                        <p class="text-gray-900 text-center fs-1 fw-bold">{{ $Unite }}</p>
                                        <p class="text-gray-400 text-center fw-bold">Total Unit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pb-0">
                                <div class="align-items-center mb-5">
                                    <div class="align-items-center flex-grow-1">
                                        <p class="text-gray-900 text-center fs-1 fw-bold">{{ $Product }}</p>
                                        <p class="text-gray-400 text-center fw-bold">Total Product</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-5 mb-xxl-8">
                            <div class="card-body pb-0">
                                <div class="align-items-center mb-5">
                                    <div class="align-items-center flex-grow-1">
                                        <p class="text-gray-900 text-center fs-1 fw-bold">{{ $ProductStock }}</p>
                                        <p class="text-gray-400 text-center fw-bold">Total Stock</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!--end::Content wrapper-->

@endsection

@section('script')
    <script>

    </script>
@endsection

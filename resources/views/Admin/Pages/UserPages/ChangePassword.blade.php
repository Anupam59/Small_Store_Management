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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Users Password Reset</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">User</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Reset</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->




                <!--begin::Actions  Filter-->
                @if(auth()->user()->role <=2)
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="/user-list" class="btn btn-sm fw-bold btn-primary">User List</a>
                </div>
                @endif
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


                            @if (session('success_message'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('success_message') }}
                                </div>
                            @elseif (session('error_message'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('error_message') }}
                                </div>
                            @else

                            @endif



                            <form action="{{ url('/user-passreset')}}" method="post" class="form" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Old Password</span>
                                            </label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="old_password" placeholder="" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">New Password</span>
                                            </label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password" placeholder="" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Confirm Password</span>
                                            </label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="confiem_password" placeholder="" value="" required>
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" value="{{ Auth::user()->id }}" name="creator">


                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
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



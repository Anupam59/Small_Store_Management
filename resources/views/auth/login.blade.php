@extends('layout.authMain')

@section('content')

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">

                        @if($message = Session::get('success'))
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endif

                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" action="{{ route('sample.validate_login') }}" method="post">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3" style="font-variant: small-caps; font-size: 30px;">Stock Register of Divisional Commissioner's Office, Sylhet</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Sign in to continue. </div>
                            </div>


                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Enter Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="fv-row mb-8">
                                <input type="password" placeholder="Enter Password" name="password" autocomplete="off" class="form-control bg-transparent" />
                                @if($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>


                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8 d-none">
                                <div></div>
                                <!--begin::Link-->
                                <a href="{{ route('forget.password.get') }}" class="link-primary">Forgot Password ?</a>
                                <!--end::Link-->
                            </div>


                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Sign In</span>
                                </button>

                            </div>
                            <!--end::Submit button-->
                        </form>
                    </div>
                </div>
                <!--end::Form-->
            </div>
            <!--end::Body-->


            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-color: #fff2f5">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    <a href="#" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ asset('images/sr-logo.png') }}" class="h-60px h-lg-75px" />
                    </a>
                    <!--end::Logo-->


                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20 rounded" src="{{ asset('Images/cover-sr.jpg') }}"  />
                    <!--end::Image-->

                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->


@endsection





{{--<div class="row justify-content-center">--}}
{{--    <div class="col-md-4">--}}
{{--        <div class="card">--}}
{{--            <div class="card-header">Login</div>--}}
{{--            <div class="card-body">--}}
{{--                <form action="{{ route('sample.validate_login') }}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group mb-3">--}}
{{--                        <input type="text" name="email" class="form-control" placeholder="Email" />--}}
{{--                        @if($errors->has('email'))--}}
{{--                            <span class="text-danger">{{ $errors->first('email') }}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group mb-3">--}}
{{--                        <input type="password" name="password" class="form-control" placeholder="Password" />--}}
{{--                        @if($errors->has('password'))--}}
{{--                            <span class="text-danger">{{ $errors->first('password') }}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="form-group row d-none">--}}
{{--                        <div class="col-md-6 offset-md-4">--}}
{{--                            <div class="checkbox">--}}
{{--                                <label>--}}
{{--                                    <a href="{{ route('forget.password.get') }}">Reset Password</a>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="d-grid mx-auto">--}}
{{--                        <button type="subit" class="btn btn-dark btn-block">Login</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




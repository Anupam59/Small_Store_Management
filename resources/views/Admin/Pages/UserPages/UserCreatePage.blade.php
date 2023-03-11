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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Users List</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">User</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">User List</li>
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
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
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


                    <a href="/user-list" class="btn btn-sm fw-bold btn-primary">User List</a>

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

                            <form action="{{ route('user.entry')}}" method="post" class="form" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-center flex-column py-5">
                                    <div class="mb-1">

                                        <!--begin::Image input wrapper-->
                                        <div class="mt-1">
                                            <!--begin::Image placeholder-->
                                            <style>.image-input-placeholder { background-image: url({{asset('Admin/assets/media/svg/files/blank-image.svg')}}); }</style>
                                            <!--end::Image placeholder-->
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty" data-kt-image-input="true">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-100px h-100px"></div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Edit-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="user_image" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Edit-->

                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                                <!--end::Cancel-->

                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                                <!--end::Remove-->

                                            </div>
                                            <!--end::Image input-->
                                        </div>
                                        <!--end::Image input wrapper-->

                                    </div>
                                </div>

                                <div class="separator"></div>
                                <!--begin::Details content-->

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="" value="{{old('name')}}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Designation</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="designation" placeholder="" value="{{old('designation')}}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Username</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="username" placeholder="" value="{{old('username')}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Number</span>
                                            </label>
                                            <input type="tel" class="form-control form-control-lg form-control-solid" name="number" placeholder="" value="{{old('number')}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Email</span>
                                            </label>
                                            <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="" value="{{old('email')}}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Role</span>
                                            </label>
                                            <select id="UserRoleId" name="role" value="{{old('role')}}" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Role" class="form-control form-control-lg form-control-solid" required>
                                                <option value="1">Super Admin</option>
                                                <option value="2">Admin</option>
                                                <option value="3">Department Admin</option>
                                                <option value="4">Department AO</option>
                                                <option value="5">Store Manager</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div id="DepartmentAdmin" class="col-md-12 d-none">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-3">
                                                <span class="">Department Admin</span>
                                            </label>
                                            <div class="row">

                                                @if(!$Department->isEmpty())
                                                    @foreach($Department as $DeptItem)
                                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input" type="checkbox" name="dept_admin[]" value="{{$DeptItem->department_id}}">
                                                                <span class="form-check-label">{{ $DeptItem->department_name }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-12">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <span class="form-check-label">Data Not Found !</span>
                                                        </label>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>


                                    <div id="DepartmentAO" class="col-md-12 d-none">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-3">
                                                <span class="">Department AO</span>
                                            </label>
                                            <div class="row">

                                                @if(!$Department->isEmpty())
                                                    @foreach($Department as $DeptItem)
                                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input" type="checkbox" name="dept_ao[]" value="{{ $DeptItem->department_id }}">
                                                                <span class="form-check-label">{{ $DeptItem->department_name }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-12">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <span class="form-check-label">Data Not Found !</span>
                                                        </label>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>


                                    <div id="StoreManager" class="col-md-12 d-none">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-3">
                                                <span class="">Store Manager</span>
                                            </label>
                                            <div class="row">

                                                @if(!$Store->isEmpty())
                                                    @foreach($Store as $StoreItem)
                                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input" type="checkbox" name="store_manager[]" value="{{ $StoreItem->store_id }}">
                                                                <span class="form-check-label">{{ $StoreItem->store_name }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-12">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <span class="form-check-label">Data Not Found !</span>
                                                        </label>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Password</span>
                                            </label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password" placeholder="" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
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

        function RoleChange(roleId){
            if(roleId == 3){
                $('#DepartmentAdmin').removeClass('d-none');
                $('#DepartmentAO').addClass('d-none');
                $('#StoreManager').addClass('d-none');
            }else if(roleId == 4){
                $('#DepartmentAdmin').addClass('d-none');
                $('#DepartmentAO').removeClass('d-none');
                $('#StoreManager').addClass('d-none');
            }else if(roleId == 5){
                $('#DepartmentAdmin').addClass('d-none');
                $('#DepartmentAO').addClass('d-none');
                $('#StoreManager').removeClass('d-none');
            }else{
                $('#DepartmentAdmin').addClass('d-none');
                $('#DepartmentAO').addClass('d-none');
                $('#StoreManager').addClass('d-none');
            }
        }

        $('#UserRoleId').on('change',function (e){
            var roleId = e.target.value;
            RoleChange(roleId);
        });

    </script>
@endsection

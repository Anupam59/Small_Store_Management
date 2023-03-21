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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">User Update</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/user-list" class="text-muted text-hover-primary">User</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">User Update</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
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

                            <form action="{{url('/user-update/'.$Users->id)}}" method="post" class="form" enctype="multipart/form-data">
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
                                                <div class="image-input-wrapper w-100px h-100px" style="background-image: url({{ asset('Images/Users/'.$Users->user_image) }})"></div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Edit-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" value="" name="user_image" accept=".png, .jpg, .jpeg" />
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
                                        <a id="UserImageDelete"><i class="fa-solid fa-trash text-danger deleteIcon d-none"></i></a>
{{--                                        <input name="old_user_image" type="hidden" value="{{ asset('Images/Users/'.$Users->user_image) }}">--}}
                                    </div>
                                </div>

                                <div class="separator"></div>
                                <!--begin::Details content-->

                                <div class="row">

                                    <p id="UserId" class="d-none">{{ $Users->id }}</p>

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="" value="{{ $Users->name }}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Designation</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="designation" placeholder="" value="{{ $Users->designation }}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Username</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="username" placeholder="" value="{{ $Users->username }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Number</span>
                                            </label>
                                            <input type="tel" class="form-control form-control-lg form-control-solid" name="number" placeholder="" value="{{ $Users->number }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Email</span>
                                            </label>
                                            <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="" value="{{ $Users->email }}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Role</span>
                                            </label>
                                            <select id="UserRoleId" name="role" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Role" class="form-control form-control-lg form-control-solid" required>
                                                @if(auth()->user()->role == 1)
                                                    <option value="1" @if($Users->role == "1") {{ 'selected' }} @endif>Super Admin</option>
                                                @endif
                                                <option value="2" @if($Users->role == "2") {{ 'selected' }} @endif>Admin</option>
                                                <option value="3" @if($Users->role == "3") {{ 'selected' }} @endif>Department Admin</option>
                                                <option value="4" @if($Users->role == "4") {{ 'selected' }} @endif>Department AO</option>
                                                <option value="5" @if($Users->role == "5") {{ 'selected' }} @endif>Store Manager</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="separator"></div>


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
                                                                <input class="form-check-input" type="checkbox"
                                                                       <?php
                                                                       $array = explode(" ",$Users->dept_admin);
                                                                       $id= $DeptItem->department_id;
                                                                       ?>
                                                                       @if(in_array($id, $array))
                                                                       {{ 'checked' }}
                                                                       @endif
                                                                       name="dept_admin[]" value="{{$DeptItem->department_id}}">
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
                                                                <input class="form-check-input" type="checkbox"
                                                                       <?php
                                                                       $array = explode(" ",$Users->dept_ao);
                                                                       $id= $DeptItem->department_id;
                                                                       ?>
                                                                       @if(in_array($id, $array))
                                                                       {{ 'checked' }}
                                                                       @endif
                                                                       name="dept_ao[]" value="{{ $DeptItem->department_id }}">
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
                                                                <input class="form-check-input" type="checkbox"
                                                                       <?php
                                                                       $array = explode(" ",$Users->store_manager);
                                                                       $id= $StoreItem->store_id;
                                                                       ?>
                                                                       @if(in_array($id, $array))
                                                                       {{ 'checked' }}
                                                                       @endif
                                                                       name="store_manager[]" value="{{ $StoreItem->store_id }}">
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

                                    <div class="separator"></div>

                                    <div class="col-md-6">
                                        <div class="fv-row mb-5 fv-plugins-icon-container">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Status</span>
                                            </label>
                                            <select name="status" aria-label="Select a Timezone" data-control="select2" data-placeholder="Select Role" class="form-control form-control-lg form-control-solid" required>
                                                <option value="1" @if($Users->status == "1") {{ 'selected' }} @endif>Active</option>
                                                <option value="2" @if($Users->status == "2") {{ 'selected' }} @endif>Inactive</option>
                                            </select>
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

        var roleId = $('#UserRoleId').val();
        RoleChange(roleId);

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

        $("#UserRoleId").change(function(e){
            var roleId = e.target.value;
            RoleChange(roleId);
        });



    </script>
@endsection

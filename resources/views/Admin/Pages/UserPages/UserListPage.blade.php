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
                            <a href="#" class="text-muted text-hover-primary">User</a>
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

                    @if(auth()->user()->role <= 2 )
                        <a href="/user-create" class="btn btn-sm fw-bold btn-primary">Create</a>
                    @endif


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

            @if(!$Users->isEmpty())
                <!--begin::Card-->
                    <div class="card">

                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                <!--begin::Table head-->
                                <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">SL</th>
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-125px">Role</th>
                                    <th class="min-w-125px">Number</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-125px">Joined Date</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">

                                @foreach($Users as $key=>$User)
                                    <tr>

                                        <td>{{ $key+1 }}</td>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        <img src="{{ asset('Images/Users/'.$User->user_image) }}" alt="Emma Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-column">

                                                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $User->name }}</a>
                                                <small> <span>{{ $User->email }}</span> </small>

                                            </div>
                                        </td>
                                        <td>
                                            <small>
                                                @if($User->role == 1) Super Admin
                                                @elseif($User->role == 2) Admin
                                                @elseif($User->role == 3) Department Admin
                                                @elseif($User->role == 4) Department AO
                                                @elseif($User->role == 6) Store Admin
                                                @elseif($User->role == 5) Store Manager
                                                @else 😢😢😢
                                                @endif
                                            </small>
                                        </td>
                                        <td>  <small> {{$User->number}} </small></td>

                                        @if($User->status == 1)
                                            <td><div class="badge badge-light-success fw-bold">Active</div></td>
                                        @elseif($User->status == 2)
                                            <td><div class="badge badge-light-danger fw-bold">Inactive</div></td>
                                        @endif


                                        <td> <small> {{ date('d M, Y', strtotime($User->created_date)) }} </small> </td>

                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <span class="svg-icon svg-icon-5 m-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4 actionModal" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="/user-edit/{{ $User->id }}" class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->

                                                @if(auth()->user()->role <=2)
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="/user-pass-update/{{ $User->id }}" class="menu-link px-3">Update Password</a>
                                                </div>
                                                <!--end::Menu item-->
                                                @endif


                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>



                            <div class="row">
                                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">

                                        {{ $Users->onEachSide(3)->links('Admin.Common.Paginate') }}

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Card body-->

                    </div>
                    <!--end::Card-->
                @else
                    @include('Admin.Common.DataNotFound')
                @endif
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

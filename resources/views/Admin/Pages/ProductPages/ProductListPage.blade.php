@extends('Admin.Layout.main')

@section('content')
<?php
    $user_role = auth()->user()->role;
?>

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Product List</h1>
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
                        <li class="breadcrumb-item text-muted">Product</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->

                </div>
                <!--end::Page title-->



                <!--begin::Actions  Filter-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0 d-none">

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

                    @if($user_role <= 2 || $user_role == 5 )
                        <a href="/product-create" class="btn btn-sm fw-bold btn-primary">Create</a>
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

            @if(!$Product->isEmpty())
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
                                    <th class="w-10px pe-2">Id</th>
                                    <th class="min-w-125px">Product</th>
                                    <th class="min-w-125px">Modifier</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-125px">Stock</th>
                                    <th class="min-w-125px">Created Date</th>
                                    @if($user_role <= 2 || $user_role == 5 )
                                    <th class="text-end min-w-100px">Actions</th>
                                    @endif
                                </tr>
                                <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">

                                @foreach($Product as $ProductI)
                                    <tr>
                                        <td>{{ $ProductI->product_id }}</td>

                                        <td>{{ $ProductI->product_name }}</td>

                                        <td><div class="badge badge-light fw-bold">{{ $ProductI->name }}</div></td>

                                        @if($ProductI->status == 1)
                                            <td><div class="badge badge-light-success fw-bold">Active</div></td>
                                        @elseif($ProductI->status == 2)
                                            <td><div class="badge badge-light-danger fw-bold">Inactive</div></td>
                                        @endif



                                        <td>{{ $ProductI->total_quantity }}</td>

                                        <td>{{ date("d M, Y", strtotime($ProductI->created_date)) }}</td>

                                        @if($user_role <= 2 || $user_role == 5 )
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="/product-edit/{{ $ProductI->product_id }}" class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                        </td>
                                        @endif


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>
                                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">

                                        {{ $Product->onEachSide(3)->links('Admin.Common.Paginate') }}

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

        function ProductStock(product_id) {
            axios.post('/product-stock',{
                product_id:product_id,
            }).then(function (response) {
                return response.data;
            });
        }

    </script>
@endsection

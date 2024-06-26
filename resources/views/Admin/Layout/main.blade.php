


<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head><base href=""/>
    <title> Stock Register - A New Experience </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('Images/stockicon.png') }}">
    <meta charset="utf-8" />
    <meta name="description" content="Product Quantity Stock Management Software" />
    <meta name="keywords" content="Stock, Software, Stock management, ITLab " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="Software" />
    <meta property="og:title" content="Stock Register - A New Experience" />
    <meta property="og:url" content="https://www.itlabsolutions.com" />
    <meta property="og:site_name" content="Stock Register" />
    <link rel="canonical" href="" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('Admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('Admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Admin/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

<!--begin::Common Variable-->
@include('Admin.Common.CommonVariable')
<!--end::Common Variable-->

<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->


<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <!--begin::Header-->
        @include('Admin.Common.NavBarTop')
        <!--end::Header-->

        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

        <!--begin::Sidebar-->
        @include('Admin.Common.SideBar')
        <!--end::Sidebar-->

            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                <!--begin::Content wrapper-->
                    @yield('content')
                <!--end::Content wrapper-->

            <!--begin::Footer-->
            @include('Admin.Common.Footer')
            <!--end::Footer-->

            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Page-->
</div>
<!--end::App-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{ asset('Admin/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('Admin/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('Admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('Admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('Admin/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('Admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('Admin/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('Admin/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('Admin/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('Admin/assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('Admin/assets/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('Admin/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<!--end::Custom Javascript-->
<script>
    var avatar3 = new KTImageInput('kt_image_3');
</script>

<script>
    goodMessage();
    errorMessage();

    function errorMessage() {
        let e = $('#MessageE').val();
        if (e!=null){
            toastr.error(e);
        }else{
            console.log("good");
        }
    }

    function goodMessage() {
        let g = $('#MessageS').val();
        if (g!=null){
            toastr.error(g);
        }else{
            console.log("good");
        }
    }

</script>


@yield('script')
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>

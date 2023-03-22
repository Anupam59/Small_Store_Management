
<!DOCTYPE html>
<html lang="en">
<head><base href="../../../"/>
    <title>Stock Register</title>
    <meta charset="utf-8" />
    <meta name="description" content="Product Quantity Stock Management Software" />
    <meta name="keywords" content="Stock, Software, Stock management, ITLab " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Software, Stock management, ITLab " />
    <meta property="og:url" content="https://www.itlabsolutions.com" />
    <meta property="og:site_name" content="Stock Register" />
    <link rel="canonical" href="https://www.itlabsolutions.com" />
    <link rel="shortcut icon" href="{{ asset('images/stockicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('Admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->


@yield('content')


<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('Admin/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('Admin/assets/js/scripts.bundle.js') }}"></script>

<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('Admin/assets/js/custom/authentication/sign-in/general.js') }}"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
</html>

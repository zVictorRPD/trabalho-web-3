<!DOCTYPE html>

<html lang="pt-br">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Voe bem">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    {{-- FONT IMPORT --}}
    <link href="{{ asset('font/style.css') }}" rel="stylesheet">

    <!--begin::Base Styles -->
    <link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!--end::Base Styles -->

</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading"
    cz-shortcut-listen="false">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
         <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">



            <div class="m-grid__item m-grid__item--fluid m-wrapper" style="background: #F7F8FC !important">
                @yield('container')
            </div>
        </div>

        <!-- end:: Body -->

    </div>
    <div id="alerts"></div>
    <!-- end:: Page -->

    <!--begin::Base Scripts -->

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/select.js') }}" type="text/javascript"></script>
    <script src="{{ asset('mask/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    @stack('js')

    @if (Session::has('success'))
        <script>
            const success = new popupAlert("<?= Session::get('success') ?>", 1, 3000);
            success.create();
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            const error = new popupAlert("<?= Session::get('error'); ?>", 2, 3000 );
            error.create();
        </script>
    @endif

    @if(Session::has('info'))
        <script>
            const info = new popupAlert("<?= Session::get('info'); ?>", 1, 3000 );
            info.create();
        </script>
    @endif

    @if(Session::has('warning'))
        <script>
            const warning = new popupAlert("<?= Session::get('warning'); ?>", 2, 3000 );
            warning.create();
        </script>
    @endif

    <!--end::Base Scripts -->
</body>

<!-- end::Body -->

</html>

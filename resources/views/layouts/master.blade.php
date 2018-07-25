<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIS</title>

    <link rel="shortcut icon" href="{{ URL::to('storage/school/'. ((session('school_id')) ? \App\School::find( session('school_id') )->code : \App\School::find( Auth::user()->school_id )->code) .'-logo.png') }}">

    <link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Morris -->
    <link href="{{ URL::to('assets/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ URL::to('assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ URL::to('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

    <!-- Datatable -->
    <link href="{{ URL::to('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">

    <!-- jasny -->
    <link href="{{ URL::to('assets/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Style -->
    <link href="{{ URL::to('assets/css/custom_style.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!!
            json_encode(['csrfToken' => csrf_token(),])
        !!};
    </script>
</head>

<body>
    <div id="wrapper">
    @include('layouts.sidebar')

        <div id="page-wrapper" class="gray-bg">

            @include('layouts.navbar')


            @yield('content')

            @include('layouts.footer')

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ URL::to('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to('assets/js/inspinia.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/pace/pace.min.js') }}"></script>

    <!-- Jasny -->
    <script src="{{ URL::to('assets/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ URL::to('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins/footable/footable.all.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ URL::to('assets/js/plugins/toastr/toastr.min.js') }}"></script>

    <!-- My Custom js -->
    <script src="{{ URL::to('assets/js/custom_script.js') }}"></script>

    @yield('js_script')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Rabdiwala Foods</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Bootstrap core CSS     -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />



        <!--  Material Dashboard CSS    -->
        <link href="/assets/css/material-dashboard.css?v=1.3.0" rel="stylesheet"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="/assets/css/demo.css" rel="stylesheet" />


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </head>
    <body class="off-canvas-sidebar">
            <div class="wrapper wrapper-full-page">
                <div class="full-page login-page" filter-color="black" data-image="/assets/img/login.jpeg">
                    <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->

                    @yield('content')

                </div>
            </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>

    <!--   Core JS Files   -->
    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/js/material.min.js" type="text/javascript"></script>
    <script src="/assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- Library for adding dinamically elements -->
    <script src="/assets/js/arrive.min.js" type="text/javascript"></script>

    <!-- Forms Validations Plugin -->
    <script src="/assets/js/jquery.validate.min.js"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="/assets/js/moment.min.js"></script>

    <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
    <script src="/assets/js/chartist.min.js"></script>

    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="/assets/js/jquery.bootstrap-wizard.js"></script>

    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <script src="/assets/js/bootstrap-notify.js"></script>

    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="/assets/js/bootstrap-datetimepicker.js"></script>

    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="/assets/js/jquery-jvectormap.js"></script>

    <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="/assets/js/nouislider.min.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="/assets/js/jquery.select-bootstrap.js"></script>

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="/assets/js/jquery.datatables.js"></script>

    <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
    <script src="/assets/js/sweetalert2.js"></script>

    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="/assets/js/jasny-bootstrap.min.js"></script>

    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="/assets/js/fullcalendar.min.js"></script>

    <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="/assets/js/jquery.tagsinput.js"></script>

    <!-- Material Dashboard javascript methods -->
    <script src="/assets/js/material-dashboard.js?v=1.3.0"></script>

    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="/assets/js/demo.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    @yield('footer-content')


</html>

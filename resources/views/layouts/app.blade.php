<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>Preclinic - Medical & Hospital</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fullcalendar.min.css') }} ">
</head>

<body>

    {{-- @yield('navbar') --}}

    {{-- @yield('sidebar') --}}


    @yield('content')

    <script src="{{ 'assets/js/jquery-3.2.1.min.js' }}"></script>
    <script src="{{ 'assets/js/popper.min.js' }}"></script>
    <script src="{{ 'assets/js/bootstrap.min.js' }}"></script>
    <script src="{{ 'assets/js/jquery.slimscroll.js' }}"></script>
    <script src="{{ 'assets/js/Chart.bundle.js' }}"></script>
    <script src="{{ 'assets/js/chart.js' }}"></script>
    <script src="{{ 'assets/js/select2.min.js' }}"></script>
    <script src="{{ 'assets/js/moment.min.js' }}"></script>
    <script src="{{ 'assets/js/jquery.dataTables.min.js' }}"></script>
    <script src="{{ 'assets/js/dataTables.bootstrap4.min.js' }}"></script>
    <script src="{{ 'assets/js/tagsinput.js' }}"></script>
    <script src="{{ 'assets/js/jquery-ui.min.html' }}"></script>
    <script src="{{ 'assets/js/fullcalendar.min.js' }}"></script>
    <script src="{{ 'assets/js/bootstrap-datetimepicker.min.js' }}"></script>
    <script src="{{ 'assets/js/jquery.fullcalendar.js' }}"></script>
    <script src="{{ 'assets/js/app.js' }}"></script>

    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker4').datetimepicker({
                format: 'LT'
            });
        });
    </script>
</body>

</html>
